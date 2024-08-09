<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Alaikhtibarat;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Talib;
use App\Models\Tasmie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $PageHeader = Page::where('status', 1)->where('location', 1)->get();
        $PageContainer = Page::where('status', 1)->where('location', 2)->get();
        return view("front.home.index", compact('PageHeader', 'PageContainer'));
    }

    public function getPage($id)
    {
        $Page = Page::where('id', $id)->first();
        return view("front.pages.show", compact('Page'));
    }


    // Login 
    public function AdminOrUser(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $cred = ['email' => $request->email,'password' => $request->password];
        if (Auth::guard('admin')->attempt($cred,$request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('admin.home');
        }
        if(getYearSetting()->login_almuhfazin == 1 && getYearSetting()->status_site == 1)
        {
            if (Auth::attempt($cred,$request->remember)) {
                $request->session()->regenerate();
                return redirect()->route('almuhfazun.home');
            }
        }else{
            return back()->withErrors([
                'email' => getYearSetting()->message_close_site,
            ])->onlyInput('email');
        }
      


        return back()->withErrors([
            'email' => 'يوجد خطأ فى البيانات يرجي المحاولة',
        ])->onlyInput('email');
    }

    // get Content Page

    public function page($id)
    {
        $PageHeader = Page::where('status', 1)->where('location', 1)->get();
        $PageContainer = Page::where('status', 1)->where('location', 2)->get();
        $Page = Page::where('id',$id)->first();
        return view("front.page.page",compact('Page','PageHeader','PageContainer'));
    }
    // صفحة ولي الامر
    public function parentPage(Request $request,$cid)
    {
        // $Tasmie = Tasmie::whereDate('date', date("Y-m-d"))->first();
        $Tasmie = NULL;
        $Tasmies = Tasmie::all();
        if($request->date)
        {
           $Tasmie = Tasmie::whereDate('date', $request->date)->first();
        }
        $Talib = Talib::where('cid',$cid)->first();
        if($Talib)
        {
            return view("parent.home.index",compact('Talib','Tasmies','Tasmie'));
        }
        return redirect()->back();
    }
    /// صفحة ولي الامر للاختبارات
     
    public function parentAlaikhtibarat(Request $request,$cid)
    {
        $Talib = Talib::where('cid',$cid)->first();
        if($Talib)
        {
            $AlaikhtibaratOne = Alaikhtibarat::where('talib_id', $Talib->id)
            ->whereYear('created_at', getYearSetting()->year)
            ->where('type', 1)
            ->where('session_id', getYearSetting()->session_id)
            ->first();

            $AlaikhtibaratTwo = Alaikhtibarat::where('talib_id', $Talib->id)
            ->whereYear('created_at', getYearSetting()->year)
            ->where('type', 2)
            ->where('session_id', getYearSetting()->session_id)
            ->first();
            $AlaikhtibaratThere= Alaikhtibarat::where('talib_id', $Talib->id)
            ->whereYear('created_at', getYearSetting()->year)
            ->where('type', 3)
            ->where('session_id', getYearSetting()->session_id)
            ->first();
            $AlaikhtibaratFour = Alaikhtibarat::where('talib_id', $Talib->id)
            ->whereYear('created_at', getYearSetting()->year)
            ->where('type', 4)
            ->where('session_id', getYearSetting()->session_id)
            ->first();

            return view("parent.alaikhtibarat.index",
            compact('Talib','AlaikhtibaratOne','AlaikhtibaratTwo','AlaikhtibaratThere','AlaikhtibaratFour'));
        }
        return redirect()->back();

    }
    // Search For Talib
    public function search(Request $request)
    {
        if(getYearSetting()->status_site == 0)
        {
            return redirect()->back()->with('error',getYearSetting()->message_close_site);
        }

       $Talib = Talib::where('cid',$request->cid)->first();
        if($Talib)
        {
            return redirect()->route('home.parent.home',$request->cid);

        }
        return redirect()->back()->with('error','البيانات غير صحيحة');
    }
}
