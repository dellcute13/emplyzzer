<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');

        view()->composer('layouts.partials.navbar', function ($view) {
            // Get latest employees
            $newEmployees = \App\Models\Employee::latest()->take(3)->get()->map(function($emp) {
                return [
                    'icon' => 'person_add',
                    'icon_bg' => 'bg-green-100 text-green-600',
                    'message' => 'Pegawai baru ' . $emp->name . ' (NIP: ' . $emp->nip . ') berhasil didaftarkan.',
                    'time' => $emp->created_at
                ];
            });

            // Get latest evaluations
            $newEvaluations = \App\Models\Evaluation::with(['employee', 'period'])
                ->select('employee_id', 'period_id', 'created_at')
                ->distinct('employee_id', 'period_id')
                ->latest()
                ->take(3)
                ->get()
                ->map(function($eval) {
                    return [
                        'icon' => 'grade',
                        'icon_bg' => 'bg-amber-100 text-amber-600',
                        'message' => 'Penilaian kinerja untuk ' . ($eval->employee->name ?? 'Pegawai') . ' pada ' . ($eval->period->name ?? 'Periode') . ' telah diinput.',
                        'time' => $eval->created_at
                    ];
                });

            // Get latest reports
            $newReports = \App\Models\Report::with('employee')->latest()->take(3)->get()->map(function($rep) {
                return [
                    'icon' => 'summarize',
                    'icon_bg' => 'bg-indigo-100 text-indigo-600',
                    'message' => 'Laporan ' . $rep->file_name . ' berhasil dibuat.',
                    'time' => $rep->created_at
                ];
            });

            // Merge and sort
            $activities = collect()
                ->merge($newEmployees)
                ->merge($newEvaluations)
                ->merge($newReports)
                ->sortByDesc('time')
                ->take(6);

            $view->with('navbarActivities', $activities);
        });
    }
}
