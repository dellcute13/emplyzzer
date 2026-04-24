<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeGradeController extends Controller
{
    public function employeeGrade()
    {
        return view('employee-grade.employee-grade-data');
    }
}
