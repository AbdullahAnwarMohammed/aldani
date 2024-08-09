<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alaikhtibarat;
use App\Models\Alhalaqat;
use App\Models\Talib;
use App\Models\Tasmie;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view("admin.reports.index");
    }
    public function users(Request $request)
    {
        // فى حالة البحث
        if ($request->input('gender')) {
            $gender = $request->input('gender');
            $Users = User::where('gender', $gender)->get();
        } else {
            // عدم البحث
            $Users = User::all();
            $Alhalaqats = Alhalaqat::all();
        }


        return view("admin.reports.users.index", compact('Users', 'Alhalaqats'));
    }

    public function talibs(Request $request)
    {
        // فى حالة البحث
        if (
            $request->input('gender')
            && !$request->input('alhalaqat')
            && !$request->input('aldafeuh')
            && !$request->input('almustawayat')
        ) {
            $gender = $request->input('gender');
            $Talibs = Talib::where('gender', $gender)->get();
        } else if (
            $request->input('alhalaqat')
            && !$request->input('gender')
            && !$request->input('aldafeuh')
            && !$request->input('almustawayat')
        ) {
            $Talibs = Talib::where('alhalaqat_id', $request->input('alhalaqat'))->get();
        } else if (
            $request->input('aldafeuh')
            && !$request->input('gender')
            && !$request->input('alhalaqat')
            && !$request->input('almustawayat')

        ) {

            $Talibs = Talib::where('aldafeuh_id', $request->input('aldafeuh'))->get();
        } else if (
            $request->input('almustawayat')
            && !$request->input('aldafeuh')
            && !$request->input('gender')
            && !$request->input('alhalaqat')
        ) {
            $Talibs = Talib::where('almustawayat_id', $request->input('almustawayat'))->get();
        } else if (
            $request->input('gender')
            && $request->input('alhalaqat')
            && !$request->input('almustawayat')
            && !$request->input('aldafeuh')
        ) {
            $Talibs = Talib::where('gender', $request->input('gender'))->where('alhalaqat_id', $request->input('alhalaqat'))->get();
        } else if (
            $request->input('gender')
            && $request->input('alhalaqat')
            && $request->input('almustawayat')
            && !$request->input('aldafeuh')
        ) {
            $Talibs = Talib::where('gender', $request->input('gender'))->where('alhalaqat_id', $request->input('alhalaqat'))
                ->where('almustawayat_id', $request->input('almustawayat'))
                ->get();
        } else if (
            $request->input('gender')
            && $request->input('alhalaqat')
            && $request->input('almustawayat')
            && $request->input('aldafeuh')
        ) {
            $Talibs = Talib::where('gender', $request->input('gender'))->where('alhalaqat_id', $request->input('alhalaqat'))
                ->where('almustawayat_id', $request->input('almustawayat'))
                ->where('aldafeuh_id    ', $request->input('aldafeuh'))
                ->get();
        } else if (
            !$request->input('gender')
            && $request->input('alhalaqat')
            && $request->input('almustawayat')
            && $request->input('aldafeuh')
        ) {
            $Talibs = Talib::where('alhalaqat_id', $request->input('alhalaqat'))
                ->where('almustawayat_id', $request->input('almustawayat'))
                ->where('aldafeuh_id    ', $request->input('aldafeuh'))
                ->get();
        } else if (
            !$request->input('gender')
            && !$request->input('alhalaqat')
            && $request->input('almustawayat')
            && $request->input('aldafeuh')
        ) {
            $Talibs = Talib::where('almustawayat_id', $request->input('almustawayat'))
                ->where('aldafeuh_id', $request->input('aldafeuh'))
                ->get();
        } else if (
            !$request->input('gender')
            && $request->input('alhalaqat')
            && $request->input('almustawayat')
            && !$request->input('aldafeuh')

        ) {
            $Talibs = Talib::where('almustawayat_id', $request->input('almustawayat'))
                ->where('alhalaqat_id', $request->input('alhalaqat'))
                ->get();
        } else {
            // عدم البحث
            $Talibs = Talib::all();
        }
        return view("admin.reports.talibs.index", compact('Talibs'));
    }

    public function absence(Request $request)
    {
        $Today = date("Y-m-d");
        if ($request->all()) {

            if ($request->type_search == 'date') {
                $Tasmie = $this->dateSearch($request);
            } else {
                $Tasmie = $this->dateSearchFromTo($request);
            }
        } else {


            $date = $request->date;
            $Tasmie = Tasmie::whereDate('date', $Today)
                ->where('attend', 0)
                ->get();
        }


        return view("admin.reports.absence.index", compact('Tasmie'));
    }

    private function dateSearch(Request $request)
    {
        $date = $request->date;
        $gender = $request->gender == "true" ? 1 : 0;
        $alhalaqa = $request->input('alhalaqa');
        $name = $request->input('name');

        if (
            $request->input('date') && !$request->input('gender')  &&
            !$request->input('alhalaqa') && !$request->input('name')
        ) {

            $Tasmie = Tasmie::whereDate('date', $date)

                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }
        if ($request->input('date') && $request->input('gender')  && !$request->input('alhalaqa')  && !$request->input('name')) {
            $Tasmie = Tasmie::whereDate('date', $date)
                ->whereHas('talib', function ($query) use ($gender) {
                    $query->where('gender', $gender);
                })
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }
        if ($request->input('date') && $request->input('gender')  && $request->input('alhalaqa')  && !$request->input('name')) {
            $Tasmie = Tasmie::whereDate('date', $date)
                ->whereHas('talib', function ($query) use ($gender) {
                    $query->where('gender', $gender);
                })
                ->whereHas('talib', function ($query) use ($alhalaqa) {
                    $query->where('alhalaqat_id', $alhalaqa);
                })
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }

        if ($request->input('date') && !$request->input('gender')  && $request->input('alhalaqa')  && !$request->input('name')) {
            $Tasmie = Tasmie::whereDate('date', $date)
                ->whereHas('talib', function ($query) use ($gender) {
                    $query->where('gender', $gender);
                })
                ->whereHas('talib', function ($query) use ($alhalaqa) {
                    $query->where('alhalaqat_id', $alhalaqa);
                })
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }


        if ($request->input('date') && $request->input('gender')  && $request->input('alhalaqa')  && $request->input('name')) {
            $Tasmie = Tasmie::whereDate('date', $date)
                ->whereHas('talib', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                })
                ->whereHas('talib', function ($query) use ($gender) {
                    $query->where('gender', $gender);
                })
                ->whereHas('talib', function ($query) use ($alhalaqa) {
                    $query->where('alhalaqat_id', $alhalaqa);
                })
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }

        if ($request->input('date') && !$request->input('gender')  && !$request->input('alhalaqa')  && $request->input('name')) {
            $Tasmie = Tasmie::whereDate('date', $date)
                ->whereHas('talib', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                })

                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }

        if ($request->input('date') && !$request->input('gender')  && $request->input('alhalaqa')  && !$request->input('name')) {
            $Tasmie = Tasmie::whereDate('date', $date)
                ->whereHas('talib', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                })
                ->whereHas('talib', function ($query) use ($alhalaqa) {
                    $query->where('alhalaqat_id', $alhalaqa);
                })
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }

        if ($request->input('date') && $request->input('gender')  && !$request->input('alhalaqa')  && $request->input('name')) {
            $Tasmie = Tasmie::whereDate('date', $date)
                ->whereHas('talib', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                })
                ->whereHas('talib', function ($query) use ($gender) {
                    $query->where('gender', $gender);
                })
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }

        return $Tasmie;
    }

    private function dateSearchFromTo(Request $request)
    {
        $date = $request->date;
        $gender = $request->gender == "true" ? 1 : 0;
        $alhalaqa = $request->input('alhalaqa');
        $name = $request->input('name');

        if ($request->input('date') && !$request->input('gender')  && !$request->input('alhalaqa') && !$request->input('name')) {

            $Tasmie = Tasmie::whereBetween('date', [$request->from, $request->to])
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }
        if ($request->input('date') && $request->input('gender')  && !$request->input('alhalaqa')  && !$request->input('name')) {
            $Tasmie = Tasmie::whereBetween('date', [$request->from, $request->to])
                ->whereHas('talib', function ($query) use ($gender) {
                    $query->where('gender', $gender);
                })
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }
        if ($request->input('date') && $request->input('gender')  && $request->input('alhalaqa')  && !$request->input('name')) {
            $Tasmie =  Tasmie::whereBetween('date', [$request->from, $request->to])
                ->whereHas('talib', function ($query) use ($gender) {
                    $query->where('gender', $gender);
                })
                ->whereHas('talib', function ($query) use ($alhalaqa) {
                    $query->where('alhalaqat_id', $alhalaqa);
                })
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }

        if ($request->input('date') && !$request->input('gender')  && $request->input('alhalaqa')  && !$request->input('name')) {
            $Tasmie =  Tasmie::whereBetween('date', [$request->from, $request->to])
                ->whereHas('talib', function ($query) use ($gender) {
                    $query->where('gender', $gender);
                })
                ->whereHas('talib', function ($query) use ($alhalaqa) {
                    $query->where('alhalaqat_id', $alhalaqa);
                })
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }


        if ($request->input('date') && $request->input('gender')  && $request->input('alhalaqa')  && $request->input('name')) {
            $Tasmie =  Tasmie::whereBetween('date', [$request->from, $request->to])
                ->whereHas('talib', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                })
                ->whereHas('talib', function ($query) use ($gender) {
                    $query->where('gender', $gender);
                })
                ->whereHas('talib', function ($query) use ($alhalaqa) {
                    $query->where('alhalaqat_id', $alhalaqa);
                })
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }

        if ($request->input('date') && !$request->input('gender')  && !$request->input('alhalaqa')  && $request->input('name')) {
            $Tasmie =  Tasmie::whereBetween('date', [$request->from, $request->to])
                ->whereHas('talib', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                })

                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }

        if ($request->input('date') && !$request->input('gender')  && $request->input('alhalaqa')  && !$request->input('name')) {
            $Tasmie =  Tasmie::whereBetween('date', [$request->from, $request->to])
                ->whereHas('talib', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                })
                ->whereHas('talib', function ($query) use ($alhalaqa) {
                    $query->where('alhalaqat_id', $alhalaqa);
                })
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }

        if ($request->input('date') && $request->input('gender')  && !$request->input('alhalaqa')  && $request->input('name')) {
            $Tasmie =  Tasmie::whereBetween('date', [$request->from, $request->to])
                ->whereHas('talib', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                })
                ->whereHas('talib', function ($query) use ($gender) {
                    $query->where('gender', $gender);
                })
                ->where(function ($query) {
                    $query->where('attend', 0)
                        ->orWhere('attend', 2);
                })
                ->get();
        }

        return $Tasmie;
    }


    // الدراجات
    public function degree(Request $request)
    {
        if ($request->all()) {
            if ($request->type_search == "session") {
                if ($request->input('session_id') && !$request->input('alhalaqat') && !$request->input('users')) {

                    $Tasmie = Tasmie::where('session_id', $request->session_id)
                        ->where(function ($query) {
                            $query->where('attend', 1)
                                ->orWhere('attend', 4);
                        })
                        ->get();
                }

                if ($request->input('session_id') && $request->input('alhalaqat') && !$request->input('users')) {
                    $Tasmie = Tasmie::where('session_id', $request->session_id)
                        ->where('alhalaqat_id', $request->input('alhalaqat'))
                        ->where(function ($query) {
                            $query->where('attend', 1)
                                ->orWhere('attend', 4);
                        })
                        ->get();
                }
                if (
                    $request->input('session_id') && $request->input('alhalaqat') && $request->input('users')
                ) {
                    $Tasmie = Tasmie::where('session_id', $request->session_id)
                        ->where('alhalaqat_id', $request->input('alhalaqat'))
                        ->where('user_id', $request->input('users'))
                        ->where(function ($query) {
                            $query->where('attend', 1)
                                ->orWhere('attend', 4);
                        })
                        ->get();
                }

                return view("admin.reports.degree.index", compact('Tasmie'));
            } else {
                if (($request->input('from') || $request->input('to')) && !$request->input('alhalaqat')  && !$request->input('users')) {

                    $Tasmie = Tasmie::whereBetween('date', [$request->from, $request->to])
                        ->where(function ($query) {
                            $query->where('attend', 1)
                                ->orWhere('attend', 4);
                        })
                        ->get();
                }



                if (($request->input('from') || $request->input('to')) && $request->input('alhalaqat')  && !$request->input('users')) {
                    $Tasmie = Tasmie::whereBetween('date', [$request->from, $request->to])
                        ->where('alhalaqat_id', $request->input('alhalaqat'))
                        ->where(function ($query) {
                            $query->where('attend', 1)
                                ->orWhere('attend', 4);
                        })
                        ->get();
                }

                if (($request->input('from') || $request->input('to')) && $request->input('alhalaqat')  && $request->input('users')) {
                    $Tasmie = Tasmie::whereBetween('date', [$request->from, $request->to])
                        ->where('user_id', $request->input('users'))
                        ->where(function ($query) {
                            $query->where('attend', 1)
                                ->orWhere('attend', 4);
                        })
                        ->get();
                }
            }


            return view("admin.reports.degree.index", compact('Tasmie'));
        } else {
            $Tasmie = Tasmie::where('attend', 1)
                ->orWhere('attend', 4)
                ->get();
            return view("admin.reports.degree.index", compact('Tasmie'));
        }
    }

    public function usersByAlhalaqat(Request $request)
    {
        $alhalaqatId = $request->input('id');
        $users = Talib::where('alhalaqat_id', $alhalaqatId)->get();

        // $users = User::whereIn('id', $Alhalaqats)->get();

        return response()->json(['users' => $users]);
    }


    // النتائج
    public function result(Request $request)
    {
        if ($request->all()) {
            $year = $request->year;
            $session = $request->session;
            $alhalaqa = $request->alhalaqa;
            $Alaikhtibarats = Alaikhtibarat::whereYear('created_at', $year)
                ->where('session_id', $session)
                ->whereHas('talib', function ($query) use ($alhalaqa) {
                    $query->where('alhalaqat_id', $alhalaqa);
                })
                ->get();

            return view("admin.reports.result.index", compact('Alaikhtibarats'));
        } else {
            $Alaikhtibarats = [];
            return view("admin.reports.result.index", compact('Alaikhtibarats'));
        }
    }
}
