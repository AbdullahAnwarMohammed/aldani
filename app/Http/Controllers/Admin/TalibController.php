<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alhalaqat;
use App\Models\Almustawayat;
use App\Models\Subscrption;
use App\Models\Talib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TalibController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Talibs = Talib::get();

        return view("admin.talibs.index", compact('Talibs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Alhalaqats  = Alhalaqat::get();
        $Almustawayats =     Almustawayat::get();

        return view("admin.talibs.create", compact('Alhalaqats', 'Almustawayats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subscrption = $request->subscrption == "on" ? 1 : 0;


        $request->validate([
            'name' => 'required|unique:talibs,name',
            'phone' => 'numeric|required|digits:8',
            'father_phone' => 'numeric|required|digits:8',
            'cid' => 'required|unique:talibs,cid|digits:12|numeric'
        ]);
        if ($subscrption == 1) {
            $request->validate([
                'reg_start' => 'required|date',
                'reg_end' => 'required|date|after:reg_start',
                'required_value' => 'numeric',
                'paid_value' => 'numeric|lte:required_value'
            ]);
        }

        $image_name = NULL;
        if($request->photo)
        {
                 $image = $request->file('photo');
                $image_name =  time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('uploads/tailbs/'), $image_name);
        }
        $Talib = Talib::create([
            'alhalaqat_id' => $request->alhalaqat_id,
            'almustawayat_id' => $request->almustawayat_id,
            'name' => $request->name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'father_phone' => $request->father_phone,
            'country_id' => $request->nationality,
            'cid' => $request->cid,
            'subscrption' => $subscrption,
            'aldafeuh_id' => $request->aldafeuh,
            'photo' => $image_name
        ]);

        if ($subscrption == 1) {

            $Subscrption = Subscrption::create([
                'talib_id' => $Talib->id,
                'reg_start' => $request->reg_start,
                'reg_end' => $request->reg_end,
                'required_value' => $request->required_value,
            ]);

            DB::table('payments')->insert([
                'talib_id' => $Talib->id,
                'subscrption_id' => $Subscrption->id,
                'paid_value' => $request->paid_value,
            ]);
        }



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
        $Tailb = Talib::where('id',$id)->first();
        $Alhalaqats  = Alhalaqat::get();
        $Almustawayats =     Almustawayat::get();

        return view("admin.talibs.edit",compact('Tailb','Alhalaqats','Almustawayats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        
        
        // if($request->subscrption_update == 0)
        // {

            $subscrption = $request->subscrption == "on" ? 1 : 0;

        // }else{
        //     $subscrption = $request->subscrption_update;
        // }
        $request->validate([
            'name' => 'required|unique:talibs,name,'.$id,
            'phone' => 'numeric|nullable',
            'cid' => 'required|digits:12|numeric|unique:talibs,cid,'.$id
        ]);
        // if ($subscrption == 1) {
        //     $request->validate([
        //         'reg_start' => 'required|date',
        //         'reg_end' => 'required|date|after:reg_start',
        //         'required_value' => 'numeric',
        //         'paid_value' => 'numeric|lte:required_value'
        //     ]);
        // }

        $image_name = $request->imageUpdate;
        if($request->photo)
        {
            if (File::exists(public_path('uploads/tailbs/' . $request->imageUpdate))) {
                File::delete(public_path('uploads/tailbs/' . $request->imageUpdate));
            }

                 $image = $request->file('photo');
                $image_name =  time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('uploads/tailbs/'), $image_name);
        }
        $Talib = Talib::where('id',$id)->update([
            'alhalaqat_id' => $request->alhalaqat_id,
            'almustawayat_id' => $request->almustawayat_id,
            'name' => $request->name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'father_phone' => $request->father_phone,
            'country_id' => $request->nationality,
            'cid' => $request->cid,
            'subscrption' => $subscrption,
            'aldafeuh_id' => $request->aldafeuh,
            'photo' => $image_name
        ]);

        // if ($subscrption == 1) {

        //     $Subscrption = Subscrption::create([
        //         'talib_id' => $id,
        //         'reg_start' => $request->reg_start,
        //         'reg_end' => $request->reg_end,
        //         'required_value' => $request->required_value,
        //     ]);

        //     DB::table('payments')->insert([
        //         'talib_id' => $id,
        //         'subscrption_id' => $Subscrption->id,
        //         'paid_value' => $request->paid_value,
        //     ]);
        // }



        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       Talib::where('id',$id)->delete();
       return redirect()->back()->with('delete','تم الحذف');
    }

    // استعراض بيانات الحافظ بناءاً على الحلقة
    public function users_by_halqa($id)
    {
        $Alhalaqat = Alhalaqat::where('id',$id)->first();
        return view("admin.talibs.halqa",compact('Alhalaqat'));
    }


    // تفاصيل كل طالب
    public function details($id)
    {
        $Talib = Talib::where('id',$id)->first();
        return view("admin.talibs.details",compact('Talib'));
    }
}
