@extends('admin.layouts.app')
@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        لوحة التحكم
                    </div>
                    <h2 class="page-title">
                        <div class="d-flex justify-content-between" style="width:100%">

                            <span>نتائج الحافظ</span>
                            <div>
                                <button class=" btn btn-primary d-none d-sm-inline-block "
                                    onclick="javascript:window.print();">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                        <path
                                            d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                    </svg>
                                    طباعة
                                </button>
                                <a href="{{ route('admin.reports.index') }}" class="btn btn-dark">للخلف</a>
                            </div>
                        </div>
                    </h2>
                </div>

            </div>


        </div>
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.reports.talibs.result') }}" id="search" class="row gx-3 gy-2 align-items-center">
        <div class="col-10">
            <div class="input-group d-flex align-items-center">
                @php
                    $years = range(1999, 2050);
                @endphp
                <select name="year" required id="year" class="form-control">
                    <option value="">السنة</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" @selected($year == date('Y'))>{{ $year }}</option>
                    @endforeach
                </select>

                <select name="session" required id="session" class="form-control">
                    @foreach (\App\Models\Session::all() as $item)
                        <option @selected($item->id == getYearSetting()->session_id) value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>

                <select name="alhalaqa" required id="alhalaqa" class="form-control">
                    <option value="" selected disabled>الحلقة</option>
                    @php
                        $Alhalaqats = \App\Models\Alhalaqat::all();
                    @endphp
                    @foreach ($Alhalaqats as $item)
                        {
                        <option value="{{ $item->id }}" @selected($item->id == Request('alhalaqa'))>{{ $item->name }}</option>

                        }
                    @endforeach

                </select>

            </div>
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary">بحث</button>
        </div>
    </form>

    <div class="table-responsive">
        <table id="table" class="table my-2 table-bordered">
            <thead>
                <tr>
                    <th>م</th>
                    <th>الطالب</th>
                    <th>الفصل</th>
                    <th>الحضور</th>
                    <th>نسبة الحضور 10%</th>
                    <th>درجة الاختبار 1 20%</th>
                    <th>درجة الاختبار 2 20%</th>
                    <th>السرد 20%</th>
                    <th>الاختبار النهائي 40%</th>
                    <th>الدرجة النهائية</th>
                    <th>ملاحظات</th>
                </tr>
            </thead>
            @php
                $i = 1;

            @endphp
            @foreach ($Alaikhtibarats as $item)
                @php
                    ######################### الحضور #########
                    // عدد الحضور
                    $Attend = \App\Models\Tasmie::where('talib_id', $item->id)
                        ->where('session_id', Request('session'))
                        ->whereYear('created_at', Request('year'))
                        ->where(function ($query) {
                            $query->where('attend', 1)->orWhere('attend', 3)->orWhere('attend', 2);
                        })
                        ->count();

                    // Attend
                    $TotalAttend = \App\Models\Tasmie::where('alhalaqat_id', Request('alhalaqa'))
                        ->where('session_id', Request('session'))
                        ->whereYear('created_at', Request('year'))
                        ->count();
                    // Perc Tatoal Tasmie
                    if ((int) $Attend !== 0) {
                        $PercAttend = ((int) $Attend / (int) $TotalAttend) * 10;
                    } else {
                        // Handle the case when $Attend is zero
                        $PercAttend = 0; // or any other appropriate value or action
                    }
                    ################# اختبار 1
                    $AlaikhtibarOne = \App\Models\Alaikhtibarat::where('talib_id', $item->id)
                        ->pluck('test1')
                        ->first();

                    $AlaikhtibarOne = ($AlaikhtibarOne / 100) * 20;
                    ################# اختبار 2
                    $AlaikhtibarTwo = \App\Models\Alaikhtibarat::where('talib_id', $item->id)
                        ->pluck('test2')
                        ->first();

                    $AlaikhtibarTwo = ($AlaikhtibarTwo / 100) * 20;

                    ################# اختبار 3
                    $AlaikhtibarThere = \App\Models\Alaikhtibarat::where('talib_id', $item->id)
                        ->pluck('test3')
                        ->first();
                    $AlaikhtibarThere = ($AlaikhtibarThere / 100) * 20;

                    ################# اختبار 4
                    $AlaikhtibarFour = \App\Models\Alaikhtibarat::where('talib_id', $item->id)
                        ->pluck('test4')
                        ->first();

                    $AlaikhtibarFour = ($AlaikhtibarFour / 100) * 40;

                @endphp
                <tr @if ($item->gender == 0) style="background: #fd9cff;font-weight:bold;color:#551456" @endif>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->talib->name }}</td>
                    <td>{{ $item->session->name }}</td>
                    <td>{{ $Attend }}</td>
                    <td>{{ $PercAttend }}%</td>
                    <td>{{ $AlaikhtibarOne }}%</td>
                    <td>{{ $AlaikhtibarTwo }}%</td>
                    <td>{{ $AlaikhtibarThere }}%</td>
                    <td>{{ $AlaikhtibarFour }}%</td>
                    <td>{{ $AlaikhtibarOne + $AlaikhtibarTwo + $AlaikhtibarThere + $AlaikhtibarFour }}</td>

                    {{-- <td>{{ $item->talib->name }}</td>
                <td>{{ $item->attend == 2 ? 'حاضر 1 ' : 'حاضر 2 ' }}</td>
                <td>{{ $item->part->title }}</td>
                <td>{{ $item->number_of_quarters }}</td>
                <td>{{ $item->almanhaj->title }}</td>
                <td>{{ $item->degree }}</td>
                <td>{{ $item->comment }}</td> --}}

                </tr>
            @endforeach
    </div>
@endsection

@push('js')
    <script>
        // Initialize DataTables
        $('#table').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json",

            },
            'pageLength': 100

        });
    </script>
@endpush
