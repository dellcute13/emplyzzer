<?php
namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Employee;
use App\Models\Criteria;
use App\Models\Period;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with([
            'employee',
            'criteria',
            'period'
        ])->get();

        return view('evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        $employees = Employee::all();
        $criterias = Criteria::all();
        $periods = Period::all();

        return view('evaluations.create', compact(
            'employees',
            'criterias',
            'periods'
        ));
    }

    public function store(Request $request)
    {
        Evaluation::create($request->all());

        return redirect()->route('evaluations.index')
                         ->with('success', 'Evaluation created successfully');
    }

    public function edit(Evaluation $evaluation)
    {
        $employees = Employee::all();
        $criterias = Criteria::all();
        $periods = Period::all();

        return view('evaluations.edit', compact(
            'evaluation',
            'employees',
            'criterias',
            'periods'
        ));
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        $evaluation->update($request->all());

        return redirect()->route('evaluations.index')
                         ->with('success', 'Evaluation updated successfully');
    }

    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();

        return redirect()->route('evaluations.index')
                         ->with('success', 'Evaluation deleted successfully');
    }
}