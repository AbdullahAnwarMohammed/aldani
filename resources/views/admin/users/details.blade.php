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
                        بيانات : {{ $User->name }}
                    </h2>

                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        <a href="{{ route('admin.users.index') }}" class=" btn btn-dark d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 14l-4 -4l4 -4" />
                                <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                            </svg>
                            المحفظون 

                        </a> 
                        <a href="{{ route('admin.users.index') }}" class="btn btn-dark d-sm-none btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 14l-4 -4l4 -4" />
                                <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                            </svg>
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{-- {{-- <div class="row"> --}}
    <div class="col-12">
        @if ($User->gender == 1 && empty($Talib->image))
            <img src="/dashboard/images/man.png" class="m-auto d-block img-thumbnail" width="100" alt="">
        @endif

        @if ($User->gender == 0 && empty($Talib->image))
            <img src="/dashboard/images/moslem-woman.png" class="m-auto d-block img-thumbnail" width="100"
                alt="">
        @endif
    </div>
    <table class="table table-bordered">
        <tr
            @if ($User->gender == 1) style="background:#b0e2ff;color:#08466a;font-weight:bold"
            @else 
            style="background:#ffa6cf;color:#6a2727;font-weight:bold" @endif>
            <td class="bg-dark text-white" style="width:15%">اسم الطالب</td>
            <td>{{ $User->name }}</td>
        </tr>
        <tr>
            <td class="bg-danger text-white" style="width:15%">الاختبارات</td>
            <td class="{{$User->test == 1 ? "bg bg-success text-white fw-bold" : "bg bg-danger text-white fw-bold"}}">

                {{$User->test == 1 ? "مسموح" : "غير مسموح"}}
            </td>
        </tr>
        <tr>
            <td class="bg-dark text-white" style="width:15%">البريد</td>
            <td>{{ $User->email }}</td>
        </tr>
        <tr>
            <td class="bg-danger text-white" style="width:15%">الجنس</td>
            <td>{{ $User->gender == 1 ? 'ذكر' : 'انثي' }}</td>
        </tr>
        <tr>
            <td class="bg-dark text-white" style="width:15%">كلمة المرور</td>
            <td>{{ $User->showPassword }}</td>
        </tr>
        <tr>
            <td class="bg-danger text-white" style="width:15%">الهاتف</td>
            <td>
                <a href="https://wa.me/{{ $User->phone }}" class="text-success fw-bold">
                    {{ $User->phone }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp"
                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                        <path
                            d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                    </svg>

                </a>
            </td>
        </tr>
        <tr>
            <td class="bg-dark text-white" style="width:15%">رقم المدني</td>
            <td>{{ $User->cid }}</td>
        </tr>
        <tr>
            @php
                $age = \Carbon\Carbon::parse($User->date_of_birth)->age;
            @endphp
            <td class="bg-danger text-white">تاريخ الميلاد</td>
            <td>{{ $User->date_of_birth }} - {{$age}} سنة</td>
        </tr>

        <tr>
         
            <td class="bg-dark text-white">الحلقات</td>
            <td>
                @forelse ($User->alhalaqats as $item)
                    <span class="badge bg-dark">{{$item->name}} || 
                        <span class="badge bg-warning"> {{count($item->talibs)}}</span>
                    </span>
                @empty
                    <span class="badge bg-danger">لا يوجد حلقات</span>
                @endforelse($alhalaqats as $item)
            </td>
        </tr>
    </table>
    </div>
@endsection

@push('js')
@endpush
