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

                            <span>دراجات الحافظ</span>
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
    <form action="{{ route('admin.reports.degree') }}" id="search" class="row gx-3 gy-2 align-items-center">
        <div class="col-10">
            <input type="hidden" id="type_search" value="date" name="type_search">
            <label for="session_id">البحث ب بواسطة الفصل</label>
            <input type="checkbox" id="session_id" @checked(Request('type_search') == 'session')>

            <div class="input-group d-flex align-items-center">

                <div class="app_session_id d-none">

                    <select name="session_id" id="session_id" class="form-control ">
                        <option value="">الفصول</option>
                        @foreach (\App\Models\Session::all() as $item)
                            <option value="{{ $item->id }}" @selected($item->id == Request('session_id'))>{{ $item->name }}</option>
                        @endforeach
                    </select>

                </div>

                <input type="date" value="{{ Request('from') ? Request('from') : date('Y-m-d') }}" name="from"
                    class="form-control date1">
                <input type="date" value="{{ Request('to') ? Request('to') : date('Y-m-d') }}" name="to"
                    class="form-control date2">

                <select name="alhalaqat" id="alhalaqat" class="form-control">
                    <option value="">اختر الحلقة</option>
                    @foreach (\App\Models\Alhalaqat::all() as $item)
                        <option @selected($item->id == Request('alhalaqat')) value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>


                <select name="users" id="users" class="form-control d-none">

                    @if (Request('alhalaqat'))
                        @php
                            $Users = \App\Models\Alhalaqat::where('id', Request('alhalaqat'))->with('user')->get();
                        @endphp
                        @foreach ($Users as $item)
                            {
                            <option value="{{ $item->user->id }}">{{ $item->user->name }}</option>

                            }
                        @endforeach
                    @else
                        <option value="">الحافظون</option>
                    @endif
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
                    <th>الحضور</th>
                    <th>الجزء</th>
                    <th>عدد الارباع</th>
                    <th>المنهج</th>
                    <th>الدرجة</th>
                    <th>ملاحظات</th>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
            @foreach ($Tasmie as $item)
                <tr @if ($item->gender == 0) style="background: #fd9cff;font-weight:bold;color:#551456" @endif>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->talib->name }}</td>
                    <td>{{ $item->attend == 2 ? 'حاضر 1 ' : 'حاضر 2 ' }}</td>
                    <td>{{ $item->part->title }}</td>
                    <td>{{ $item->number_of_quarters }}</td>
                    <td>{{ $item->almanhaj->title }}</td>
                    <td>{{ $item->degree }}</td>
                    <td>{{ $item->comment }}</td>

                </tr>
            @endforeach
    </div>
@endsection

@push('js')
    <script>
        $('#alhalaqat').change(function() {

            if ($(this).val()) {
                $("#users").removeClass("d-none");
                var alhalaqatId = $(this).val();

                $.ajax({
                    url: '{{ route('admin.reports.users.by.alhalaqat') }}', // URL to your Laravel route
                    type: 'GET',
                    data: {
                        id: alhalaqatId
                    },
                    success: function(response) {
                        $('#users').empty();
                        $('#users').append('<option value="">حافظ</option>');
                        $.each(response.users, function(key, user) {
                            $('#users').append('<option value="' + user.id + '">' + user.name +
                                '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.log('An error occurred: ' + xhr.status + ' ' + xhr.statusText);
                    }
                });
            } else {
                $("#users").addClass("d-none");
                $('#users').empty();

            }

        });
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


        if ($("#session_id").is(':checked')) {
            $(".app_session_id").removeClass("d-none");
            $(".date1").addClass("d-none");
            $(".date2").addClass("d-none");
            $("#type_search").val("session")
        } else {
            $(".app_session_id").addClass("d-none");
            $(".date1").removeClass("d-none");
            $(".date2").removeClass("d-none");
            $("#type_search").val("from_to")

        }



        $("#session_id").on("change", function() {
            if ($(this).is(':checked')) {
                $(".app_session_id").removeClass("d-none");
                $(".date1").addClass("d-none");
                $(".date2").addClass("d-none");
                $("#type_search").val("session")

            } else {
                $(".app_session_id").addClass("d-none");
                $(".date1").removeClass("d-none");
                $(".date2").removeClass("d-none");
                $("#type_search").val("from_to")

            }
        })
    </script>
@endpush
