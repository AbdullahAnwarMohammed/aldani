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
                        بيانات : {{ $Talib->name }}
                       
                    </h2>

                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        <a href="{{ route('admin.talibs.index') }}" class=" btn btn-dark d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up"
                            width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 14l-4 -4l4 -4" />
                            <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                        </svg>
                            الحافظون
                        </a>
                        <a href="{{ route('admin.talibs.index') }}" class="btn btn-dark d-sm-none btn-icon">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if ($Talib->gender == 1 && empty($Talib->image))
                <img src="/dashboard/images/muslim.png" class="m-auto d-block img-thumbnail" width="100" alt="">
            @endif

            @if ($Talib->gender == 0 && empty($Talib->image))
                <img src="/dashboard/images/moslem-woman.png" class="m-auto d-block img-thumbnail" width="100"
                    alt="">
            @endif
        </div>
        <table class="table table-bordered table-sm">
            <tr
                @if ($Talib->gender == 1) style="background:#b0e2ff;color:#08466a;font-weight:bold"
            @else 
            style="background:#ffa6cf;color:#6a2727;font-weight:bold" @endif>
                <td class="bg-danger text-white" style="width:15%">الاسم</td>
                <td>{{ $Talib->name }}</td>
            </tr>
            <tr>
                <td class="bg-danger text-white" style="width:15%">الحلقة</td>
                <td>{{ $Talib->alhalaqat->name }}</td>
            </tr>

            <tr>
                <td class="bg-danger text-white" style="width:15%">المحفظ</td>
                <td>
                    {{ $Talib->alhalaqat->user->name }}
                    <a href="https://wa.me/{{ $Talib->alhalaqat->user->phone }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp"
                            width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                            <path
                                d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                        </svg>

                    </a>
                </td>
            </tr>
            <tr>
                <td class="bg-danger text-white" style="width:15%">المستوي</td>
                <td>{{ $Talib->almustawayat->name }}</td>
            </tr>

            <tr>
                <td class="bg-danger text-white" style="width:15%">الدولة</td>
                <td>{{ $Talib->country->country_name }}</td>
            </tr>

            <tr>
                <td class="bg-danger text-white" style="width:15%">الدفعة</td>
                <td>{{ $Talib->aldafeuh->name }}</td>
            </tr>

            <tr>
                <td class="bg-danger text-white" style="width:15%">الجنس</td>
                <td>{{ $Talib->gender == 1 ? 'ذكر' : 'انثي' }}</td>
            </tr>

            <tr>
                @php
                    $age = \Carbon\Carbon::parse($Talib->date_of_birth)->age;
                @endphp
                <td class="bg-danger text-white" style="width:15%">تاريخ الميلاد</td>
                <td>{{ $Talib->date_of_birth }} - {{ $age }} سنة</td>
            </tr>

            <tr>
                <td class="bg-danger text-white" style="width:15%">هاتف الطلاب</td>
                <td>
                    <a href="https://wa.me/{{ $Talib->phone }}" class="text-success fw-bold">
                        {{ $Talib->phone }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp"
                            width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                            <path
                                d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                        </svg>

                    </a>

                </td>
            </tr>

            <tr>
                <td class="bg-danger text-white" style="width:%">هاتف ولي الامر</td>
                <td>
                    <a href="https://wa.me/{{ $Talib->father_phone }}" class="text-success fw-bold">
                        {{ $Talib->father_phone }}

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp"
                            width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                            <path
                                d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                        </svg>

                    </a>

                </td>
            </tr>

            <tr>
                <td class="bg-danger text-white" style="width:15%">الرقم المدني</td>
                <td>{{ $Talib->cid }}</td>
            </tr>


            <tr>
                <td class="bg-danger text-white" style="width:15%">نوع الاشتراك</td>
                <td> {{ $Talib->subscrption == 1 ? ' مدفوع' : 'مجاني' }}</td>
            </tr>
            






        </table>
    </div>
@endsection

@push('js')
@endpush
