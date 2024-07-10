<?php

namespace App\Http\Controllers\Almuhfazun;

use App\Http\Controllers\Controller;
use App\Models\Alhalaqat;
use App\Models\Almanhaj;
use App\Models\Almustawayat;
use App\Models\Part;
use App\Models\Talib;
use App\Models\Tasmie;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $Alhalaqats = Alhalaqat::where('user_id', auth()->user()->id)->get();


        $Almustawayats = Almustawayat::get();

        if ($request->ajax()) {


            $Alhalqats = auth()->user()->alhalaqats->pluck('id')->toArray();


            if ($request->Alhalaqat) {
                $Talibs = Talib::where('alhalaqat_id', $request->Alhalaqat);
            } else {
                $Talibs = Talib::whereIn('alhalaqat_id', $Alhalqats);
            }



            if ($request->Almustawaya) {
                $Talibs = $Talibs->where('almustawayat_id', $request->Almustawaya);
            }

            if ($request->date) {
                $date = $request->date;
            } else {
                $date = date("Y-m-d");
            }


            $Talibs = $Talibs->get();

            return DataTables::of($Talibs)
                ->addIndexColumn()
                ->addColumn('get_name', function ($Talib) {
                    return '<a class="get_info_talib" 
                 data-bs-toggle="modal" data-name="' . $Talib->name . '" data-id=' . $Talib->id . ' data-bs-target="#modalStudent"
                >' . $Talib->name . '</a>';
                })
                ->addColumn('level', function ($Talib) {
                    return $Talib->almustawayat->name;
                })
                ->addColumn('degree', function ($Talib) use ($date) {
                    return $Talib->degree($date) ? $Talib->degree($date)->degree : "لم يسمع";
                })
                ->addColumn('phone', function ($Talib) {
                    return '<a href="https://wa.me/' . $Talib->father_phone . '"> ' . $Talib->father_phone . '</a>';
                })
                ->rawColumns(['get_name', 'phone'])
                ->make(true);
        }



        return view("almuhfazun.home.index", compact('Alhalaqats', 'Almustawayats'));
    }

    // معرفة بيانات الطلاب 
    public function talib_info(Request $request, $id)
    {
        // $Tasmie = Tasmie::where('talib_id', $id)
        //     ->where('date', $request->date)
        //     ->with(['talib', 'talib.aldafeuh', 'talib.almustawayat', 'part', 'almanhaj'])
        //     ->first();

        // if (isset($Tasmie)) {
        //     return [
        //         'founed' => 'true',
        //         'Tasmie' => $Tasmie
        //     ];
        // } else {




        $Talib = Talib::where('id', $id)->with('aldafeuh', 'almustawayat')->first();
        $Parts = Part::where('almustawayat_id', $Talib->almustawayat_id)->get();

        $Tasmie = Tasmie::where('talib_id', $id)
            ->where('date', $request->date)
            ->first();
        if ($Tasmie !== null) {
            $Tasmie = $this->updateStudentTasmie($Tasmie, $request->date);
        }


        return response()->json([
            'Talibs' => $Talib,
            'Parts' => $Parts,
            'Tasmie' => $Tasmie
        ]);
        // }
    }

    private function updateStudentTasmie($Talib, $date)
    {
        $data = '';
        $parts = '';
        foreach($Talib->part as $item)
        {
            $parts .=
            '
            <option value='.$item->id.'>'.$item->title.'</option>
            ';
        }
        $data .= '
<h4>تعديل بيانات : ' . $Talib->name . '</h4>
<form id="tasmie_update"  method="POST">
   
    <input type="hidden" name="talib_id" value="' . $Talib->id . '" />
    <input type="hidden" name="hidden_date" value="' . $date . '"  id="hidden_date" />

        <div class="row my-2 bg-dark text-white p-2">
            <div class="col">
    الدفعه :' . $Talib->talib->aldafeuh->name . '

            </div>
            <div class="col">
        المستوي : ' . $Talib->talib->almustawayat->name . '

            </div>
        </div>
    <div class="form-group">
        <labe>الحضور</label>
           ';
        if ($Talib->attend == 1) {
            $data .= '
   <select name="attend" class="form-control">
            <option value="1" selected>حاضر</option>
            <option value="3" >حاضر اون لاين</option>
            <option value="0">غائب</option>
            <option  value="2">غائب بعذر</option>
            ';
        } else if ($Talib->attend == 3) {
            $data .= '
   <select name="attend" class="form-control">
            <option value="1" >حاضر</option>
            <option value="3" selected>حاضر اون لاين</option>
            <option value="0">غائب</option>
            <option  value="2">غائب بعذر</option>
            ';
        } else if ($Talib->attend == 0) {
            $data .= '
   <select name="attend" class="form-control">
            <option value="1" >حاضر</option>
            <option value="3" >حاضر اون لاين</option>
            <option value="0" selected>غائب</option>
            <option  value="2">غائب بعذر</option>
            ';
        } else {
            $data .= '
                <select name="attend" class="form-control">
            <option value="1" >حاضر</option>
            <option value="3" >حاضر اون لاين</option>
            <option value="0">غائب</option>
            <option  value="2" selected>غائب بعذر</option>
            ';
        }
        $data .= '
    </select>
    </div>


          <div class="form-group">
        <labe>الجزء</label>
           <select id="parts" name="part_id" class="form-control">
          '.$parts.'
        </select>

    </div>
        <div class="form-group">
        <labe>عدد الارباع</label>
           <select name="number_of_quarters" class="form-control">
            ${number_of_quarters} 
        </select>
        
    </div>
        <div class="form-group">
        <labe>المنهج</label>
           <select required id="almanhaj" name="almanhaj_id" class="form-control">
         </select>
        
    </div>
        <div class="form-group">
        <labe>الدرجة</label>
        <input type="text" required name="degree" class="form-control" />
        
    </div>
        <div class="form-group">
            <labe>الملاحظة</label>
        <input type="text" name="comment" class="form-control" />
           </div>

           <div class="form-group">
            <input type="submit"  class="btn btn-primary my-2" value="ادخال النتيجة" />
            </div>  
    </form>
        ';

        return $data;
    }


    // جلب بيانات المنهج 
    public function getAlmanhaj($id)
    {

        $options = Almanhaj::where('part_id', $id)->get();
        return response()->json($options);
    }


    // ادخال نتائج التسميع

    public function insertTasmie(Request $request)
    {
        $talib_id =  $request->talib_id;
        Tasmie::create([
            'talib_id' => $talib_id,
            'attend' => $request->attend,
            'part_id' => $request->part_id,
            'almanhaj_id' => $request->almanhaj_id,
            'number_of_quarters' => $request->number_of_quarters,
            'degree' => $request->degree,
            'comment' => $request->comment,
            'date' => $request->hidden_date,
        ]);
        return response()->json('success');
    }
}
