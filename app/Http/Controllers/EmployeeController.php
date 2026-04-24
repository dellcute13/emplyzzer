<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function employeeData()
    {
        return view('employee.employee-data');
    }

    public function employeeAdd()
    {
        return view('employee.employee-add');
    }
}
