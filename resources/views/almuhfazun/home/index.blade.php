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

        {{-- <div style="display: flex;    justify-content: center;    gap: 7px ">
        <div style="font-size:12px;">ساكن : <span
                style="font-size:12px;background:#198754;padding:0 5px;color:#fff">
                187 </span> <span style="font-size:12px;background:#0d6efd;padding:0 5px;color:#fff">
                36 </span> </div>
        <div style="font-size:12px;">ذكور : <span
                style="font-size:12px;background:#198754;padding:0 5px;color:#fff">
                67 </span> <span style="font-size:12px;background:#0d6efd;padding:0 5px;color:#fff">
                25 </span> </div>
        <div style="font-size:12px;">اناث : <span
                style="font-size:12px;background:#198754;padding:0 5px;color:#fff">
                120 </span> <span style="font-size:12px;background:#0d6efd;padding:0 5px;color:#fff">
                11 </span> </div>
        <div style="font-size:12px;">النسبة : <span
                style="font-size:12px;background:#0d6efd;padding:0 5px;color:#fff">
                96%
            </span></div>
    </div> --}}
        <div class="listOfName">
            <select id="Almustawayats" class="areaName" style="font-size:16px;background:#ffd400;border-radius:5px;">
                <option selected value="">المستوي</option>
                @foreach ($Almustawayats as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
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
            <div id="showMamen" class="d-none dropdown">
                <div class="selectMadmen"> <select
                        style="font-size: 16px; background: rgb(255, 212, 0); border-radius: 5px;" id="GenderHome">
                        <option value="" selected disabled>الجنس</option>
                        <option value="all">الكل</option>
                        <option value="1">ذكور</option>
                        <option value="2">اناث</option>
                    </select> <select style="font-size: 16px; background: rgb(255, 212, 0); border-radius: 5px;"
                        id="committee">
                        <option value="" selected disabled>اللجان</option>
                        <option value="all">الكل</option>
                        <option value=5>5</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=1>1</option>
                        <option>1</option>
                    </select> </div>
                <table class="table getTableMadmen  table-secondary table-striped" style="width:100%;">
                    <thead>
                        <tr>
                            <th> <input type="checkbox" data-target=".mainCheckbox" class="checkall checkallMadmen" /> <span
                                    class="getNumberMadmen2" style="position: absolute;right: 60px;"></span> </th>
                            <th class="name2 " style="text-align: right;">اسماء المضامين</th>
                            <th> العائلة</th>
                            <th> <span class="getNumberAttend"></span> <span class="textAttend">حضور</span> </th>
                        </tr>
                    </thead>
                    <tbody> </tbody>
                </table>
                <div class="insertList "> <select name="" style="padding: 8px 0;" id="valueList2"
                        class="form-control  rounded-0"> </select> <button id="insetListContent"
                        class="voteButtonMain py-2 rounded-0">تطبيق</button> </div>
            </div>
            <div class="dropdown active" id="showVoters">
                <div class="table-responsive">
                    {{-- <select class="searchname">
                    <option value="1">بحث عام</option>
                    <option value="0">بحث مخصص</option>
                </select> --}}
                    <table id="getAllStudents" class="table table-secondary table-striped " style="width:100%">
                        <thead>
                            {{-- <tr>
                            <th> <input type="checkbox" data-target=".mainCheckbox" class="checkall" /> <span
                                    class="getNumberMadmen"
                                    style="position: absolute;right: 56px;z-index:1   "></span> </th>
                            <th>الاسم</th>
                            <th> الغرفة</th>
                        </tr> --}}
                            <tr>
                                <th>#</th>
                                <th>اسم الحافظ/ة</th>
                                <th>الدرجة</th>
                                <th>المستوي</th>
                                <th>الهاتف</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>
            <div class="countVoters">
                <h5 class="titlelist openDropdown "> <span class="text-white"><span class="badge bg-light text-dark">
                            80 </span> الغرف </span> </h5>
                <div class="dropdown" style="width: 100%; display: none;">
                    <table style="margin: 0;" class="table table-warning table-bordered tablelist">
                        <thead>
                            <tr>
                                <th> <span class="badge text-warning text-center"
                                        style="width:100%;text-align:left;font-size:15px;font-weight:bold;">
                                        80 </span> </th>
                                <th class="name text-center">رقم الغرفة</th>
                                <th>العدد</th>
                                <th style="padding:0 10px; text-align: center;">النوع</th>
                            </tr>
                        </thead>

                    </table> <button style="float:left;                                         width:100%"
                        class="btndeletelist">حذف <i class="ri-delete-bin-5-fill"></i></button>
                </div>
            </div>
        </div>
        <div class="createListNames">
            <div class="parent">
                <h3 class="openDropdown text-center">مجموعة</h3>
                <div class="dropdown active">
                    <form id="createroom"> <input type="hidden" name="createroom"> <input type="hidden"
                            name="id_event" value="3"> <input type="text" id="name" required
                            name="room_number" placeholder="اكتب اسم الغرفة"> <select name="room_type">
                            <option value="1">احادي</option>
                            <option value="2">ثنائي</option>
                            <option value="3">ثلاثي</option>
                            <option value="4">رباعي</option>
                            <option value="5">خماسي</option>
                            <option value="6">سداسي</option>
                        </select> <button type="submit" class="click width-100">انشاء</button> </form>
                </div>
            </div>
        </div>
    </div>
    @include('almuhfazun.home.modal')
@endsection
@push('js')
    <script>
        var get_date = $("#date").val();

        var table = $('#getAllStudents').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('almuhfazun.home') !!}',
                data: function(d) {
                    d.Almustawaya = $('#Almustawayats').val();
                    d.Alhalaqat = $('#Alhalaqats').val();
                    d.date = $('#date').val();
                }
            },
            columns: [{
                    "data": "DT_RowIndex",
                    "name": "DT_RowIndex"
                }, // This is the index column
                {
                    "data": "get_name"
                }, // This is the index column
                {
                    "data": "degree"
                }, // This is the index column
                {
                    "data": "level"
                }, // This is the index column
                {
                    "data": "phone"
                }, // This is the index column



            ],

        });
        $('#Almustawayats').change(function() {
            table.ajax.reload(); // Reload the DataTable when the dropdown value changes
        });

        $('#Alhalaqats').change(function() {
            table.ajax.reload(); // Reload the DataTable when the dropdown value changes
        });

        $('#date').change(function() {
            get_date = $(this).val();
            table.ajax.reload(); // Reload the DataTable when the dropdown value changes

        });


        $(document).on("click", ".get_info_talib", function() {
            let id = $(this).data("id");
            let name = $(this).data("name");

            $.ajax({
                url: "{{ route('almuhfazun.talib.info', '') }}" + '/' + id,
                data: {
                    date: get_date
                },
                type: 'POST',
                success: function(data) {
                    // if (data.founed == 'true') {

                    //     var attend = '';
                    //     if (data.Tasmie.attend == 1) {
                    //         attend = '<span class="bg-success text-white">حاضر</span>';
                    //     }
                    //     if (data.Tasmie.attend == 3) {
                    //         attend = '<span class="bg-primary text-white">حاضر اون لاين</span>';
                    //     }
                    //     if (data.Tasmie.attend == 0) {
                    //         attend = '<span class="bg-danger text-white">غائب</span>';
                    //     }
                    //     if (data.Tasmie.attend == 2) {
                    //         attend = '<span class="bg-warning ">غائب بعذر</span>';
                    //     }


                    //     $(".modal-body").html(`
                //     <table class="table">
                //         <thead>
                //             <tr>
                //             <td>الاسم :</td>
                //             <td>${data.Tasmie.talib.name}</td>
                //             </tr>
                //              <tr>
                //             <td>الحضور :</td>
                //             <td>${attend}</td>
                //             </tr>
                //              <tr>
                //             <td>الدفعة :</td>
                //             <td>${data.Tasmie.talib.aldafeuh.name}</td>
                //             </tr>
                //              <tr>
                //             <td>المستوى :</td>
                //             <td>${data.Tasmie.talib.almustawayat.name}</td>
                //             </tr>
                //              <tr>

                //             <td>الجزء :</td>
                //             <td>${data.Tasmie.part.title}</td>
                //             </tr>
                //              <tr>
                //             <td>عدد الأرباع	 :</td>
                //             <td>${data.Tasmie.number_of_quarters}</td>
                //             </tr>
                //               <tr>

                //             <td>المنهج	 :</td>
                //             <td>${data.Tasmie.almanhaj.title}</td>
                //             </tr>
                //               <tr>
                //             <td>الدرجة	 :</td>
                //             <td>${data.Tasmie.degree}</td>
                //             </tr>
                //              <tr>
                //             <td>ملاحظات	 :</td>
                //             <td>${data.Tasmie.comment}</td>
                //             </tr>
                //             </thead>
                //         </table>
                //     `);
                    // } else {

                    let parts = '';

                    data.Parts.forEach(function(value, index) {
                        parts += `<option value=${value.id}>${value.title}</option>`;
                    });

                    let number_of_quarters = '';
                    $([1, 2, 3, 4, 5, 6, 7, 8]).each(function(index) {
                        number_of_quarters +=
                            `<option value=${index + 1}>${index + 1}</option>`;
                    })

                    console.log(data);
                    $(".modal-title").html(data.name)
                    
                    if (data.Tasmie == null) {
                        $(".modal-body").html(`
<h4>ادخال بيانات الطالب : ${name}</h4>
<form id="tasmie_form"  method="POST">
    @csrf
    <input type="hidden" name="talib_id" value="${id}" />
    <input type="hidden" name="hidden_date" value="${get_date}"  id="hidden_date" />
    <div class="form-group">
        <labe>الحضور</label>
           <select name="attend" class="form-control">
            <option value="1">حاضر</option>
            <option value="3">حاضر اون لاين</option>
            <option value="0">غائب</option>
            <option  value="2">غائب بعذر</option>
    </select>
    </div>
    <div class="form-group my-2">
        الدفعه : ${data.Talibs.aldafeuh.name}
        </div>

            <div class="form-group my-2">
        المستوي : ${data.Talibs.almustawayat.name}
        </div>

          <div class="form-group">
        <labe>الجزء</label>
           <select id="parts" name="part_id" class="form-control">
            ${parts} 
        </select>

    </div>
        <div class="form-group">
        <labe>عدد الارباع</label>
           <select name="number_of_quarters" class="form-control">
            ${number_of_quarters} 
        </select>
        
    </div>
        <div class="form-group">
        <labe>المنهج</label>
           <select required id="almanhaj" name="almanhaj_id" class="form-control">
         </select>
        
    </div>
        <div class="form-group">
        <labe>الدرجة</label>
        <input type="text" required name="degree" class="form-control" />
        
    </div>
        <div class="form-group">
            <labe>الملاحظة</label>
        <input type="text" name="comment" class="form-control" />
           </div>

           <div class="form-group">
            <input type="submit"  class="btn btn-primary my-2" value="ادخال النتيجة" />
            </div>  
    </form>
`);

                    } else {

                        $(".modal-body").html(data.Tasmie)
                    }



                }


            });
        });


        $(document).on("submit", "#tasmie_form", function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('almuhfazun.tasmie.insert') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response == 'success') {
                        table.ajax.reload(); // Reload the DataTable when the dropdown value changes

                        Swal.fire({
                            title: "بنجاح",
                            text: "تم ادخال النتيجة بنجاح",
                            icon: "success"
                        });

                    }
                }
            })
        })

        $(document).on("change", "#parts", function() {
            var selectedId = $(this).val();
            if (selectedId) {
                $('#almanhaj').empty();
                $.ajax({
                    url: "{{ route('almuhfazun.almanhaj.get', '') }}" + '/' + selectedId,
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#almanhaj').empty();
                        $.each(data, function(key, value) {
                            $('#almanhaj').append('<option value="' + value.id + '">' + value
                                .title + '</option>');
                        });
                    },
                    error: function(err) {
                        console.log(err)
                    }
                });
            } else {
                $('#almanhaj').empty();
            }
        });
    </script>
@endpush
