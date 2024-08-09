<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if(getYearSetting()->login_almuhfazin == 0 || getYearSetting()->login_almuhfazin == 0)
        {
            return redirect()->back()->with('error',getYearSetting()->message_close_site);
        }
        
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    
    public function delete($id)
    {
        User::where('id',$id)->delete();
        return redirect()->back()->with('delete','تم الحذف بنجاح');
    }

    public function show($id){
        $User = User::where('id',$id)->first();
        return response()->json($User);
    }

    public function update(Request $request,$id){
        $tests = $request->tests == "on" ? 1 : 0;
        $password = Hash::make($request->passwordHidden);
        $showPassword = $request->passwordHidden;
        if(isset($request->password))
        {
            $password = Hash::make($request->password);
            $showPassword = $request->password;
        }
        $image_name = $request->imageUpdate;
        if($request->photo)
        {
            if (File::exists(public_path('uploads/users/' . $request->imageUpdate))) {
                File::delete(public_path('uploads/users/' . $request->imageUpdate));
            }

            $image = $request->file('photo');
            $image_name =  time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('uploads/users/'), $image_name);
        }

        User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'phone' => $request->phone,
            'showPassword' => $showPassword,
            'gender' => $request->gender,
            'photo'=> $image_name,
            'test' => $tests
            
        ]);
        return response()->json(['status'=>201,'type'=>'update']);

    }



}
