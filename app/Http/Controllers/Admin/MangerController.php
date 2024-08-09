<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class MangerController extends Controller
{
    public function index()
    {
      
      $Admins = Admin::get();

      $roles = Role::pluck('name','name')->all();

       return view("admin.mangers.index",compact('Admins','roles'));
    }

   
}
