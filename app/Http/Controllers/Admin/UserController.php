<?php
namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $gender = $request->query('gender');

        if (isset($gender)) {
            $Users = User::where('gender', $gender)->get();
        } else {
            $Users = User::whereIn('gender', maleOrFemaleForAdmin())->get();
        }

        return view("admin.users.index", compact('Users'));
    }

    public function halqa_show($id)
    {
        $User = User::find($id);
        return view("admin.users.halqa", compact('User'));
    }

    public function info($id)
    {
        $User = User::find($id);
        return view("admin.users.details", compact('User'));
    }

    
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
