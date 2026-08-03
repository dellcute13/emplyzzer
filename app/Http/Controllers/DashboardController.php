<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Criteria;
use App\Models\Evaluation;
use App\Models\Period;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Get active period or fallback to latest period
        $periods = Period::orderBy('year', 'desc')->orderBy('semester', 'desc')->get();
        $activePeriod = Period::where('is_active', true)->first() ?? $periods->first();

        // 2. Total Employees and New Employees this month
        $totalEmployees = Employee::count();
        $newEmployeesThisMonth = Employee::where('join_date', '>=', now()->startOfMonth())->count();

        // If no employees joined this calendar month, let's check the last 30 days to make it look dynamic
        if ($newEmployeesThisMonth === 0) {
            $newEmployeesThisMonth = Employee::where('join_date', '>=', now()->subDays(30))->count();
        }

        // 3. Total Criteria
        $totalCriteria = Criteria::count();

        // 4. Gender Stats
        $femaleEmployees = Employee::where('gender', 'P')->count();
        $maleEmployees = Employee::where('gender', 'L')->count();

        // 5. Calculate SAW Rankings dynamically for the selected/active period
        $rankings = [];
        $bestEmployee = null;
        $averageScore = 0;

        if ($activePeriod) {
            $rankings = $this->calculateSawRankings($activePeriod->id);
            
            if (!empty($rankings)) {
                // Top Employee
                $bestEmployee = $rankings[0];
                
                // Calculate Average Score (normalized to 100)
                $totalSum = array_sum(array_column($rankings, 'total'));
                $averageScore = round(($totalSum / count($rankings)) * 100, 1);
            }
        }

        // Top 10 Employees for table
        $topEmployees = array_slice($rankings, 0, 10);

        // Chart Data: Top 7 employees for the bar chart
        $chartEmployees = array_slice($rankings, 0, 7);

        // 6. Recent Activities (combining Employees, Evaluations, Reports)
        $recentActivities = $this->getRecentActivities();

        return view('dashboard.index', compact(
            'periods',
            'activePeriod',
            'totalEmployees',
            'newEmployeesThisMonth',
            'totalCriteria',
            'femaleEmployees',
            'maleEmployees',
            'bestEmployee',
            'averageScore',
            'topEmployees',
            'chartEmployees',
            'recentActivities'
        ));
    }

    private function calculateSawRankings($periodId)
    {
        $criterias = Criteria::orderBy('code')->get();
        $employees = Employee::whereHas('evaluations', function($q) use ($periodId) {
            $q->where('period_id', $periodId);
        })->with(['evaluations' => function($q) use ($periodId) {
            $q->where('period_id', $periodId);
        }, 'position', 'department'])->get();

        $matrix = [];
        $normalized = [];
        $preferences = [];

        if ($employees->isNotEmpty() && $criterias->isNotEmpty()) {
            // Find Min and Max values for each criteria
            $minMax = [];
            foreach ($criterias as $crit) {
                $scores = [];
                foreach ($employees as $emp) {
                    $eval = $emp->evaluations->where('criteria_id', $crit->id)->first();
                    $score = $eval ? $eval->score : 0;
                    $matrix[$emp->id][$crit->id] = $score;
                    $scores[] = $score;
                }
                $minMax[$crit->id] = [
                    'min' => !empty($scores) ? min($scores) : 0,
                    'max' => !empty($scores) ? max($scores) : 0,
                ];
            }

            // Normalize Matrix
            foreach ($employees as $emp) {
                foreach ($criterias as $crit) {
                    $score = $matrix[$emp->id][$crit->id];
                    if ($crit->attribute === 'benefit') {
                        $max = $minMax[$crit->id]['max'];
                        $norm = $max > 0 ? ($score / $max) : 0;
                    } else {
                        $min = $minMax[$crit->id]['min'];
                        $norm = $score > 0 ? ($min / $score) : 0;
                    }
                    $normalized[$emp->id][$crit->id] = $norm;
                }
            }

            // Calculate preference scores
            foreach ($employees as $emp) {
                $totalVal = 0;
                foreach ($criterias as $crit) {
                    $norm = $normalized[$emp->id][$crit->id];
                    $totalVal += $norm * $crit->weight;
                }
                
                $preferences[] = [
                    'employee_id' => $emp->id,
                    'nip' => $emp->nip,
                    'name' => $emp->name,
                    'photo' => $emp->photo_url,
                    'has_photo' => !empty($emp->photo),
                    'position' => $emp->position->name ?? '-',
                    'department' => $emp->department->name ?? '-',
                    'total' => round($totalVal, 4),
                ];
            }

            // Sort by preference value descending
            usort($preferences, function($a, $b) {
                return $b['total'] <=> $a['total'];
            });
        }

        return $preferences;
    }

    private function getRecentActivities()
    {
        // Fetch latest employees
        $newEmployees = Employee::latest()->take(3)->get()->map(function($emp) {
            return [
                'icon' => 'person_add',
                'icon_bg' => 'bg-green-100 text-green-600',
                'title' => 'Pegawai Baru Terdaftar',
                'message' => 'Pegawai baru ' . $emp->name . ' (NIP: ' . $emp->nip . ') berhasil didaftarkan.',
                'time' => $emp->created_at
            ];
        });

        // Fetch latest evaluations
        $newEvaluations = Evaluation::with(['employee', 'period'])
            ->select('employee_id', 'period_id', 'created_at')
            ->distinct('employee_id', 'period_id')
            ->latest()
            ->take(3)
            ->get()
            ->map(function($eval) {
                return [
                    'icon' => 'grade',
                    'icon_bg' => 'bg-amber-100 text-amber-600',
                    'title' => 'Penilaian Kinerja Diinput',
                    'message' => 'Penilaian kinerja untuk ' . ($eval->employee->name ?? 'Pegawai') . ' pada ' . ($eval->period->name ?? 'Periode') . ' telah diinput.',
                    'time' => $eval->created_at
                ];
            });

        // Fetch latest reports
        $newReports = Report::with('employee')->latest()->take(3)->get()->map(function($rep) {
            return [
                'icon' => 'summarize',
                'icon_bg' => 'bg-indigo-100 text-indigo-600',
                'title' => 'Laporan Berhasil Dibuat',
                'message' => 'Laporan ' . $rep->file_name . ' berhasil dibuat.',
                'time' => $rep->created_at
            ];
        });

        // Merge and sort all activities by time descending
        return collect()
            ->merge($newEmployees)
            ->merge($newEvaluations)
            ->merge($newReports)
            ->sortByDesc('time')
            ->take(4)
            ->values();
    }
}
