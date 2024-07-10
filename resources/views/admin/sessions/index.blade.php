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
                        الفصول
                    </h2>
                </div>

                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">



                        <a href="#" class="openModal btn btn-teal d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-add">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            اضافة فصل
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#modal-add" aria-label="Create new report">
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

    <!-- Modal Add New Level -->

    <div class="modal modal-blur fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">اضافة مدير جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="error-messages"></div>

                    <form id="insert" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="uploadId" name="uploadId">
                        <input type="hidden" id="passwordHidden" name="passwordHidden">
                        <div class="form-group mb-4">
                            <label for="">الاسم</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <div class="text-danger nameError"></div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="">اختر رقم شهر البداية </label>
                            <select id="from" name="from" class="form-control">
                                @php
                                    $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                                @endphp
                                @foreach ($months as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="">اختر رقم شهر النهاية </label>
                            <select id="to" name="to" class="form-control">
                                @php
                                    $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                                @endphp
                                @foreach ($months as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" id="submit" class="btn btn-primary">ادخال المستوي</button>
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">اغلاق</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('content')
    @if (Session::has('delete'))
        <div class="alert alert-important alert-success alert-dismissible" role="alert">
            <div class="d-flex">
                <div>
                    <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                    </svg>
                </div>
                <div>
                    {{ Session::get('delete') }}
                </div>
            </div>

        </div>
    @endif
    <table id="mangers" class="table  table-bordered table-light table-sm" style="width:100%">
        <thead>
            <tr>
                <th>الرقم</th>
                <th>الاسم</th>
                <th>تاريخ البداية</th>
                <th>تاريخ النهاية</th>

                <th>
                    الاجراءت
                </th>
            </tr>
        </thead>
        <tbody id="tbody">
            @php
                $i = 1;
            @endphp
            @foreach ($Sessions as $Session)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $Session->name }}</td>
                    <td>{{ $Session->from }} شهر</td>
                    <td>{{ $Session->to }} شهر</td>
                    <td>
                        <form action="{{route('admin.sessions.destory',$Session->id)}}" method="POST"
                            onsubmit="return confirm('سوف تقوم بحذف العنصر')">
                            @csrf 
                            @method('DELETE')
                   
                            <a href="#" class="btn btn-indigo btn-sm update-btn" data-id="{{ $Session->id }}"
                                class="btn btn-sm btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                                تعديل</a>

                            <button type="submit" class="btn btn-danger btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor"
                                    class="icon icon-tabler icons-tabler-filled icon-tabler-trash-x">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16zm-9.489 5.14a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z">
                                    </path>
                                    <path
                                        d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z">
                                    </path>
                                </svg>
                                حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('css')
@endpush
@push('js')
    <script>
        $(".openModal ").click(function() {
            $("#submit").html('ادخال البيانات');
            $(".modal-title").html('ادخال مدير جديد');
            $("#insert")[0].reset();
        });


        // Update 
        $(document).on('click', '.update-btn', function() {
            $("#submit").html('تعديل');
            $(".modal-title").html('تعديل بيانات الفصل');

            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.sessions.show', '') }}" + '/' + id,
                type: 'POST',
                success: function(data) {
                    $('#from option').each(function() {
                        if ($(this).val() === data.from) {
                            $(this).attr("selected","selected");
                        }
                    })

                    $('#to option').each(function() {
                        if ($(this).val() === data.to) {
                            $(this).attr("selected","selected");
                        }
                    })
                    $("#name").val(data.name)
                    $("#uploadId").val(data.id);
                    $('#modal-add').modal('show');
                }
            });
        });

        // Dtatables 
        $('#mangers').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json"
            }
        });


        $('#insert').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            var id = $('#uploadId').val();
            var idAlmustawaya = $("#idAlmustawaya").val();
            let url = id ? `{{ route('admin.sessions.update', '') }}` + '/' + id :
                "{{ route('admin.sessions.store') }}";
            let type = id ? 'POST' : 'POST';

            $.ajax({
                type: type,
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.status == 201) {
                        if (response.type == 'update') {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "تم التعديل بنجاح",
                                showConfirmButton: false,
                                timer: 1500
                            });

                        } else {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "تم الاضافة بنجاح",
                                showConfirmButton: false,
                                timer: 1500
                            });

                        }

                        $(".btn-close").click();
                        $("#insert")[0].reset();
                        setInterval(() => {
                            window.location.href =
                                '{{ route('admin.sessions.index', '') }}'
                        }, 1000);
                    }


                },
                error: function(response) {
                    console.log(response);

                    if (response.responseJSON.errors) {
                        var errorMessages = '<div class="alert alert-danger"><ul>';
                        $.each(response.responseJSON.errors, function(key, messages) {
                            $.each(messages, function(index, message) {
                                errorMessages += '<li>' + message + '</li>';
                            });
                        });
                        errorMessages += '</ul></div>';
                        $('#error-messages').html(errorMessages);
                    }

                }


            });
        });
    </script>
@endpush
