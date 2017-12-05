<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Changelog;

class ChangelogController extends Controller
{
    public function show()
    {
        $changelog = Changelog::orderBy('id','desc')->get();

        return view('changelog')->with(compact('changelog'));
    }
}
