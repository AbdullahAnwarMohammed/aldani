<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(AdminRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::ADMIN);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function show($id){
        $Admin = Admin::where('id',$id)->first();
        return response()->json($Admin);
    }

    public function delete($id)
    {
        Admin::where('id',$id)->delete();
        return redirect()->back()->with('delete','تم الحذف بنجاح');
    }

    public function update(Request $request,$id){
        $password = Hash::make($request->passwordHidden);
        $showPassword = $request->passwordHidden;
        if(isset($request->password))
        {
            $password = Hash::make($request->password);
            $showPassword = $request->password;
        }
        Admin::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'phone' => $request->phone,
            'showPassword' => $showPassword,
            'gender' => $request->gender,
            
        ]);
        return response()->json(['status'=>201,'type'=>'update']);

    }
}
