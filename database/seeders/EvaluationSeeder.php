<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Criteria;
use App\Models\Evaluation;
use App\Models\Period;
use Illuminate\Support\Facades\DB;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the active period, or fallback to the first period
        $period = Period::where('is_active', true)->first() ?? Period::first();

        if (!$period) {
            return;
        }

        $employees = Employee::all();
        $criterias = Criteria::all();

        if ($employees->isEmpty() || $criterias->isEmpty()) {
            return;
        }

        DB::beginTransaction();
        try {
            // Delete existing evaluations for this period to avoid duplicates
            Evaluation::where('period_id', $period->id)->delete();

            foreach ($employees as $emp) {
                foreach ($criterias as $crit) {
                    // Generate a realistic score based on criteria types
                    if ($crit->code === 'C11') { // Cost: Pelanggaran
                        $score = rand(0, 15) === 0 ? rand(1, 3) : 0;
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
                        'period_id' => $period->id,
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
