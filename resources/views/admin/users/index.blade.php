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
                        المحفظون
                    </h2>
                    <a href="{{route('admin.users.export')}}" class="btn btn-success">تصدير EXCEL</a>
                </div>
           


                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">



                        <a href="#" class="openModal btn btn-info d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-add">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            اضافة محفظ
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
                        <input type="hidden" id="imageUpdate" name="imageUpdate">
                        <div class="form-group mb-4">
                            <label for="">الاسم</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <div class="text-danger nameError"></div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="">الصورة الشخصية</label>
                            <input type="file" name="photo" id="photo" class="form-control">
                        </div>


                        <div class="form-group mb-4">
                            <label for="">الرقم المدني</label>
                            <input type="text" required name="cid" id="cid" class="form-control">
                            <div class="text-danger cidError"></div>
                        </div>



                        <div class="form-group mb-4">
                            <label for="">تاريخ الميلاد</label>
                            <input type="date" required name="date_of_birth" id="date_of_birth" class="form-control">
                            <div class="text-danger "></div>
                        </div>


                        <div class="form-group mb-4">
                            <label for="">البريد</label>
                            <input type="text" name="email" id="email" class="form-control">
                            <div class="text-danger emailError"></div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="">كلمة المرور</label>
                            <input type="text" name="password" id="password" class="form-control">
                            <div class="text-danger passwordError"></div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="">الهاتف</label>
                            <input type="number" name="phone" id="phone" class="form-control">
                            <div class="text-danger phoneError"></div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="">الجنس</label>
                            <select name="gender" id="gender" class="form-control">
                                <option id="male" value="1">ذكر</option>
                                <option id="female" value="0">انثي</option>
                            </select>
                        </div>

                        <div class="my-4">
                            <div class="form-label">الاختبارات</div>
                            <label class="form-check form-switch">
                                <input class="form-check-input" name="tests" id="tests" id="checkbox"
                                    type="checkbox">
                            </label>
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
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
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
    <div class="row">
        <div class="col-12">
            <form action="{{route('admin.users.index')}}"  class="row gx-3 gy-2 align-items-center" method="GET">
                <div class="col-sm-3">
                  <label class="visually-hidden" for="specificSizeInputGroupUsername">Username</label>
                  <div class="input-group">
                    <div class="input-group-text">الجنس</div>
                    {{-- <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Username"> --}}
                    <select name="gender" class="form-control">
                        <option value="" selected disabled>اختر الجنس</option>
                        <option value="1">ذكور</option>
                        <option value="0">آناث</option>
                    </select>
                  </div>
                </div>
                <div class="col-auto">
                  <button type="submit" class="btn btn-primary">فلتر</button>
                </div>
              </form>
        </div>
    </div>
    <div class="table-responsive">
        <table id="mangers" class="table  table-bordered table-sm" style="width:100%">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>الاسم</th>
                    <th>الرقم المدني</th>
                    <th>العمر</th>
                    <th>البريد</th>
                    <th>الجنس</th>
                    <th>الهاتف</th>
                    <th>كلمة المرور</th>
                    <th>
                        الاجراءت
                    </th>

                </tr>
            </thead>
            <tbody id="tbody">
                @php
                    $i = 1;
                @endphp
                @forelse ($Users as $Item)
                    <tr @if ($Item->gender == 0) style="background: #fd9cff;font-weight:bold;color:#551456" @endif>
                        <td class="update-link" data-route="{{ route('admin.users.details', $Item->id) }}">
                            {{ $i++ }}</td>
                        <td class="modal-link update-btn" data-id="{{ $Item->id }}">{{ $Item->name }}</td>
                        <td>{{ $Item->cid }}</td>
                        <td>
                            @php
                                $age = \Carbon\Carbon::parse($Item->date_of_birth)->age;
                            @endphp
                            {{ $age }}
                        </td>
                        <td>{{ $Item->email }}</td>
                        <td>{{ $Item->gender() }}</td>
                        <td>{{ $Item->phone }}</td>
                        <td>{{ $Item->showPassword }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-warning dropdown-toggle align-text-top" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    الخيارات
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <a href="{{ route('admin.users.halqa', $Item->id) }}"
                                        class="fw-bold  dropdown-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link-minus" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M9 15l6 -6" />
                                            <path d="M11 6l.463 -.536a5 5 0 1 1 7.071 7.072l-.534 .464" />
                                            <path d="M12.603 18.534a5.07 5.07 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
                                            <path d="M16 19h6" />
                                          </svg>
                                        الحلقات</a>
                                    @can('حذف حافظ')
                                        <form class="dropdown-item d-inline" id="deletealmustawaya"
                                           action="{{ route('admin.users.delete', $Item->id) }}"
                                            onsubmit="return confirm('سوف تقوم بحذف العنصر')" method="POST">
                                            @csrf
                                            @method('DELETE')
    
                                            <button style="border: none;background:none;width:100%;"
                                                class="fw-bold text-danger px-0 py-1 text-end">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-trash-off" width="44"
                                                    height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff4500"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M3 3l18 18" />
                                                    <path d="M4 7h3m4 0h9" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 14l0 3" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l.077 -.923" />
                                                    <path d="M18.384 14.373l.616 -7.373" />
                                                    <path d="M9 5v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                                حذف</button>
                                        </form>
                                    @endcan
    
    
                                </div>
                            </div> 
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('css')
@endpush
@push('js')
    <script>
        $(".openModal ").click(function() {
            $("#submit").html('ادخال البيانات');
            $(".modal-title").html('ادخل بيانات محفظ جديد');
            $("#insert")[0].reset();
        });


        // Update 
        $(document).on('click', '.update-btn', function() {
            $("#submit").html('تعديل البيانات');
            $(".modal-title").html('تعديل بيانات المدير');

            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.users.show', '') }}" + '/' + id,
                type: 'POST',
                success: function(data) {
                    if (data.test == 1) {
                        $("#tests").prop("checked", "checked")
                    } else {
                        $("#tests").prop("checked", false)

                    }
                    if (data.gender == 0) {
                        $("#female").attr("selected", "selected")

                    } else {
                        $("#male").attr("selected", "selected")
                    }
                    $("#uploadId").val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#title').val(data.title);
                    $("#passwordHidden").val(data.showPassword);
                    $("#date_of_birth").val(data.date_of_birth);
                    $("#cid").val(data.cid);
                    $("#imageUpdate").val(data.photo);

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
            let url = id ? `{{ route('admin.users.update', '') }}` + '/' + id :
                "{{ route('admin.users.add') }}";
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
                                '{{ route('admin.users.index', '') }}'
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
