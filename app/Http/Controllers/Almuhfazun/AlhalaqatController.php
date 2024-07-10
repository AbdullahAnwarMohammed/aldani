<?php

namespace App\Http\Controllers\Almuhfazun;

use App\Http\Controllers\Controller;
use App\Models\Alhalaqat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDOException;

class AlhalaqatController extends Controller
{
    public function index($id)
    {
      
        $Alhalaqat = Alhalaqat::where('id',$id)->where('user_id',Auth::user()->id)->first();
        if($Alhalaqat)
        {
        return view("almuhfazun.alhalaqat.index",compact('Alhalaqat'));
        }
        
        return redirect()->back();

        
    }

    public function update(Request $request)
    {
        dd($request->all());
    }
}
