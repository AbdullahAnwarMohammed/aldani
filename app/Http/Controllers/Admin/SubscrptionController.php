<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscrption;
use App\Models\Talib;
use Carbon\Carbon;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NunoMaduro\Collision\Adapters\Phpunit\Subscribers\Subscriber;

class SubscrptionController extends Controller
{
    public function index()
    {
        $Subscrptions = Talib::where('subscrption',1)->get();
   
        return view("admin.subscrptions.index",compact('Subscrptions'));
    }

    public function create($id)
    {
        $Subscrptions = Talib::where('subscrption',1)->where('id',$id)->first();
        return view("admin.subscrptions.create",compact('Subscrptions'));
    }


    // دفع فاتورة
    public function store(Request $request)
    {
        
        $now = Carbon::now();

        $request->validate([
            'talib_id' => 'required',
            'paid_value' => 'required|numeric|gt:0'
        ]);
        $required_value = Subscrption::where('id',$request->subscrption_id)->first();
        
        $Tailb = Talib::where('id',$request->talib_id)->first();
        if($required_value->required_value < ($Tailb->get_total_count_paid() + $request->paid_value))
        {
            return redirect()->back()->with('error','القيمة المطلوب سدادها '. $required_value->required_value  - $Tailb->get_total_count_paid() );
        }else{
            DB::table('payments')->insert([
                'talib_id' => $request->talib_id,
                'subscrption_id' => $request->subscrption_id,
                'paid_value' => $request->paid_value,
                'created_at' => $now,
                'updated_at' =>  $now,
            ]);
            return redirect()->route("admin.subscrption.invoice",[$request->talib_id,$request->subscrption_id]);
        }
    }

    public function single($id)
    {
        $Talib = Talib::where('id',$id)->first();
        return view("admin.subscrptions.single",compact('Talib'));
    }

    public function invoice($id,$idInvoice)
    {
        $Subscrption = Subscrption::where('id',$idInvoice)->first();
        

        if(!isset($Subscrption))
        {
            return redirect()->back();
        }
        return view("admin.subscrptions.invoice",compact('Subscrption'));
    }

    public function cancel($id)
    {
        Talib::where('id',$id)->delete();

        return redirect()->back();
    }

    public function addSubscrption($id)
    {
        $Talib = Talib::find($id)->first();

        return view("admin.subscrptions.new",compact('Talib'));
    }

    public function newSubscrption(Request $request)
    {
        $Tablib = Talib::where('id',$request->talib_id)->first();
        foreach($Tablib->subscrptions as $item)
        {
            if($request->reg_start == $item->reg_start)
            {
                return redirect()->back()->with('error','هذا الاشتراك موجود من قبل');

            }
        }

        $request->validate([
            'reg_start' => 'required|date',
            'reg_end' => 'required|date|after:reg_start',
            'required_value' => 'numeric',
            'paid_value' => 'numeric|lte:required_value'
        ]);
        
        
     

        $Subscrption = Subscrption::create([
            'talib_id' => $request->talib_id,
            'reg_start' => $request->reg_start,
            'reg_end' => $request->reg_end,
            'required_value' => $request->required_value,
        ]);

        DB::table('payments')->insert([
            'talib_id' => $request->talib_id,
            'subscrption_id' => $Subscrption->id,
            'paid_value' => $request->paid_value,
        ]);

        return redirect()->back()->with('success','تم الاشتراك بنجاح');
    }

    // عرض الاشتراك قبل التعديل فى MODAL
    public function show($id)
    {
        $Subscrption = Subscrption::where('id',$id)->first();
        return response()->json($Subscrption);
    }


    // صفحة التعديل قبل عملية التعديل 
    public function edit($id)
    {
        $Subscrption = Subscrption::where('id',$id)->first();

      return view("admin.subscrptions.edit",compact('Subscrption'));
    }
    // تعديل الاشتراك
    public function update(Request $request,$id)
    {

        // جميع الرقم الاول و الرق مالثاني 
        $total_paid = array_sum(array_values($request->payment));

        // الاشتراك الحالي
        $Subscrption = Subscrption::where('id',$id)
        ->first();

        // التاكد من ان القيمة المدخلة اقل من القيمة المطلوبة
        if($total_paid > $Subscrption->required_value)
        {
            return redirect()->back()->with('error',' القيمة المدفوعة اكبر من القيمة المطلوبة' .  $Subscrption->required_value - $Subscrption->total_payments() );
        }
        
        // لتحقق من ان التغير عند التغير غير مشترك من قبل 
        $Subscrptions = Subscrption::where('talib_id',$request->talib_id)
        ->where('id','!=',$id)
        ->get();
        foreach($Subscrptions as $item)
        {
            if($request->reg_start == $item->reg_start)
            {
                return redirect()->back()->with('error','هذا الاشتراك موجود من قبل');

            }
        }

        // تعديل الاشتراك
        $Sub = Subscrption::where('id',$id)->update([
            'reg_start' => $request->reg_start,
            'reg_end' => $request->reg_end,
            'required_value' => $request->required_value
          ]);
        
      
          // تعديل المدفوعات
        foreach($request->payment as $key => $item)
        {
            DB::table('payments')
            ->where('id',$key)
            ->update([
                'paid_value' => $item
            ]);
        }
    return redirect()->back()->with('success','تم التعديل بنجاح');


    }

    // عرض بيانات المدفوعات قبل التعديل 
    public function payments($id)
    {
        $Subscrption = Subscrption::where('id',$id)->first();
        $payments = DB::table('payments')->where('subscrption_id',$id)->get();
        return view("admin.subscrptions.payment",compact('payments','Subscrption'));

    }

    public function updatePayment(Request $request)
    {
        $total = 0;
       foreach($request->payment as $key=>$item)
       {
            $total +=$item;
            if($total > $request->required_value)
            {
                return redirect()->back()->with('error','القيمة المدفوعة اكبر من القيمة المطلوب');
                break;
            };
            DB::table('payments')->where('id',$key)->update([
                'paid_value' => $item
            ]);
       }
       return redirect()->back()->with('success','تم التعديل بنجاح');;

        
    }
}
