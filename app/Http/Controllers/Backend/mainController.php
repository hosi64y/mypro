<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class mainController extends Controller
{
    public function index()
    {
        return "6767";
    }
    public function mainPage()
    {
        return view('admin\\layout\\master');
    }
}
