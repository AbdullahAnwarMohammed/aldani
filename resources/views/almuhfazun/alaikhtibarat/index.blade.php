@extends('almuhfazun.layouts.app')

@push('css')
    <style>
        .table_modal {
            width: 100%;

        }

        .table_modal tr {
            padding: 20px;
        }
    </style>
@endpush
@section('content')
    <div class="appOne" style="background: #fff;">
        <div class="guarantor">
            <div class="title" style="color:#fff;background:#555;display:flex; justify-content:center;align-items:center">
                <h5> <span style="color:#75f98c;"> <i class="ri-shield-user-fill"></i>مرحبا </span>
                    {{ auth()->user()->name }} </h5>
            </div>
            <p> هذه الصفحة تمكنكم من متابعة <span class="fw-bold">الحلقات</span> <br /> ولكم كل الشكر والتقدير على دعمكم لنا
                🌹 </p>
            <p> </p>
        </div>
        <div class="info bg-success text-white p-2 d-flex justify-content-between rounded-1"
            style="width:70%;margin:10px auto">
            <span>العام الدراسي : {{ $Setting->year }} || {{ $Setting->year + 1 }}</span>
            <span>الترم : {{ $Setting->session->name }}</span>
        </div>

        <input type="date" style="background:#fd7e14;color:#2e1805;font-weight:bold;width:50%;margin:auto"
            class="form-control" id="date" value="{{ date('Y-m-d') }}">

        <div class="listOfName">
            <input type="hidden" id="session_id" name="session_id" value="{{ $Setting->session_id }}">
            <input type="hidden" id="year" name="year" value="{{ $Setting->year }}">
            <input type="hidden" id="session_name" name="session_name" value="{{ $Setting->session->name }}">

            <select id="Almustawayats" class="areaName" style="font-size:16px;background:#ffd400;border-radius:5px;">
                {{-- <option value="0" selected>الاختبارات</option> --}}
                <option value="all" selected>الكل</option>
                <option value="1" >اختبار 1</option>
                <option value="2">اختبار2</option>
                <option value="3">اختبار السرد</option>
                <option value="4">اختبار النهائي</option>
            </select>

            <select id="Alhalaqats" class="mainMaleOrFemaleHomePage"
                style="font-size:16px;background:#ffd400;border-radius:5px;">
                <option value="0" selected>الحلقة</option>
                @foreach ($Alhalaqats as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select> <button style="padding: 0;background:#ffd400" class="btn btn-sm  mychose fw-bold getMadmen">
                <i class="ri-file-add-line"></i> المضامين</button> <button style="padding: 0;background:#ffd400"
                class="btn btn-sm  mychose fw-bold getVoters d-none"> <i class="ri-file-add-line"></i>
                الرئيسية</button>
            <h4 class="openDropdown">
                <div class="d-flex" style="font-size: 15px;"> <span class="getNumber"></span> <i class="ri-search-line"></i>
                </div>
                <!--                                     <button style="padding: 0;background:#ffd400"                   class="btn btn-sm  mychose fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModa2"> <i class="ri-file-add-line"></i> المضامين</button>              -->
                <!-- <a href="madmenHome.php?username=mandani&id=2" target="_blank"  style="padding: 0;background:#ffd400">المضامين</a> -->
            </h4>

            <div class="dropdown active" id="showVoters">
                <div class="table-responsive">


                    <table id="getAllStudents" class="table table-secondary table-striped " style="width:100%">
                        <thead>
                   
                            <tr>
                                <th>#</th>
                                <th>اسم الحافظ/ة</th>
                                <th>اختبار 1</th>
                                <th>اختبار 2</th>
                                <th>السرد</th>
                                <th>النهائي</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>

        </div>

    </div>
    @include('almuhfazun.alaikhtibarat.modal')
@endsection
@push('js')
    <script>
        var table = $('#getAllStudents').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('almuhfazun.alaikhtibarat.index') !!}',
                data: function(d) {
                    // d.Almustawaya = $('#Almustawayats').val();
                    d.Alhalaqat = $('#Alhalaqats').val();
                    d.session_id = $("#session_id").val();
                    // d.date = $('#date').val();
                }
            },
            columns: [{
                    "data": "DT_RowIndex",
                    "name": "DT_RowIndex"
                },
                {
                    "data": "get_name"
                },
                {
                    "data": "test_1"
                },
                {
                    "data": "test_2"
                },
                {
                    "data": "test_3"
                },
                {
                    "data": "test_4"
                },
            ],

        });

        $('#Alhalaqats').change(function() {
            table.ajax.reload(); // Reload the DataTable when the dropdown value changes
        })



        // عند الضغط على اسم الطالب
        $(document).on("click", ".get_info_talib", function() {
            let id = $(this).data("id");
            let username = $(this).data("name");
            let Almustawayats = $("#Almustawayats").val();
            let session_id = $("#session_id").val();
            let year = $("#year").val();
            
            let session_name = $("#session_name").val();

            $.ajax({
                url: "{{ route('almuhfazun.alaikhtibarat.info', '') }}" + '/' + id,
                type: 'POST',
                data: {
                    Almustawayats: Almustawayats,
                    session_id: session_id,
                    year:year,
                    session_name: session_name,
                    username: username,
                    talib_id: id
                },
                success: function(data) {
                    $(".modal-body").html(data)
                }
            });
        })

        $(document).on("submit", "#form_insert_alaikhtibarat", function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('almuhfazun.alaikhtibarat.insert') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    console.log(data);
                    if (data == 'success') {
                        Swal.fire({
                            title: "بنجاح",
                            text: "تم ادخال النتيجة بنجاح",
                            icon: "success"
                        });

                        table.ajax.reload(); // Reload the DataTable when the dropdown value changes


                    }
                }
            });
        });
        $(document).on("submit", "#form_update_alaikhtibarat", function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('almuhfazun.alaikhtibarat.update') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    if (data == 'success') {
                        Swal.fire({
                            title: "بنجاح",
                            text: "تم تعديل البيانات بنجاح",
                            icon: "success"
                        });

                        table.ajax.reload(); // Reload the DataTable when the dropdown value changes

                    }
                }
            });

        });
    </script>
@endpush
