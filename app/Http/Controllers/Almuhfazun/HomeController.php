<?php

namespace App\Http\Controllers\Almuhfazun;

use App\Http\Controllers\Controller;
use App\Models\Alhalaqat;
use App\Models\Almanhaj;
use App\Models\Almustawayat;
use App\Models\Group;
use App\Models\Part;
use App\Models\Talib;
use App\Models\TalibInGroup;
use App\Models\Tasmie;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    protected $parts = [];
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
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="talib_checkbox" name="talib_checkbox[]" value="' . $row->id . '">';
                })

                ->addColumn('get_name', function ($Talib) {
                    return '<a class="get_info_talib" 
                 data-bs-toggle="modal" data-name="' . $Talib->name . '" data-id=' . $Talib->id . ' data-bs-target="#modalStudent"
                >' . $Talib->name . '</a>';
                })
                ->addColumn('colors', function ($Talib) use ($date) {
                    $class = "";
                    if ($Talib->attend($date) == 1) {
                        $class = "success";
                        $text = "حاضر";
                    } else if ($Talib->attend($date) == 2) {
                        $class = "warning";
                        $text = "غائب بعذر";
                    } else if ($Talib->attend($date) == 3) {
                        $class = "primary";
                        $text = "حاضر اون لاين";
                    } else if ($Talib->attend($date) == '') {
                        $class = "";
                        $text = "";
                    } else {
                        $class = "danger";
                        $text = "غائب";
                    }
                    return '
                    <div class="btn btn-sm btn-' . $class . '">' . $text . '</div>
                    ';
                })
                ->addColumn('level', function ($Talib) {
                    return $Talib->almustawayat->name;
                })
                ->addColumn('degree', function ($Talib) use ($date) {
                    return $Talib->degree($date) ? $Talib->degree($date)->degree : "...";
                })
                ->addColumn('phone', function ($Talib) {
                    return '<a href="https://wa.me/' . $Talib->father_phone . '"> ' . $Talib->father_phone . '</a>';
                })
                ->rawColumns(['get_name', 'checkbox', 'colors', 'phone'])
                ->make(true);
        }


        // المجموعات 
        $Groups = Group::where('user_id', auth()->user()->id)->get();

        return view("almuhfazun.home.index", compact('Alhalaqats', 'Almustawayats', 'Groups'));
    }

    private function setParts($arr)
    {
        $this->parts = $arr;
    }

    private function getParts()
    {
        return $this->parts;
    }



    // معرفة بيانات الطلاب 
    public function talib_info(Request $request, $id)
    {

        $Talib = Talib::where('id', $id)->with('aldafeuh','alhalaqat', 'almustawayat')->first();
        $Parts = Part::where('almustawayat_id', $Talib->almustawayat_id)->get();
        $this->setParts($Parts);
        $Tasmie = Tasmie::where('talib_id', $id)
            ->where('date', $request->date)
            ->first();
        if ($Tasmie !== null) {
            $Tasmie = $this->updateStudentTasmie($Tasmie, $Talib->name, $request->date);
        }


        return response()->json([
            'Talibs' => $Talib,
            'Parts' => $Parts,
            'Tasmie' => $Tasmie
        ]);
        // }
    }



    private function updateStudentTasmie($Talib, $name_talib, $date)
    {
        $data = '';
        $parts = '';
        $almanhajs = '';


        // المناهج
        $almanhajs =  $Talib->almanhaj_id;
        $Almanhaj_ID =  Almanhaj::where('id', $almanhajs)->pluck('almustawayat_id')->first();
        $almanhajs = Almanhaj::where('almustawayat_id', $Almanhaj_ID)->get();
        foreach ($almanhajs as $item) {
            if ($item->id == $Talib->almanhaj_id) {
                $almanhajs .= '<option value=' . $item->id . ' selected>' . $item->title . '</option>';
            } else {
                $almanhajs .= '<option value=' . $item->id . '>' . $item->title . '</option>';
            }
        }

        // الاجزاء
        $getParts = $this->getParts();
        foreach ($getParts as $item) {
            if ($item->id == $Talib->part_id) {
                $parts .= '<option value=' . $item->id . ' selected>' . $item->title . '</option>';
            } else {
                $parts .= '<option value=' . $item->id . '>' . $item->title . '</option>';
            }
        }

        // عدد الارباع 
        $number_of_quarters = '';
        foreach ([1, 2, 3, 4, 5, 6, 7, 8] as $index) {
            if ($Talib->number_of_quarters == $index) {
                $number_of_quarters .=
                    '<option selected value=' . $index . '>' . $index . '</option>';
            } else {
                $number_of_quarters .=
                    '<option value=' . $index . '>' . $index . '</option>';
            }
        }



        $data .= '
<h4>اسم الحافظ : ' . $name_talib . '</h4>
<span>' . $date . '</span>
<form id="tasmie_update"  method="POST">

       <input type="hidden" id="tasmie_id" name="tasmie_id" value="' . $Talib->id . '" />
    <input type="hidden" name="hidden_date" value="' . $date . '"  id="hidden_date" />

        <div class="row my-2 bg-success text-white p-2">
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
   <select name="attend"  class="form-control attend">
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
                <select name="attend" id="attend" class="form-control">
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
           <select name="part_id" class="form-control parts">
          ' . $parts . '
        </select>

    </div>
        <div class="form-group">
        <labe>عدد الارباع</label>
           <select name="number_of_quarters" class="form-control">
            ' . $number_of_quarters . '
        </select>
        
    </div>
        <div class="form-group">
        <labe>المنهج</label>
           <select required id="almanhaj" name="almanhaj_id" class="form-control">
           ' . $almanhajs . '
         </select>
        
    </div>
        <div class="form-group">
        <labe>الدرجة</label>
        <input type="text" value=' . $Talib->degree . ' required name="degree" class="form-control degree" />
        
    </div>
        <div class="form-group">
            <labe>الملاحظة</label>
        <input type="text" value="' . $Talib->comment . '"  name="comment" class="form-control" />
           </div>

           <div class="form-group">
            <input type="submit"  class="btn btn-success my-2" value="حفظ" />
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
            'user_id' => auth()->user()->id,
            'attend' => $request->attend,
            'part_id' => $request->part_id,
            'alhalaqat_id' => $request->alhalaqat_id,
            'session_id' => getYearSetting()->session_id,
            'almanhaj_id' => $request->almanhaj_id,
            'number_of_quarters' => $request->number_of_quarters,
            'degree' => $request->degree,
            'comment' => $request->comment,
            'date' => $request->hidden_date,
        ]);
        return response()->json('success');
    }

    // تعديل بيانات التسميع 
    public function updateTasmie(Request $request, $id)
    {
        //`talib_id`, `attend`, `part_id`, `almanhaj_id`, `number_of_quarters`, `degree`, `comment`
        Tasmie::where('id', $id)->update([
            'attend' => $request->attend,
            'part_id' => $request->part_id,
            'almanhaj_id' => $request->almanhaj_id,
            'number_of_quarters' => $request->number_of_quarters,
            'degree' => $request->degree,
            'comment' => $request->comment
        ]);
        return response()->json('success');
    }


    // جلب الغرفة
    public function getRoom($id)
    {
        return Alhalaqat::where('id', $id)->first();
    }


    // انشاء مجموعة جديدة
    public function createRoom(Request $request)
    {
        $room_name = $request->room_name;
        $check =  Group::where('id', auth()->user()->id)->where('name', $room_name)->count();
        if ($check >= 1) {
            return response()->json('founded');
        }

        Group::create([
            'user_id' => auth()->user()->id,
            'name' => $room_name
        ]);
        return response()->json('success');
    }

    // ادخال الطلاب داخل مجموعة معينة 

    public function insertGroup(Request $request)
    {
        ///talib_id	user_id	group_id
        $id_group =  $request->id_group;
        $selectedValues = $request->selectedValues; // array 
        foreach ($selectedValues as $item) {
            $check = TalibInGroup::where('talib_id', $item)
                ->where('group_id', $id_group)->get();
            if (count($check) == 0) {
                TalibInGroup::create([
                    'talib_id' => $item,
                    'user_id' => auth()->user()->id,
                    'group_id' => $id_group
                ]);
            }
        }
        return response()->json('success');
    }

    // حذف المجموعة
    public function deleteGroup($id)
    {
        Group::where('id', $id)->delete();
        return redirect()->back()->with('delete-group', 'تم حذف الجروب بنجاح');
    }

    public function groupOpen(Request $request)
    {
        $TalibInGroup = TalibInGroup::where('group_id', $request->id)->pluck('talib_id');
        $Talibs = Talib::whereIn('id', $TalibInGroup)->get();
        if (count($Talibs) > 0) {
            return response()->json($Talibs);
        }
        return 'empty';
    }

    // حذف الاشخاص من المجموعة
    public function deletePersonFromGroup(Request $request)
    {
        $id_talib = $request->id_talib;
        $id_group = $request->id_group;
        TalibInGroup::where('talib_id', $id_talib)
            ->where('group_id', $id_group)
            ->delete();
        return response()->json('success');
    }
}
