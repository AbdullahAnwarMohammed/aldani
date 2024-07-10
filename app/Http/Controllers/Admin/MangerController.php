<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class MangerController extends Controller
{
    public function index()
    {
      $Admins = Admin::get();
       return view("admin.mangers.index",compact('Admins'));
    }

   
}
