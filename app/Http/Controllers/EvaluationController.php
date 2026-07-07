<?php
namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    public function evaluationData(Request $request)
    {
        $periods  = Period::orderBy('year', 'desc')->get();
        $selectedPeriod = $request->get('period_id');

        $query = Employee::with(['department', 'position']);

        if ($selectedPeriod) {
            $query->whereHas('evaluations', function ($q) use ($selectedPeriod) {
                $q->where('period_id', $selectedPeriod);
            });
        }

        $employees = $query->paginate(10)->withQueryString();

        // For each employee, gather evaluation completeness
        $criteriaCount = Criteria::count();

        return view('evaluation.evaluation-data', compact(
            'employees',
            'periods',
            'selectedPeriod',
            'criteriaCount'
        ));
    }

    public function evaluationAdd(Request $request)
    {
        $employees = Employee::with(['department', 'position'])->orderBy('name')->get();
        $criterias = Criteria::orderBy('code')->get();
        $periods   = Period::orderBy('year', 'desc')->orderBy('semester', 'desc')->get();

        $selectedEmployee = $request->get('employee_id');
        $selectedPeriod   = $request->get('period_id');

        $existingScores = [];
        if ($selectedEmployee && $selectedPeriod) {
            $existing = Evaluation::where('employee_id', $selectedEmployee)
                ->where('period_id', $selectedPeriod)
                ->get()
                ->keyBy('criteria_id');
            foreach ($existing as $ev) {
                $existingScores[$ev->criteria_id] = $ev->score;
            }
        }

        return view('evaluation.evaluation-add', compact(
            'employees',
            'criterias',
            'periods',
            'selectedEmployee',
            'selectedPeriod',
            'existingScores'
        ));
    }

    public function evaluationStore(Request $request)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'period_id'   => 'required|exists:periods,id',
                'scores'      => 'required|array',
                'scores.*'    => 'required|numeric|min:0|max:100',
            ]);

            $employeeId = $request->employee_id;
            $periodId   = $request->period_id;
            $scores     = $request->scores; // ['criteria_id' => score]

            foreach ($scores as $criteriaId => $score) {
                Evaluation::updateOrCreate(
                    [
                        'employee_id' => $employeeId,
                        'criteria_id' => $criteriaId,
                        'period_id'   => $periodId,
                    ],
                    [
                        'score'      => $score,
                        'created_by' => Auth::id(),
                    ]
                );
            }

            DB::commit();

            return redirect()
                ->route('evaluation.evaluation-data')
                ->with('success', 'Data penilaian berhasil disimpan');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Simpan penilaian gagal: ' . $e->getMessage());
        }
    }

    public function evaluationEdit($employee_id, $period_id)
    {
        $employee  = Employee::with(['department', 'position'])->findOrFail($employee_id);
        $period    = Period::findOrFail($period_id);
        $criterias = Criteria::orderBy('code')->get();
        $periods   = Period::orderBy('year', 'desc')->orderBy('semester', 'desc')->get();
        $employees = Employee::with(['department', 'position'])->orderBy('name')->get();

        $existingScores = Evaluation::where('employee_id', $employee_id)
            ->where('period_id', $period_id)
            ->get()
            ->keyBy('criteria_id')
            ->map(fn($ev) => $ev->score);

        return view('evaluation.evaluation-edit', compact(
            'employee',
            'period',
            'criterias',
            'periods',
            'employees',
            'existingScores'
        ));
    }

    public function evaluationUpdate(Request $request, $employee_id, $period_id)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'scores'   => 'required|array',
                'scores.*' => 'required|numeric|min:0|max:100',
            ]);

            foreach ($request->scores as $criteriaId => $score) {
                Evaluation::updateOrCreate(
                    [
                        'employee_id' => $employee_id,
                        'criteria_id' => $criteriaId,
                        'period_id'   => $period_id,
                    ],
                    [
                        'score'      => $score,
                        'created_by' => Auth::id(),
                    ]
                );
            }

            DB::commit();

            return redirect()
                ->route('evaluation.evaluation-data')
                ->with('success', 'Data penilaian berhasil diperbarui');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Update penilaian gagal: ' . $e->getMessage());
        }
    }

    public function evaluationDelete($employee_id, $period_id)
    {
        Evaluation::where('employee_id', $employee_id)
            ->where('period_id', $period_id)
            ->delete();

        return redirect()
            ->route('evaluation.evaluation-data')
            ->with('success', 'Data penilaian berhasil dihapus');
    }
}