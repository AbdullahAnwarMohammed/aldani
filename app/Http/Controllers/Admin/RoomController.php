<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alhalaqat;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Rooms = Room::all();
        return view("admin.rooms.index", compact('Rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Rooms = Room::pluck('alhalaqat_id')->toArray();
        $Alhalaqats = Alhalaqat::whereNotIn('id', $Rooms)->get();

        return view("admin.rooms.create", compact('Alhalaqats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => ' url'
        ]);

        Room::create([
            'name' => $request->name,
            'url' => $request->url,
            'alhalaqat_id' => $request->alhalaqat_id,
        ]);
        return redirect()->back()->with('success', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Room = Room::where('id', $id)->first();

        $Rooms = Room::where('id','!=',$Room->id)->pluck('alhalaqat_id')->toArray();
        $Alhalaqats = Alhalaqat::whereNotIn('id', $Rooms)->get();

        return view("admin.rooms.edit", compact('Room', 'Alhalaqats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'url' => ' url'
        ]);

        Room::where('id',$id)->update([
            'name' => $request->name,
            'url' => $request->url,
            'alhalaqat_id' => $request->alhalaqat_id,
        ]);

        return redirect()->back()->with('success','تم تعديل البيانات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
