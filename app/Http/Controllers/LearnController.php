<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearnController extends Controller
{
    public function test(Request $request)
    {
        //$_SESSION['name] = 'dd';
        $request->session()->put('name', 'dd');
    }

    public function test2(Request $request)
    {
        dd($request->session()->get('name'));
    }
}
