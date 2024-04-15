<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admincontroller extends Controller
{
    public function __invoke()
    {
        return view('admin.index');
    }
}
