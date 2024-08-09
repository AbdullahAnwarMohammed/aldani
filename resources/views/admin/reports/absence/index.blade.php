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

                            <span>الغياب</span>
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
    <div class="d-none in-print">
        <h2>طباعة تقرير الغياب</h2>
        <img src="/uploads/logo/{{ $Setting->logo_small }}" style="width:200px" class="img-thumbnail">

    </div>

    <form action="{{ route('admin.reports.absence') }}" id="search" class="row gx-3 gy-2 align-items-center">
        <div class="col-10">
            <input type="hidden" id="type_search" value="date" name="type_search">
            <span> <label for="">من : الي</label>
                <input type="checkbox" @checked(Request('type_search') == 'from_to') id="checkbox_from_to">
            </span>
            <div id="from_to" class="d-none">
                <input type="date" class="form-control" name="from"
                    value="{{ Request('from') ? Request('from') : date('Y-m-d') }}">

                <input type="date" class="form-control" name="to"
                    value="{{ Request('to') ? Request('to') : date('Y-m-d') }}">

            </div>
            <div class="input-group d-flex align-items-center">
                <input type="text" class="form-control" value="{{Request('name')}}" name="name" placeholder="ابحث ب الاسم">
                <input type="date" class="form-control" id="date" name="date"
                value="{{ Request('date') ? Request('date') : date('Y-m-d') }}">
              
                <select name="gender" class="form-control">
                    <option value="">اختر الجنس</option>
                    <option value="true" @selected(Request('gender') == 'true' )>ذكور</option>
                    <option value="false" @selected(Request('gender') == 'false' )>آناث</option>
                </select>

                <select name="alhalaqa" class="form-control">
                    <option value="">اختر الحلقة</option>
                    @foreach (App\Models\Alhalaqat::all() as $item)
                        <option value="{{ $item->id }}" @selected($item->id == Request('alhalaqa'))>{{ $item->name }}</option>
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
                    <th>التاريخ</th>

                    <th>الاسم</th>
                    <th>الجنس</th>
                    <th>الرقم المندني</th>
                    <th>الحلقة</th>
                    <th>غائب</th>
                    <th>ملاحظات</th>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
            @forelse ($Tasmie as $item)
                <tr @if ($item->talib->gender == 0) style="background: #fd9cff;font-weight:bold;color:#551456" @endif>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->talib->name }}</td>
                    <td>{{ $item->talib->gender == 1 ? 'ذكر' : 'انثي' }}</td>
                    <td>{{ $item->talib->cid }}</td>
                    <td>{{ $item->talib->alhalaqat->name }}</td>
                    <td>{{ $item->attend == 0 ? 'بدون عذر' : 'بعذر' }}</td>
                    <td>{{ $item->comment }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-danger fw-bold text-center">لا يوجد بيانات</td>
                </tr>
            @endforelse

        </table>
    </div>
@endsection

@push('js')
    <script>
          if ($("#checkbox_from_to").is(':checked')) {
                $("#date").addClass("d-none")
                $("#from_to").removeClass("d-none")
                $("#type_search").val("from_to")
            } else {
                $("#date").removeClass("d-none")
                $("#from_to").addClass("d-none")
                $("#type_search").val("date")

            }

        $("#checkbox_from_to").on("change", function() {
            if ($(this).is(':checked')) {
                $("#date").addClass("d-none")
                $("#from_to").removeClass("d-none")
                $("#type_search").val("from_to")
            } else {
                $("#date").removeClass("d-none")
                $("#from_to").addClass("d-none")
                $("#type_search").val("date")

            }
        })
    </script>
@endpush

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