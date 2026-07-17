<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Period;
use App\Models\Employee;
use App\Models\Criteria;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

     public function index()
    {
        $reports = Report::with('period')->get();

        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $periods = Period::all();

        return view('reports.create', compact('periods'));
    }

    public function store(Request $request)
    {
        Report::create($request->all());

        return redirect()->route('reports.index')
                         ->with('success', 'Report created successfully');
    }

    public function edit(Report $report)
    {
        $periods = Period::all();

        return view('reports.edit', compact(
            'report',
            'periods'
        ));
    }

    public function update(Request $request, Report $report)
    {
        $report->update($request->all());

        return redirect()->route('reports.index')
                         ->with('success', 'Report updated successfully');
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('reports.index')
                         ->with('success', 'Report deleted successfully');
    }

    public function reportData(Request $request)
    {
        $periods = Period::orderBy('year', 'desc')->orderBy('semester', 'desc')->get();
        $selectedPeriodId = $request->get('period_id', Period::where('is_active', 1)->first()->id ?? ($periods->first()->id ?? null));

        // Perform dynamic SAW calculation using helper
        $preferences = $selectedPeriodId ? $this->calculateRankings($selectedPeriodId) : [];

        $deptScores = [];
        foreach ($preferences as $pref) {
            if ($pref['department'] !== '-') {
                $deptScores[$pref['department']][] = $pref['total'];
            }
        }

        // Calculate averages for each department
        $deptAverages = [];
        foreach ($deptScores as $deptName => $scores) {
            $deptAverages[$deptName] = count($scores) > 0 ? (array_sum($scores) / count($scores)) : 0;
        }

        // Sort descending to get the best department
        arsort($deptAverages);

        $bestDeptName = !empty($deptAverages) ? array_key_first($deptAverages) : 'N/A';
        $bestDeptScore = !empty($deptAverages) ? round(reset($deptAverages), 3) : 0;

        $totalReports = Report::count();
        $lastReport = Report::latest()->first();

        // Retrieve dynamic reports list
        $reports = Report::latest()->paginate(10);

        return view('report.report-data', compact(
            'periods',
            'selectedPeriodId',
            'preferences',
            'totalReports',
            'lastReport',
            'bestDeptName',
            'bestDeptScore',
            'deptAverages',
            'reports'
        ));
    }

    public function getRankings($periodId)
    {
        $preferences = $this->calculateRankings($periodId);
        $period = Period::find($periodId);
        return response()->json([
            'period_name' => $period ? $period->name : 'N/A',
            'rankings' => $preferences
        ]);
    }

    public function generateReport(Request $request)
    {
        $reportType = $request->input('report_type', 'Monthly Performance Summary');
        $dateRange = $request->input('date_range', date('Y-m-d') . ' to ' . date('Y-m-d'));
        
        $periods = Period::all();
        $selectedPeriodId = $request->input('period_id', Period::where('is_active', 1)->first()->id ?? ($periods->first()->id ?? 1));
        $selectedPeriod = Period::find($selectedPeriodId);
        
        $ext = $reportType === 'Audit Eksekutif Tahunan' ? 'xlsx' : 'pdf';
        
        // Clean name
        $nameClean = str_replace(' ', '_', $reportType);
        $periodNameClean = $selectedPeriod ? str_replace(' ', '_', $selectedPeriod->name) : 'Periode';
        $fileName = $nameClean . '_' . $periodNameClean . '_' . date('Ymd_His') . '.' . $ext;

        $firstEmployee = Employee::first();

        Report::create([
            'period_id'   => $selectedPeriodId,
            'employee_id' => $firstEmployee->id ?? null,
            'file_name'   => $fileName,
            'file_type'   => $ext === 'xlsx' ? 'excel' : 'pdf'
        ]);

        return redirect()->route('report-data', ['period_id' => $selectedPeriodId])
                         ->with('success', 'Laporan ' . $fileName . ' berhasil di-generate!');
    }

    public function exportPdf(Request $request)
    {
        $periodId = $request->get('period_id');
        $period = Period::findOrFail($periodId);
        
        $preferences = $this->calculateRankings($periodId);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('report.pdf-rankings', compact('period', 'preferences'));
        
        return $pdf->download('Laporan_Rankings_' . str_replace(' ', '_', $period->name) . '.pdf');
    }

    private function calculateRankings($periodId)
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

            foreach ($employees as $emp) {
                $totalVal = 0;
                foreach ($criterias as $crit) {
                    $norm = $normalized[$emp->id][$crit->id];
                    $totalVal += $norm * $crit->weight;
                }
                $preferences[] = [
                    'employee_id' => $emp->id,
                    'name' => $emp->name,
                    'nip' => $emp->nip,
                    'position' => $emp->position->name ?? '-',
                    'department' => $emp->department->name ?? '-',
                    'total' => round($totalVal, 4),
                ];
            }

            usort($preferences, function($a, $b) {
                return $b['total'] <=> $a['total'];
            });
        }

        return $preferences;
    }
}
