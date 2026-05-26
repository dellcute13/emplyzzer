<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeGradeController extends Controller
{
    public function employeeGrade()
    {
        $employees = Employee::get();
        return view('employee-grade.employee-grade-data', compact('employees'));
    }
}
