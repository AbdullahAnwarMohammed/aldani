<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $Users = User::all();
        return view("admin.users.index",compact('Users'));
    }

    public function halqa_show($id)
    {
        $User = User::where('id',$id)->first();
        return view("admin.users.halqa",compact('User'));
    }

    public function info($id)
    {
        $User = User::where('id',$id)->first();

        return view("admin.users.details",compact('User'));
    }
}
