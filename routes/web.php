<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeGradeController;
use App\Http\Controllers\EmployeeRankController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SawProcessController;

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

    Route::controller(LoginController::class)->group(function () {

        // Logout
        Route::get('/logout', 'logout')->name('logout');

        // Optional Logout Page
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
            });
        });
    });

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
            });
        });
    });

    Route::middleware('auth')->group(function () {
        // --------------------- Pages ------------------//
        Route::controller(SawProcessController::class)->group(function () {
            Route::get('sawprocess-data', 'sawProcess')->name('sawprocess-data');
        });
    });

    Route::middleware('auth')->group(function () {
        // --------------------- Pages ------------------//
        Route::controller(EmployeeRankController::class)->group(function () {
            Route::get('employee-rank', 'employeeRank')->name('employee-rank');
        });
    });

    Route::middleware('auth')->group(function () {
        // --------------------- Pages ------------------//
        Route::controller(ReportController::class)->group(function () {
            Route::get('report-data', 'reportData')->name('report-data');
        });
    });

    Route::middleware('auth')->group(function () {
        // --------------------- Pages ------------------//
        Route::controller(EmployeeGradeController::class)->group(function () {
            Route::get('employee-grade', 'employeeGrade')->name('employee-grade');
        });
    });


    Route::middleware('auth')->group(function () {
        // --------------------- Projects ------------------//
        Route::prefix('apps-project')->group(function () {
            Route::controller(ProjectController::class)->group(function () {
                Route::get('list', 'list')->name('apps-project/list');
                Route::get('overview', 'overview')->name('apps-project/overview');
                Route::get('create', 'create')->name('apps-project/create');
            });
        });
    });

    Route::middleware('auth')->group(function () {
        // --------------------- Task ------------------//
        Route::prefix('apps-task')->group(function () {
            Route::controller(TaskController::class)->group(function () {
                Route::get('kanban-board', 'kanbanBoard')->name('apps-task/kanban-board');
                Route::get('list-view', 'listView')->name('apps-task/list-view');
                Route::get('task-details', 'taskDetails')->name('apps-task/task-details');
            });
        });
    });
});
