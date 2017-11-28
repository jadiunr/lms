<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Changelog;

class ChangelogController extends Controller
{
    public function show()
    {
        $changelog = Changelog::all();

        return view('changelog')->with(compact('changelog'));
    }
}
