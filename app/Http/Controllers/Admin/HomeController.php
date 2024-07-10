<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talib;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $Talibs = Talib::get();

        return view("admin.home.index",compact('Talibs'));
    }
}
