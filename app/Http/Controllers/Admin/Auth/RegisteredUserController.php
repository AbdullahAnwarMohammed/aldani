<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('admin.mangers.create', compact('roles'));
    }


    public function edit($id): View
    {
        $admin = Admin::where('id', $id)->first();


        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $admin->roles->pluck('name', 'name')->all();
        return view('admin.mangers.edit', [
            'roles' => $roles,
            'userRoles' => $userRoles,
            'admin' => $admin
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Admin::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password' => ['required'],
            'phone' => ['numeric'],
            'roles' => 'required'
            
            // 'cid' => ['required|unique:users,cid|digits:12|numeric']

        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'showPassword' => $request->password,
            'gender' => $request->gender,
            'cid' => $request->cid,
            'male_or_female' =>$request->male_or_female
        ]);


        $admin->syncRoles($request->roles);

        event(new Registered($admin));

        // Auth::guard('admin')->login($admin);

        // return redirect(RouteServiceProvider::ADMIN);
        return response()->json(['status' => 201]);
    }
}
