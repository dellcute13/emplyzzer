<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SawProcessController extends Controller
{
    public function sawProcess()
    {
        return view('saw.sawprocess-data');
    }
}
