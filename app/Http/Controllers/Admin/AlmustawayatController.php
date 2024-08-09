<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Almanhaj;
use App\Models\Almustawayat;
use App\Models\Part;
use Illuminate\Http\Request;

class AlmustawayatController extends Controller
{
    public function __construct()
    {
        $this-> middleware('permission:قائمة المستويات', ['only' => ['index']]);
        $this-> middleware('permission:قائمة المنهج', ['only' => ['almanhaj']]);
        $this-> middleware('permission:اضافة الاجزاء المضافة', ['only' => ['parts']]);

    }
    public function index()
    {
        $Almustawayas = Almustawayat::all();
        $Parts = Part::all();
        $Almanhajs = Almanhaj::all();

        return view("admin.almustawayat.index",compact('Almustawayas','Parts','Almanhajs'));
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name'=>'required|unique:almustawayats,name'
        ]);

        // Insert 
        Almustawayat::create([
            'name' => $request->name,
            'comment' => $request->comment
        ]);
        return response()->json(['status'=>201]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Category = Almustawayat::findOrFail($id);
        return response()->json($Category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {
        $Almustawaya = Almustawayat::where('id',$id)->first();

        return view("admin.almustawayat.edit",compact('Almustawaya'));

    }



    public function update(Request $request, string $id)
    {   
         // Validation
         $request->validate([
            'name'=>'required|unique:almustawayats,name,'.$id
        ]);

        // Insert 
        Almustawayat::where('id',$id)->update([
            'name' => $request->name,
            'comment' => $request->comment
        ]);
        // return response()->json(['status'=>201,'type'=>'update']);
        return redirect()->back()->with('success','تم التعديل بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Almustawayat::where('id',$id)->delete();
        return redirect()->back();

    }


    // الاجزاء المضافة
    public function parts($id)
    {
        $Parts = Part::where('almustawayat_id',$id)->get();
        $Almustawaya = Almustawayat::where('id',$id)->first();

        return view("admin.almustawayat.parts.index",compact('Parts','Almustawaya'));
    }

    // اضافة جزء 
    public function addPart(Request $request)
    {
        $validatedData = $request->validate([
            // unique
            'title.*' => 'required|string|numeric',
        ]);
    
        foreach ($request->title as $key => $Title) {
            Part::create([
                'title' => $Title,
                'comment' => $request->comment[$key],
                'almustawayat_id' => $request->idAlmustawaya
            ]);
        }
        return response()->json(['status' => 201]);

    }

    // عرض قيمة الجزء قبل التعديل
    public function showPart(Request $request,$id)
    {
        $Part = Part::findOrFail($id);
        return response()->json($Part);
    }

    // تعديل الجزء
    public function updatePart(Request $request,$id){
          // Validation
          $request->validate([
            'title'=>'required|unique:almustawayats,name,'.$id
        ]);

        // Insert 
        Part::where('id',$id)->update([
            'title' => $request->title[0],
            'comment' => $request->comment[0]
        ]);
        return response()->json(['status'=>201,'type'=>'update']);
    }

    // حذف الاجزاء
    public function destoryPart(string $id){
        Part::where('id',$id)->delete();
        return redirect()->back()->with('delete','تم الحذف بنجاح');
    }

    // المهنج
    public function almanhaj($idParat,$idAlmustawaya){
        $Almanhaj = Almanhaj::where('almustawayat_id',$idAlmustawaya)->where('part_id',$idParat)->get();
       
        return view("admin.almustawayat.almanhajs.index",compact('Almanhaj'));
    }

    // اضافة منهج جديد
    public function addAlmanhaj(Request $request)
    {
        $idAlmustawaya  = $request->idAlmustawaya;
        $idPart  = $request->idPart;

        $validatedData = $request->validate([
            'title.*' => 'required|string|unique:almanhajs,title',
        ]);

        foreach ($request->title as $key => $Title) {
            Almanhaj::create([
                'title' => $Title,
                'comment' => $request->comment[$key],
                'almustawayat_id' => $idAlmustawaya,
                'part_id' => $idPart
            ]);
        }

        return response()->json(['status' => 201]);

    }

    // تعديل المنعج
    public function updateAlmanhaj(Request $request,$id){
        // Validation

        $request->validate([
            'title'=>'required|unique:almustawayats,name,'.$id
        ]);
  
        // Insert 
        Almanhaj::where('id',$id)->update([
            'title' => $request->title[0],
            'comment' => $request->comment[0]
        ]);
        return response()->json(['status'=>201,'type'=>'update']);
  }
   
    // عرض قيمة المنهج قبل عملية التعديل
    public function showAlmanhaj($id){
        $Part = Almanhaj::findOrFail($id);
        return response()->json($Part);
    }
  
    // حذف المنهج
    public function destoryAlmanhaj($id){
        Almanhaj::where('id',$id)->delete();
        return redirect()->back()->with('delete','تم الحذف بنجاح');  
    }

    // تعديل المنهج
    public function almanhajEdit($id)
    {
        $Item = Almanhaj::where('id',$id)->first();

        return view("admin.almustawayat.almanhajs.edit",compact('Item'));

    }

    public function almanhajUpdate($id,Request $request)
    {
        Almanhaj::where('id',$id)->update([
            'title' => $request->title
        ]);
        return redirect()->back()->with('success','تم التعديل بنجاح');

    }
}
