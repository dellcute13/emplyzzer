<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Period;
use Illuminate\Http\Request;

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

    public function reportData()
    {
        return view('report.report-data');
    }
}
