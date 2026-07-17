<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeGradeController;
use App\Http\Controllers\EmployeePhotoController;
use App\Http\Controllers\EmployeeRankController;
use App\Http\Controllers\MasterData\DepartmentController;
use App\Http\Controllers\MasterData\GradeController;
use App\Http\Controllers\MasterData\PositionController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\PhotoAiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SawProcessController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::controller(LoginController::class)->group(function () {

        // Login Page
        Route::get('/login', 'login')->name('login');

        // Login Process
        Route::post('/login', 'authenticate')->name('login.process');
    });
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/navbar-search', [EmployeeController::class, 'navbarSearch'])->name('navbar-search');

    Route::controller(LoginController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/logout/page', 'logoutPage')->name('logout.page');
    });
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // Route::middleware('auth')->group(function () {
    //     // --------------------- dashboard ------------------//
    //     Route::controller(EmployeeController::class)->group(function () {
    //         Route::get('employee-data', 'employeeData')->name('employee-data');
    //         Route::get('employee-add', 'employeeAdd')->name('employee-add');
    //     });
    // });

    Route::middleware('auth')->group(function () {
        Route::prefix('employee')->name('employee.')->group(function () {
            Route::controller(EmployeeController::class)->group(function () {
                Route::get('employee-data', 'employeeData')->name('employee-data');
                Route::get('employee-add', 'employeeAdd')->name('employee-add');
                Route::post('employee-store', 'store')->name('employee-store');
                Route::get('employee-edit/{id}', 'employeeEdit')->name('employee-edit');
                Route::post('employee-store-update/{id}', 'employeeStoreUpdate')->name('employee-store-update');
                Route::delete('employee-delete/{id}', 'employeeDelete')->name('employee-delete');
            });
        });
    });

    Route::middleware('auth')->group(function () {
        Route::prefix('master-data')->name('master-data.')->group(function () {
            Route::controller(PositionController::class)->group(function () {
                Route::get('position-data', 'positionData')->name('position-data');
                Route::get('position-add', 'positionAdd')->name('position-add');
                Route::post('position-store', 'positionStore')->name('position-store');
                Route::get('position-edit/{id}', 'positionEdit')->name('position-edit');
                Route::post('position-update/{id}', 'positionUpdate')->name('position-update');
                Route::delete('position-delete/{id}', 'positionDelete')->name('position-delete');
            });
            Route::controller(GradeController::class)->group(function () {
                Route::get('grade-data', 'gradeData')->name('grade-data');
                Route::get('grade-add', 'gradeAdd')->name('grade-add');
                Route::post('grade-store', 'gradeStore')->name('grade-store');
                Route::get('grade-edit/{id}', 'gradeEdit')->name('grade-edit');
                Route::post('grade-update/{id}', 'gradeUpdate')->name('grade-update');
                Route::delete('grade-delete/{id}', 'gradeDelete')->name('grade-delete');
            });
            Route::controller(DepartmentController::class)->group(function () {
                Route::get('department-data', 'departmentData')->name('department-data');
                Route::get('department-add', 'departmentAdd')->name('department-add');
                Route::post('department-store', 'departmentStore')->name('department-store');
                Route::get('department-edit/{id}', 'departmentEdit')->name('department-edit');
                Route::post('department-update/{id}', 'departmentUpdate')->name('department-update');
                Route::delete('department-delete/{id}', 'departmentDelete')->name('department-delete');
            });
            Route::controller(PeriodController::class)->group(function () {
                Route::get('period-data', 'periodData')->name('period-data');
                Route::get('period-add', 'periodAdd')->name('period-add');
                Route::post('period-store', 'periodStore')->name('period-store');
                Route::get('period-edit/{id}', 'periodEdit')->name('period-edit');
                Route::post('period-update/{id}', 'periodUpdate')->name('period-update');
                Route::delete('period-delete/{id}', 'periodDelete')->name('period-delete');
            });
        });
    });


    Route::post('/photo-process', [EmployeePhotoController::class, 'process']);
    Route::post('/generate-photo-ai', [PhotoAiController::class, 'generate']);
    Route::post('/generate-photo-ai', [EmployeeController::class, 'generateAI']);

    Route::get('/pegawai/create', [EmployeeController::class, 'create']);
    Route::post('/pegawai/store', [EmployeeController::class, 'store']);

    // Route::middleware('auth')->group(function () {
    //     // --------------------- Pages ------------------//
    //     Route::controller(CriteriaController::class)->group(function () {
    //         Route::get('criteria-data', 'criteriaData')->name('criteria-data');
    //     });
    // });

    Route::middleware('auth')->group(function () {
        Route::prefix('criteria')->name('criteria.')->group(function () {
            Route::controller(CriteriaController::class)->group(function () {
                Route::get('criteria-data', 'criteriaData')->name('criteria-data');
                Route::get('criteria-add', 'criteriaAdd')->name('criteria-add');
                Route::post('criteria-store', 'criteriaStore')->name('criteria-store');
                Route::get('criteria-edit/{id}', 'criteriaEdit')->name('criteria-edit');
                Route::post('criteria-update/{id}', 'criteriaUpdate')->name('criteria-update');
                Route::delete('criteria-delete/{id}', 'criteriaDelete')->name('criteria-delete');
            });
        });
    });

    Route::middleware('auth')->group(function () {
        Route::prefix('evaluation')->name('evaluation.')->group(function () {
            Route::controller(EvaluationController::class)->group(function () {
                Route::get('evaluation-data', 'evaluationData')->name('evaluation-data');
                Route::get('evaluation-add', 'evaluationAdd')->name('evaluation-add');
                Route::post('evaluation-store', 'evaluationStore')->name('evaluation-store');
                Route::get('evaluation-edit/{employee_id}/{period_id}', 'evaluationEdit')->name('evaluation-edit');
                Route::post('evaluation-update/{employee_id}/{period_id}', 'evaluationUpdate')->name('evaluation-update');
                Route::delete('evaluation-delete/{employee_id}/{period_id}', 'evaluationDelete')->name('evaluation-delete');
            });
        });
    });

    Route::middleware('auth')->group(function () {
        Route::controller(SawProcessController::class)->group(function () {
            Route::get('sawprocess-data', 'sawProcess')->name('sawprocess-data');
            Route::post('sawprocess-calculate', 'calculate')->name('sawprocess-calculate');
            Route::get('sawprocess-result/{periodId}', 'showResult')->name('sawprocess-result');
        });
    });

    Route::middleware('auth')->group(function () {
        Route::controller(EmployeeRankController::class)->group(function () {
            Route::get('employee-rank', 'employeeRank')->name('employee-rank');
        });
    });

    Route::middleware('auth')->group(function () {
        Route::controller(ReportController::class)->group(function () {
            Route::get('report-data', 'reportData')->name('report-data');
            Route::get('report-data/rankings/{periodId}', 'getRankings')->name('report-data-rankings');
            Route::post('report-generate', 'generateReport')->name('report-generate');
            Route::get('report-export-pdf', 'exportPdf')->name('report-export-pdf');
            Route::get('report-export-excel', 'exportExcel')->name('report-export-excel');
        });
    });

    Route::middleware('auth')->group(function () {
        Route::controller(EmployeeGradeController::class)->group(function () {
            Route::get('employee-grade', 'employeeGrade')->name('employee-grade');
        });
    });

    Route::middleware('auth')->group(function () {
        Route::prefix('users')->name('users.')->group(function () {
            Route::controller(UserController::class)->group(function () {
                Route::get('user-data', 'userData')->name('user-data');
                Route::get('user-add', 'userAdd')->name('user-add');
                Route::post('/store', 'store')->name('users.store');
                Route::get('user-edit/{id}', 'userEdit')->name('user-edit');
                Route::post('user-update/{id}', 'userUpdate')->name('user-update');
                Route::delete('user-delete/{id}', 'userDelete')->name('user-delete');
            });
        });
    });

    Route::post('/heartbeat', function () {
        if (auth()->check()) {
            auth()->user()->update([
                'last_activity' => now()
            ]);
        }
        return response()->noContent();
    });


});
