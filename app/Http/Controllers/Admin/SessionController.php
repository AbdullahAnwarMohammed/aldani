<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $Sessions = Session::get();

        return view("admin.sessions.index",compact('Sessions'));
    }

    public function store(Request $request)
    {
          // Validation
          $request->validate([
            'name'=>'required|unique:sessions,name'
        ]);

        // Insert 
        Session::create([
            'name' => $request->name,
            'from' => $request->from,
            'to' => $request->to
        ]);
        return response()->json(['status'=>201]);
    }

    public function show($id){
        $Session = Session::where('id',$id)->first();
        return response()->json($Session);
    }


    public function update(Request $request ,$id)
    {
        Session::where('id',$id)->update([
            'name' => $request->name,
            'from' => $request->from,
            'to' => $request->to
        ]);
        return response()->json(['status'=>201,'type'=>'update']);

    }
    public function destory($id)
    {
        Session::where('id',$id)->delete();
        return redirect()->back();

    }
}
