@extends('admin.layouts.app')
@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
             

                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        وحدة التحكم
                    </div>
                    <h2 class="page-title">
                        الصفحة الرئيسية
                    </h2>


                </div>
                <div class="col-12 d-flex justify-content-center">
                    <img src="/uploads/logo/{{ $Setting->logo_small }}" style="width:250px" class="img-thumbnail " style="">
                </div>

            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-stamp">
                    <div class="card-stamp-icon bg-yellow">
                        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                            </path>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="card-title">الحافظون</h3>
                    <p class="text-secondary">

                        @php
                            $Items = $Talibs->pluck('subscrption')->toArray();
                            $free = 0;
                            $paid = 0;
                            foreach ($Items as $Item) {
                                if ($Item == 0) {
                                    $free++;
                                } else {
                                    $paid++;
                                }
                            }
                        @endphp
                        <span class="badge bg-danger d-block">الكل {{ count($Talibs->pluck('id')) }}</span>
                        <span class="badge bg-success  d-block"> عضوية مجانية {{ $free }} </span>
                        <span class="badge bg-warning  d-block">عضوية مدفوعة {{ $paid }} </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-stamp">
                    <div class="card-stamp-icon bg-yellow">
                        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                            </path>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="card-title">المحفظون</h3>
                    @php
                        $UsersMale = \App\Models\User::where('gender', 1)->count();
                        $UsersFemale = \App\Models\User::where('gender', 0)->count();

                    @endphp
                    <span class="badge bg-danger d-block">الكل {{ $UsersMale + $UsersFemale }}</span>
                    <span class="badge bg-success  d-block"> الذكور {{ $UsersMale }} </span>
                    <span class="badge bg-warning  d-block">الاناث {{ $UsersFemale }} </span>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-stamp">
                    <div class="card-stamp-icon bg-yellow">
                        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                            </path>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="card-title">الحلقات</h3>
                    @php
                        $AlhalaqatMale = \App\Models\Alhalaqat::where('type', 1)->count();
                        $AlhalaqatFemale = \App\Models\Alhalaqat::where('type', 0)->count();
                    @endphp
                    <span class="badge bg-danger d-block">الكل {{ $AlhalaqatMale + $AlhalaqatFemale }}</span>
                    <span class="badge bg-success  d-block"> الذكور {{ $AlhalaqatMale }} </span>
                    <span class="badge bg-warning  d-block">الاناث {{ $AlhalaqatFemale }} </span>

                </div>
            </div>
        </div>

    </div>
@endsection
