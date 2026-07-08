<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Criteria;
use App\Models\Evaluation;
use App\Models\Period;
use Illuminate\Http\Request;

class EmployeeRankController extends Controller
{
    public function employeeRank(Request $request)
    {
        $periods = Period::orderBy('year', 'desc')->orderBy('semester', 'desc')->get();
        $selectedPeriodId = $request->get('period_id', Period::where('is_active', 1)->first()->id ?? ($periods->first()->id ?? null));

        $criterias = Criteria::orderBy('code')->get();
        
        $employees = Employee::whereHas('evaluations', function($q) use ($selectedPeriodId) {
            $q->where('period_id', $selectedPeriodId);
        })->with(['evaluations' => function($q) use ($selectedPeriodId) {
            $q->where('period_id', $selectedPeriodId);
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
                    'employee' => $emp,
                    'total' => round($totalVal, 4),
                ];
            }

            usort($preferences, function($a, $b) {
                return $b['total'] <=> $a['total'];
            });
        }

        return view('employee-rank.rank-data', compact('periods', 'selectedPeriodId', 'preferences'));
    }
}
