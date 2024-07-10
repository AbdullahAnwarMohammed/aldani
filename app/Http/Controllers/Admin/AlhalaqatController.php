<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alhalaqat;
use App\Models\Subdivision;
use App\Models\User;
use Illuminate\Http\Request;

class AlhalaqatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Alhalaqats = Alhalaqat::get();
        return view("admin.alhalaqat.index",compact('Alhalaqats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Users = User::get();
        return view("admin.alhalaqat.create",compact('Users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:alhalaqats,name'
        ]);
        Alhalaqat::create([
            'name' => $request->name,
            'descrption' => $request->descrption,
            'user_id' => $request->user_id,
            // 'subdivision_id' => $request->subdivision_id,
        ]);
        return redirect()->back()->with('success','تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Users = User::all();
        $Alhalaqat = Alhalaqat::where('id',$id)->first();

        return view("admin.alhalaqat.edit",compact('Users','Alhalaqat'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:alhalaqats,name,'.$id
        ]);
        Alhalaqat::where('id',$id)->update([
            'name' => $request->name,
            'descrption' => $request->descrption,
            'user_id' => $request->user_id,
        ]);
        return redirect()->back()->with('success','تم التعديل بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Alhalaqat::where('id',$id)->delete();
        return redirect()->route('admin.alhalaqat.index')->with('success','تم الحذف بنجاح');

    }
}
