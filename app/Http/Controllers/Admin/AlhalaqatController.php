<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alhalaqat;
use App\Models\Subdivision;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class AlhalaqatController extends Controller
{
    public function __construct()
    {
        $this-> middleware('permission:قائمة الحلقات', ['only' => ['index']]);
        // $this-> middleware('permission:عرض المنهج', ['only' => ['almanhaj']]);
        // $this-> middleware('permission:عرض الاجزاء المضافة', ['only' => ['parts']]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Alhalaqats = Alhalaqat::whereIn('type',maleOrFemaleForAdmin())->get();
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
            'name' => 'required|unique:alhalaqats,name',
            'room_url' => 'nullable|url'
        ]);
        Alhalaqat::create([
            'name' => $request->name,
            'descrption' => $request->descrption,
            'user_id' => $request->user_id,
            'room_url' => $request->room_url,
            'type' => $request->type,
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
            'name' => 'required|unique:alhalaqats,name,'.$id,
            'room_url' => 'nullable|url'

        ]);
        Alhalaqat::where('id',$id)->update([
            'name' => $request->name,
            'descrption' => $request->descrption,
            'user_id' => $request->user_id,
            'room_url' => $request->room_url,
            'type' => $request->type,

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

    public function get_by_type($id)
    {
       return User::where('gender',$id)->get();

    }




    public function getAlhalaqaByTalb(Request $request)
    {
         $gender = $request->gender;
       $alhaqatas  = Alhalaqat::where('type',$gender)->get();


        return response()->json(['alhaqa' => $alhaqatas]);

    }
}
