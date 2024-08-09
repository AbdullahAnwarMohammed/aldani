<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talib;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this-> middleware('permission:قائمة الرئيسية', ['only' => ['index']]);
        // $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        // $this->middleware('permission:update role', ['only' => ['update','edit']]);
        // $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }
    public function index()
    {
        $Talibs = Talib::get();

        return view("admin.home.index",compact('Talibs'));
    }

    
}
