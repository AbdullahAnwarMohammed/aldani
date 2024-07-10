<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $tests = $request->tests == "on" ? 1 : 0;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
            'phone' => ['numeric'],
            'cid' => 'required|unique:users,cid|digits:12|numeric'

        ]);
        $image_name = NULL;
        if($request->photo)
        {
                 $image = $request->file('photo');
                $image_name =  time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('uploads/users/'), $image_name);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'showPassword' => $request->password,
            'gender' => $request->gender,
            'cid' => $request->cid,
            'date_of_birth' => $request->date_of_birth,
            'photo' => $image_name,
            'test' => $tests
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return response()->json(['status' => 201]);
    }
}
