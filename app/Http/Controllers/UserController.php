<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userData()
    {
        return view('user.user-data');
    }

    public function userAdd()
    {
        return view('user.user-add');
    }
}
