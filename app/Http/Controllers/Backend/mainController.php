<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class mainController extends Controller
{

    public function mainPage()
    {
        return view('admin\\main\\index');
    }
}
