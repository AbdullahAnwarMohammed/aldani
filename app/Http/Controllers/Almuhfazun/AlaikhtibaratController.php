<?php

namespace App\Http\Controllers\almuhfazun;

use App\Http\Controllers\Controller;
use App\Models\Alaikhtibarat;
use App\Models\Alhalaqat;
use App\Models\Talib;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AlaikhtibaratController extends Controller
{
    public function index(Request $request)
    {

        $Alhalaqats = Alhalaqat::where('type', auth()->user()->gender)->get();
        $currentYear = Carbon::now()->year;
        $session_id = $request->session_id;

        if ($request->ajax()) {
            if ($request->Alhalaqat) {

                $Talibs = Talib::where('alhalaqat_id', $request->Alhalaqat)->get();
            } else {
                $Talibs = Talib::where('gender', auth()->user()->gender)->get();
            }

            return DataTables::of($Talibs)
                ->addIndexColumn()
                ->addColumn('get_name', function ($Talib) {
                    return '<a class="get_info_talib" 
                 data-bs-toggle="modal" data-name="' . $Talib->name . '" data-id=' . $Talib->id . ' data-bs-target="#modalStudent"
                >' . $Talib->name . '</a>';
                })
                ->addColumn('test_1', function ($Talib) use ($currentYear, $session_id) {
                    $Alaikhtibarat = Alaikhtibarat::where('talib_id', $Talib->id)
                        ->whereYear('created_at', $currentYear)
                        ->where('session_id', $session_id)
                        ->first();
                    return isset($Alaikhtibarat->test1) ? $Alaikhtibarat->test1 : '..';
                })
                ->addColumn('test_2', function ($Talib) use ($currentYear, $session_id) {
                    $Alaikhtibarat = Alaikhtibarat::where('talib_id', $Talib->id)
                        ->whereYear('created_at', $currentYear)
                        ->where('session_id', $session_id)
                        ->first();
                    return isset($Alaikhtibarat->test2) ? $Alaikhtibarat->test2 : '..';
                })
                ->addColumn('test_3', function ($Talib) use ($currentYear, $session_id) {
                    $Alaikhtibarat = Alaikhtibarat::where('talib_id', $Talib->id)
                        ->whereYear('created_at', $currentYear)
                        ->where('session_id', $session_id)
                        ->first();
                    return isset($Alaikhtibarat->test3) ? $Alaikhtibarat->test3 : '..';
                })
                ->addColumn('test_4', function ($Talib) use ($currentYear, $session_id) {
                    $Alaikhtibarat = Alaikhtibarat::where('talib_id', $Talib->id)
                        ->whereYear('created_at', $currentYear)
                        ->where('session_id', $session_id)
                        ->first();
                    return isset($Alaikhtibarat->test4) ? $Alaikhtibarat->test4 : '..';
                })

                ->rawColumns(['get_name'])

                ->make(true);;
        }
        return view("almuhfazun.alaikhtibarat.index", compact('Alhalaqats'));
    }

    public function info(Request $request, $id)
    {
        $session_name = $request->session_name;
        $session_id = $request->session_id;
        $talib_id = $request->talib_id;

        $username = $request->username;
        $almustawayat = $request->Almustawayats;

        $currentYear = Carbon::now()->year;

        $year = $request->year;

        $Check = Alaikhtibarat::where('talib_id', $id)
            ->where('session_id', $request->session_id)
            ->whereYear('created_at', $currentYear)
            ->get();
        if (count($Check) > 0) {

            return $this->form_update($session_id, $talib_id, $username, $session_name, $almustawayat);
        } else {
            return $this->form_insert($session_name, $session_id, $username, $almustawayat, $talib_id, $year);
        }
    }

    private function form_insert($session_name, $session_id, $username, $Almustawayats, $talib_id, $year)
    {
        $return = '';

        $return .= '
        <form id="form_insert_alaikhtibarat">

       <input type="hidden" name="type" value=' . $Almustawayats . '  />
       <input type="hidden" name="talib_id" value=' . $talib_id . ' />
       <input type="hidden" name="session_id" value=' . $session_id . '  />
        
        
        <div class="form-group">
        <label class="d-block">العام الدراسي : ' . $year . '</label>
        <label>الطالب : ' . $username . '</label>
        <label class="d-block">الفاصل : ' . $session_name . ' </label>
        <label>' . $this->getAlmustawayaName($Almustawayats) . '</label>
        ';
        if ($Almustawayats == 'all') {
            $return .= '
   <input type="text" name="test1" placeholder="الاختبار الاول" class="form-control" />
        <input type="text" name="test2" placeholder="الاختبار الثاني"  class="form-control my-2" />
        <input type="text" name="test3"  placeholder="الاختبار السرد"class="form-control"/>
        <input type="text" name="test4" placeholder="الاختبار النهائي" class="form-control my-2" />
            ';
        } else if ($Almustawayats == 1) {
            $return .= '
            <input type="text" name="test1" placeholder="الاختبار الاول" class="form-control" />
            ';
        } else if ($Almustawayats == 2) {
            $return .= '
        <input type="text" name="test2" placeholder="الاختبار الثاني"  class="form-control my-2" />
            ';
        } else if ($Almustawayats == 3) {
            $return .= '
        <input type="text" name="test3"  placeholder="الاختبار السرد"class="form-control"/>
            ';
        } else {
            $return .= '<input type="text" name="test4" placeholder="الاختبار النهائي" class="form-control my-2" />';
        }


        $return .= '
        <input type="submit" class="btn btn-success my-4" value="اضافة" />
        <button type="button" class="btn btn-danger btn-close-modal" data-bs-dismiss="modal">اغلاق</button>

        </div>
        </form>
        ';
        return $return;
    }

    private function form_update($session_id, $talib_id, $username, $session_name, $Almustawayats)
    {

        $Alaikhtibarat = Alaikhtibarat::where('talib_id', $talib_id)
            ->where('session_id', $session_id)
            ->first();
        $return = '';
        $return .= '
        <h5>تعديل : ' . $username . '</h5>
        <form id="form_update_alaikhtibarat">
        <input type="hidden" name="id" value=' . $Alaikhtibarat->id . ' />
            <label class="d-block">الفاصل : ' . $session_name . ' </label>
        <label>' . $this->getAlmustawayaName($Almustawayats) . '</label>
        ';
        if ($Almustawayats == 'all') {
            $return .= '
        <input type="text" name="test1"  value="' . $Alaikhtibarat->test1 . '"  placeholder="الاختبار الاول" class="form-control" />
        <input type="text" name="test2"  value="' . $Alaikhtibarat->test2 . '" placeholder="الاختبار الثاني"  class="form-control my-2" />
        <input type="text" name="test3"  value="' . $Alaikhtibarat->test3 . '"  placeholder="الاختبار السرد"class="form-control"/>
        <input type="text" name="test4"  value="' . $Alaikhtibarat->test4 . '" placeholder="الاختبار النهائي" class="form-control my-2" />
            ';
        } else if ($Almustawayats == 1) {
            $return .= '
        <input type="text" name="test1"  value="' . $Alaikhtibarat->test1 . '"  placeholder="الاختبار الاول" class="form-control" />
        <input type="hidden" name="test2"  value="' . $Alaikhtibarat->test2 . '" placeholder="الاختبار الثاني"  class="form-control my-2" />
        <input type="hidden" name="test3"  value="' . $Alaikhtibarat->test3 . '"  placeholder="الاختبار السرد"class="form-control"/>
        <input type="hidden" name="test4"  value="' . $Alaikhtibarat->test4 . '" placeholder="الاختبار النهائي" class="form-control my-2" />
            ';
        } else if ($Almustawayats == 2) {
            $return .= '
        <input type="hidden" name="test1"  value="' . $Alaikhtibarat->test1 . '"  placeholder="الاختبار الاول" class="form-control" />
        <input type="text" name="test2"  value="' . $Alaikhtibarat->test2 . '" placeholder="الاختبار الثاني"  class="form-control my-2" />
        <input type="hidden" name="test3"  value="' . $Alaikhtibarat->test3 . '"  placeholder="الاختبار السرد"class="form-control"/>
        <input type="hidden" name="test4"  value="' . $Alaikhtibarat->test4 . '" placeholder="الاختبار النهائي" class="form-control my-2" />
            ';
        } else if ($Almustawayats == 3) {
            $return .= '
        <input type="hidden" name="test1"  value="' . $Alaikhtibarat->test1 . '"  placeholder="الاختبار الاول" class="form-control" />
        <input type="hidden" name="test2"  value="' . $Alaikhtibarat->test2 . '" placeholder="الاختبار الثاني"  class="form-control my-2" />
        <input type="text" name="test3"  value="' . $Alaikhtibarat->test3 . '"  placeholder="الاختبار السرد"class="form-control"/>
        <input type="hidden" name="test4"  value="' . $Alaikhtibarat->test4 . '" placeholder="الاختبار النهائي" class="form-control my-2" />
            ';
        } else {
            $return .= '
        <input type="hidden" name="test1"  value="' . $Alaikhtibarat->test1 . '"  placeholder="الاختبار الاول" class="form-control" />
        <input type="hidden" name="test2"  value="' . $Alaikhtibarat->test2 . '" placeholder="الاختبار الثاني"  class="form-control my-2" />
        <input type="hidden" name="test3"  value="' . $Alaikhtibarat->test3 . '"  placeholder="الاختبار السرد"class="form-control"/>
        <input type="text" name="test4"  value="' . $Alaikhtibarat->test4 . '" placeholder="الاختبار النهائي" class="form-control my-2" />
            ';
        }
        $return .= '
                <input type="submit" class="btn btn-success my-4" value="تعديل" />
        <button type="button" class="btn btn-danger btn-close-modal" data-bs-dismiss="modal">اغلاق</button>


        </div>
        </form>
        ';
        return $return;
    }

    private function getAlmustawayaName($value)
    {
        switch ($value) {
            case 1:
                return 'الاختبار الاول';
                break;
            case 2:
                return 'الاختبار الثاني';
                break;
            case 3:
                return 'الاختبار السرد';
                break;
            default:
                return 'الاختبار النهائي';
        }
    }


    public function insert(Request $request)
    {

        Alaikhtibarat::create([
            'test1' => $request->test1,
            'test2' => $request->test2,
            'test3' => $request->test3,
            'test4' => $request->test4,
            'talib_id' => $request->talib_id,
            'user_id' => auth()->user()->id,
            'session_id' => $request->session_id
        ]);

        return response()->json('success');
    }

    public function update(Request $request)
    {
        Alaikhtibarat::where('id', $request->id)
            ->update([
                'test1' => $request->test1,
                'test2' => $request->test2,
                'test3' => $request->test3,
                'test4' => $request->test4,
            ]);
        return response()->json('success');
    }
}
