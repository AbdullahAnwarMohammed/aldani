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
                        المستويات
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        @can('اضافة مستوي')
                            <a href="#" class="openModal btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modal-add">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                اضافة مستوي جديد
                            </a>
                        @endcan
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
                    <h5 class="modal-title">اضافة قسم جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insert" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="uploadId" name="uploadId">
                        <div class="form-group mb-4">
                            <label for="">الاسم <span class="text-danger">(مطلوب)</span> </label>
                            <input type="text" name="name" id="name" class="form-control">
                            <div class="text-danger nameError"></div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">الملاحظات</label>
                            <textarea name="comment" class="form-control" id="comment" cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit" id="almustawayatSubmit" class="btn btn-primary">ادخال المستوي</button>
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">اغلاق</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row my-4">
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-stamp">
                    <div class="card-stamp-icon bg-yellow">
                        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                            </path>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="card-title">المستويات</h3>
                    <p class="text-secondary">
                        @if (count($Almustawayas) > 0)
                            <span class="badge bg-success">{{ count($Almustawayas) }}</span>
                        @else
                            <span class="badge bg-danger">0</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-stamp">
                    <div class="card-stamp-icon bg-yellow">
                        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                            </path>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="card-title">الاجزاء</h3>
                    <p class="text-secondary">
                        @if (count($Parts) > 0)
                            <span class="badge bg-success">{{ count($Parts) }}</span>
                        @else
                            <span class="badge bg-danger">0</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-stamp">
                    <div class="card-stamp-icon bg-yellow">
                        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                            </path>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="card-title">المناهج</h3>
                    <p class="text-secondary">
                        @if (count($Almanhajs) > 0)
                            <span class="badge bg-success">{{ count($Almanhajs) }}</span>
                        @else
                            <span class="badge bg-danger">0</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="almustawayas" class="table table-info table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>المستوي</th>
                    <th>الملاحظة</th>
                    <th>الخيارات</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach ($Almustawayas as $Item)
                    <tr>
                        <td>{{ $Item->name }}</td>
                        <td>{{ $Item->comment }}</td>

                        <td>
                            <div class="dropdown">
                                <button class="btn btn-warning dropdown-toggle align-text-top" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    الخيارات
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <a class="fw-bold dropdown-item" href="{{ route('admin.almustawayat.parts', $Item->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link-minus" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M9 15l6 -6" />
                                            <path d="M11 6l.463 -.536a5 5 0 1 1 7.071 7.072l-.534 .464" />
                                            <path d="M12.603 18.534a5.07 5.07 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
                                            <path d="M16 19h6" />
                                          </svg>
                                        الاجزاء المضافة
                                    </a>
                                    @can('تعديل مستوي')
                                        <a class="fw-bold text-success dropdown-item" href="{{route("admin.almustawayat.edit",$Item->id)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="#7bc62d" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                            تعديل
                                        </a>
                                    @endcan
                                    @can('حذف مستوي')
                                        <form class="dropdown-item d-inline" id="deletealmustawaya"
                                            action="{{ route('admin.almustawayat.destroy', $Item->id) }}"
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
                        {{-- <td>
                        @can('قائمة الاجزاء المضافة')
                        <a href="{{ route('admin.almustawayat.parts', $Item->id) }}" class="btn btn-dark btn-sm"></a>
                        @endcan
                   
                        <form class="d-inline" action="{{ route('admin.almustawayat.destroy', $Item->id) }}"
                            onsubmit="return confirm('سوف تقوم بحذف العنصر')" method="POST">
                            @csrf
                            @method('DELETE')
                            @can('تعديل مستوي')
                            <a href="#" class="btn btn-indigo btn-sm update-btn"
                            data-id="{{ $Item->id }}">تعديل</a>
                            @endcan
                            @can('حذف مستوي')
                            <button class="btn btn-pink btn-sm">حذف</button>
                            @endcan
                        </form>

                    </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('js')
    <script>
        $(".openModal ").click(function() {
            $("#almustawayatSubmit").html('ادخال المستوي');
            $(".modal-title").html('ادخال المستوي');
            $('#comment').html('');
            $("#insert")[0].reset();

        });
        // Update 

        $(document).on('click', '.update-btn', function() {
            $("#almustawayatSubmit").html('تعديل المستوي');
            $(".modal-title").html('تعديل المستوي');

            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.almustawayat.show', '') }}" + '/' + id,
                type: 'GET',
                success: function(data) {
                    $("#uploadId").val(data.id);
                    $('#name').val(data.name);
                    $('#comment').html(data.comment);
                    $('#modal-add').modal('show');
                }
            });
        });


        // Dtatables 
        $('#almustawayas').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json"
            }
        });


        $('#insert').on('submit', function(e) {

            e.preventDefault();
            let formData = new FormData(this);

            let id = $('#uploadId').val();
            let url = id ? `{{ route('admin.almustawayat.update.post', '') }}` + '/' + id :
                "{{ route('admin.almustawayat.store') }}";
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
                            window.location.href = '{{ route('admin.almustawayat.index') }}';
                        }, 1000);
                    }


                },
                error: function(response) {
                    console.log(response);
                    let errors = response.responseJSON.errors;
                    $('.nameError').text(errors.name ? errors.name : '');

                }
            });
        });
    </script>
@endpush
