<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeRankController extends Controller
{
    public function employeeRank()
    {
        return view('employee-rank.rank-data');
    }
}
