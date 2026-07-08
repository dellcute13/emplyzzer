<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Criteria;
use App\Models\Period;
use Illuminate\Http\Request;

class EmployeeGradeController extends Controller
{
    public function employeeGrade()
    {
        $employees = Employee::with(['position', 'department'])->get();
        $criterias = Criteria::orderBy('code')->get();
        $periods = Period::orderBy('year', 'desc')->orderBy('semester', 'desc')->get();
        return view('employee-grade.employee-grade-data', compact('employees', 'criterias', 'periods'));
    }
}
