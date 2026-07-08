<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Criteria;
use App\Models\Evaluation;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SawProcessController extends Controller
{
    public function sawProcess(Request $request)
    {
        $periods = Period::orderBy('year', 'desc')->orderBy('semester', 'desc')->get();
        $selectedPeriodId = $request->get('period_id', Period::where('is_active', 1)->first()->id ?? ($periods->first()->id ?? null));

        // Handle auto-seed request if user clicks simulation button
        if ($request->has('auto_seed') && $selectedPeriodId) {
            $this->seedDummyEvaluations($selectedPeriodId);
            return redirect()->route('sawprocess-data', ['period_id' => $selectedPeriodId])->with('success', 'Berhasil melakukan simulasi pengisian nilai pegawai!');
        }

        $criterias = Criteria::orderBy('code')->get();
        
        // Get employees who have evaluations in this period
        $employees = Employee::whereHas('evaluations', function($q) use ($selectedPeriodId) {
            $q->where('period_id', $selectedPeriodId);
        })->with(['evaluations' => function($q) use ($selectedPeriodId) {
            $q->where('period_id', $selectedPeriodId);
        }, 'position', 'department'])->get();

        $matrix = [];
        $normalized = [];
        $preferences = [];

        // If we have employees and evaluations, calculate SAW
        if ($employees->isNotEmpty() && $criterias->isNotEmpty()) {
            // 1. Build Decision Matrix (X)
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

            // 2. Build Normalized Matrix (R)
            foreach ($employees as $emp) {
                foreach ($criterias as $crit) {
                    $score = $matrix[$emp->id][$crit->id];
                    if ($crit->attribute === 'benefit') {
                        $max = $minMax[$crit->id]['max'];
                        $norm = $max > 0 ? ($score / $max) : 0;
                    } else {
                        // cost
                        $min = $minMax[$crit->id]['min'];
                        $norm = $score > 0 ? ($min / $score) : 0;
                    }
                    $normalized[$emp->id][$crit->id] = $norm;
                }
            }

            // 3. Calculate Preference Values (V)
            foreach ($employees as $emp) {
                $totalVal = 0;
                foreach ($criterias as $crit) {
                    $norm = $normalized[$emp->id][$crit->id];
                    $totalVal += $norm * $crit->weight;
                }
                $preferences[] = [
                    'employee' => $emp,
                    'scores' => $matrix[$emp->id],
                    'normalized' => $normalized[$emp->id],
                    'total' => round($totalVal, 4),
                ];
            }

            // Sort preferences by total score descending for ranking
            usort($preferences, function($a, $b) {
                return $b['total'] <=> $a['total'];
            });
        }

        return view('saw.sawprocess-data', compact(
            'periods',
            'selectedPeriodId',
            'criterias',
            'employees',
            'matrix',
            'normalized',
            'preferences'
        ));
    }

    private function seedDummyEvaluations($periodId)
    {
        $employees = Employee::all();
        $criterias = Criteria::all();

        DB::beginTransaction();
        try {
            // Delete existing evaluations for this period first to reset
            Evaluation::where('period_id', $periodId)->delete();

            foreach ($employees as $emp) {
                foreach ($criterias as $crit) {
                    // Generate a realistic score based on criteria types
                    if ($crit->code === 'C11') { // Cost: Pelanggaran
                        $score = rand(0, 15) === 0 ? rand(1, 3) : 0; // SP/Teguran
                    } elseif ($crit->code === 'C6') { // TOEIC
                        $score = rand(400, 990);
                    } elseif ($crit->code === 'C8') { // Assessment Potential 1-5
                        $score = rand(2, 5);
                    } elseif ($crit->code === 'C9') { // IQ
                        $score = rand(90, 140);
                    } else {
                        $score = rand(65, 100);
                    }

                    Evaluation::create([
                        'employee_id' => $emp->id,
                        'criteria_id' => $crit->id,
                        'period_id' => $periodId,
                        'score' => $score
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
