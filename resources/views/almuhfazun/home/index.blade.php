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

            <div class="dropdown active" id="showVoters">
                <div class="table-responsive">
                    <a href="#" target="_blank" id="url_Room" class="d-none btn btn-primary btn-sm fw-bold "
                        style="    position: absolute;
    left: 14px;
    top: 4px;
    z-index:99999" class="d-block">غرفة
                        التسميع</a>

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
                                <th></th>
                                <th>اسم الحافظ/ة</th>
                                <th></th>

                                <th>الدرجة</th>
                                <th>المستوي</th>
                                <th>الهاتف</th>
                            </tr>
                        </thead>

                    </table>
                </div>
                <div class="insertList ">
                    <select style="padding: 8px 0;" id="valueList" class="form-control  rounded-0">
                        <option value="">المجموعات</option>
                        @foreach ($Groups as $item)
                            <option value="<?= $item->id ?>"><?= $item->name ?></option>
                        @endforeach
                    </select>
                    <button id="insetListContent" class="insertBtnMain py-2 rounded-0">تطبيق</button>
                </div>
            </div>
            <div class="countVoters">
                <div class="col-12">


                    @if (Session::has('delete-group'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('delete-group') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <h5 class="titlelist openDropdown "> <span class="text-white"><span class="badge bg-light text-dark">
                            {{ count($Groups) }} </span> المجموعات </span> </h5>
                <div class="dropdown" style="width: 100%; display: none;">
                    <table style="margin: 0;" class="table table-warning table-bordered tablelist">
                        <thead>
                            <tr>
                                <th> <span class="badge text-warning text-center"
                                        style="width:100%;text-align:left;font-size:15px;font-weight:bold;">
                                    </span> </th>
                                <th class="name text-center">الاسم</th>
                                <th>العدد</th>
                                <th style="padding:0 10px; text-align: center;">الاجراءت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($Groups as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td data-id="{{ $item->id }}" class="open-group" data-bs-toggle="modal"
                                        data-name = "{{ $item->name }}" data-bs-target="#modalStudent">
                                        {{ $item->name }}</td>
                                    <td>{{ $item->count_of_talibs() }}</td>
                                    <td>
                                        <form action="{{ route('almuhfazun.group.delete', $item->id) }}"
                                            onsubmit="return confirm('سوف تقوم بالحذف ؟ ')" method="POST">
                                            @csrf
                                            {{-- <a href="#" class="text-danger">حذف</a> --}}
                                            <button class="btn btn-sm btn-danger">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button style="float:left;width:100%" class="btndeletelist">حذف <i
                            class="ri-delete-bin-5-fill"></i></button>
                </div>
            </div>
        </div>
        <div class="createListNames py-4">
            <div class="parent">
                <h3 class="openDropdown text-center">انشاء مجموعة</h3>
                <div class="dropdown active">
                    <form id="createroom">

                        <input type="text" id="name" required class="room_name" name="room_name"
                            placeholder="اسم المجموعة">
                        <button type="submit" class="click width-100">انشاء</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('almuhfazun.home.modal')
@endsection
@push('js')
    <script>
        // فتح الجروب
        $(".open-group").on("click", function() {
            let id = $(this).data("id");
            let name = $(this).data("name");
            $.ajax({
                url: "{{ route('almuhfazun.group.open') }}",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    $('.modal-body').empty();
                    if (data == 'empty') {
                        
                        $('.modal-body').html(`
                        <div class="alert alert-warning">لا يوجد طلاب</div>
                        `);

                    } else {
                        let info = `
                        <h4>مجموعة ${name}</h4>
                    <table class="table">
                        <tr>
                            <th>الاسم</th>
                            <th>الاجراءت</th>
                            </tr>
                    `
                        $.each(data, function(key, value) {
                            info += `
                        <tr>
                            <td>${value.name}</td>
                            <td class="text-center delete-person-from-group" data-id=${id} data-talib=${value.id}><a href="#" class="btn btn-sm btn-danger">حذف</a></td>
                            </tr>
                        `
                        });
                        $('.modal-body').html(info);
                    }

                }
            });
        })

        $(document).on("click", ".delete-person-from-group", function() {
            let id_talib = $(this).data("talib");
            let id_group = $(this).data("id");
            let parent = $(this).parent();

            let confirmation = confirm('سوف تقوم بعملية الحذف');
            if (confirmation) {
                $.ajax({
                    url: "{{ route('almuhfazun.group.delete.person') }}",
                    method: "POST",
                    data: {
                        id_talib: id_talib,
                        id_group: id_group
                    },
                    success: function(data) {
                        if (data == 'success') {
                            $(parent).hide();
                        }
                    }

                });
            }
        })
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
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },


                {
                    "data": "get_name"
                },
                {
                    data: 'colors',

                },
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

            let id = $(this).val();

            $.ajax({
                url: "{{ route('almuhfazun.alhalaqat.get.room', '') }}" + '/' + id,
                method: "POST",
                data: {},
                success: function(data) {
                    if (data.room_url == null) {
                        $("#url_Room").addClass("d-none")
                    } else {
                        $("#url_Room").removeClass("d-none")
                        $("#url_Room").attr("href", data.room_url)
                    }
                }
            });
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


                    let parts = '';

                    data.Parts.forEach(function(value, index) {
                        parts += `<option value=${value.id}>${value.title}</option>`;
                    });

                    let number_of_quarters = '';
                    $([1, 2, 3, 4, 5, 6, 7, 8]).each(function(index) {
                        number_of_quarters +=
                            `<option value=${index + 1}>${index + 1}</option>`;
                    })

                    $(".modal-title").html(data.name)

                    if (data.Tasmie == null) {
                        $(".modal-body").html(`
<h4>ادخال بيانات الطالب : ${name}</h4>
<form id="tasmie_form"  method="POST">
    @csrf
    <input type="hidden" name="talib_id" value="${id}" />
    <input type="hidden" name="alhalaqat_id" value="${data.Talibs.alhalaqat.id}" />
    <input type="hidden" name="hidden_date" value="${get_date}"  id="hidden_date" />
    <div class="form-group">
        <labe>الحضور</label>
           <select name="attend" class="form-control attend">
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
           <select name="part_id" class="form-control parts" required>
            <option value="" selected disabled>الجزء</option>
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
        <input type="text" required name="degree" class="form-control degree" />
        
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
                        console.log(data);
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
                    console.log(response);
                    if (response == 'success') {
                        table.ajax.reload(); // Reload the DataTable when the dropdown value changes

                        Swal.fire({
                            title: "بنجاح",
                            text: "تم ادخال النتيجة بنجاح",
                            icon: "success"
                        });

                    }
                },
                error: function(err) {
                    console.log(err)
                }
            })
        })

        $(document).on("submit", "#tasmie_update", function(e) {
            e.preventDefault();
            let id = $("#tasmie_id").val();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('almuhfazun.tasmie.update', '') }}" + '/' + id,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 'success') {
                        table.ajax.reload(); // Reload the DataTable when the dropdown value changes
                        Swal.fire({
                            title: "بنجاح",
                            text: "تم تعديل البيانات بنجاح",
                            icon: "success"
                        });

                    }
                },
                error: function(err) {
                    console.log(err)
                }
            })

        });

        $(document).on("change", ".parts", function() {
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

        // ادخال الطلاب المجموعات
        $("#insetListContent").on("click", function() {
            var selectedValues = [];
            table.$('input.talib_checkbox:checked').each(function() {
                selectedValues.push($(this).val());
            });



            let id_group = $("#valueList").val();
            if (id_group == '') {
                Swal.fire({
                    title: "خطأ",
                    text: "حدد الغرفة",
                    icon: "error"
                });
            } else {
                if (selectedValues.length == 0) {
                    Swal.fire({
                        title: "خطأ",
                        text: "من فضلك حدد الاشخاص",
                        icon: "error"
                    });
                } else {
                    $.ajax({
                        url: "{{ route('almuhfazun.group.insert') }}",
                        type: 'POST',
                        data: {
                            id_group: id_group,
                            selectedValues: selectedValues
                        },
                        success: function(data) {
                            if (data == 'success') {
                                Swal.fire({
                                    title: "بنجاح",
                                    text: "تم الاضافة بنجاح",
                                    icon: "success"
                                });
                            }
                        },
                        error: function(err) {
                            console.log(err)
                        }
                    });
                }

            }
        });
        // انشاء مجموعة
        $("#createroom").on("submit", function(e) {
            e.preventDefault();

            let room_name = $(".room_name").val();
            $.ajax({
                url: "{{ route('almuhfazun.create.room') }}",
                type: 'POST',
                data: {
                    room_name: room_name
                },
                success: function(data) {
                    if (data == 'founded') {
                        Swal.fire({
                            title: "خطأ",
                            text: "الاسم موجود من قبل",
                            icon: "error"
                        });
                    } else {
                        Swal.fire({
                            title: "بنجاح",
                            text: "تم انشأ المجموعة بنجاح",
                            icon: "success"
                        });
                    }
                    $("#createroom")[0].reset();
                },
                error: function(err) {
                    console.log(err)
                }
            });
        });

        $(document).on("change",".attend",function(){

            var attend = $(this).val();
            if(attend == 0 || attend == 2){
                $(".degree").val('0');
                // $("#degree").attr('disabled', 'disabled');

            }
        })
    </script>
@endpush
