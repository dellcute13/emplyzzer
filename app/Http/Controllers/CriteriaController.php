<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function criteriaData()
    {
        return view('criteria.criteria-data');
    }

    public function criteriaAdd()
    {
        return view('criteria.criteria-add');
    }
}
