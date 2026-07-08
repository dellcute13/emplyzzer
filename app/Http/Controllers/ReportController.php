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
        $selectedPeriodId = Period::where('is_active', 1)->first()->id ?? 1;

        // Perform dynamic SAW calculation to get department stats and rankings
        $criterias = Criteria::orderBy('code')->get();
        $employees = Employee::with(['evaluations' => function($q) use ($selectedPeriodId) {
            $q->where('period_id', $selectedPeriodId);
        }, 'department'])->get();

        $deptScores = [];
        $totalReports = Report::count();
        $lastReport = Report::latest()->first();

        if ($employees->isNotEmpty() && $criterias->isNotEmpty()) {
            $matrix = [];
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

            $normalized = [];
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
                
                if ($emp->department) {
                    $deptScores[$emp->department->name][] = $totalVal;
                }
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

        // Retrieve dynamic reports list
        $reports = Report::latest()->paginate(10);

        return view('report.report-data', compact(
            'totalReports',
            'lastReport',
            'bestDeptName',
            'bestDeptScore',
            'deptAverages',
            'reports'
        ));
    }

    public function generateReport(Request $request)
    {
        $reportType = $request->input('report_type', 'Monthly Performance Summary');
        $dateRange = $request->input('date_range', date('Y-m-d') . ' to ' . date('Y-m-d'));
        
        $activePeriod = Period::where('is_active', 1)->first() ?? Period::first();
        $ext = $reportType === 'Audit Eksekutif Tahunan' ? 'xlsx' : 'pdf';
        
        // Clean name
        $nameClean = str_replace(' ', '_', $reportType);
        $fileName = $nameClean . '_' . date('Ymd_His') . '.' . $ext;

        $firstEmployee = Employee::first();

        Report::create([
            'period_id'   => $activePeriod->id ?? 1,
            'employee_id' => $firstEmployee->id ?? null,
            'file_name'   => $fileName,
            'file_type'   => $ext === 'xlsx' ? 'excel' : 'pdf'
        ]);

        return redirect()->route('report-data')->with('success', 'Laporan ' . $fileName . ' berhasil di-generate!');
    }
}
