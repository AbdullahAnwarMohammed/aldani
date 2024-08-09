@extends('admin.layouts.app')
@section('header')
    @php
        $Explode = explode('/', url()->full());
        $idAlmustawaya = end($Explode);
        $idPart = $Explode[5];
        $Almustawaya = \App\Models\Almustawayat::where('id', $idAlmustawaya)->first();
        $Part = \App\Models\Part::where('id', $idPart)->first();
    @endphp


    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        وحدة التحكم
                    </div>
                    <h2 class="page-title">
                        {المناهج}
                        التابعه للمستوي <span class="badge bg-info">{{ $Almustawaya->name }}</span>
                        والجزء <span class="badge bg-danger part_value">{{ $Part->title }}</span>
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        @can('عرض المستويات')
                            <a href="{{ route('admin.almustawayat.index') }}" class="btn btn-dark">المستويات</a>
                        @endcan
                        @can('عرض الاجزاء المضافة')
                            <a href="{{ route('admin.almustawayat.parts', $idAlmustawaya) }}" class="btn btn-dark">الاجزاء</a>
                        @endcan
                        @can('اضافة مهنج')
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
                                اضافة منهج جديد
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
                    <h5 class="modal-title">انشاء منهج جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="error-messages"></div>
                    <form id="insert" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="uploadId" name="uploadId">
                        <input type="hidden" id="idAlmustawaya" value="{{ $idAlmustawaya }}" name="idAlmustawaya">
                        <input type="hidden" id="idPart" value="{{ $idPart }}" name="idPart">
                        <div id="inputs">
                            <div class="input-group mb-3">
                                <input type="text" placeholder="المنهج" name="title[]" id="title"
                                    class="form-control">
                                <div class="text-danger titleError"></div>
                                <input type="text" placeholder="الملاحظات" id="comment" class="form-control"
                                    name="comment[]">
                            </div>
                        </div>


                        <button type="submit" id="addButton" class="btn btn-primary">ادخال جزء</button>
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">اغلاق</button>
                        <button type="button" id="add-input" class="btn btn-teal">اضافة زر</button>

                    </form>

                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    @if (Session::has('delete'))
        <div class="alert alert-important alert-warning alert-dismissible" role="alert">
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
    <div class="table-responsive">

        <table id="Almanhaj" class="table table-danger table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>المنهج</th>
                    <th>الملاحظة</th>
                    <th>الخيارات</th>
                </tr>
            </thead>

            <tbody id="tbody">
                @foreach ($Almanhaj as $Item)
                    <tr>
                        <td>{{ $Item->title }}</td>
                        <td>{{ $Item->comment }}</td>

                        <td>

                            <div class="dropdown">
                                <button class="btn btn-warning dropdown-toggle align-text-top" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    الخيارات
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="">

                                    @can('تعديل المنهج')
                                        <a class="fw-bold text-success dropdown-item"
                                            href="{{ route('admin.almustawayat.almanhaj.edit', $Item->id) }}">
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
                                    @can('حذف المنهج')
                                        <form class="dropdown-item d-inline" id="deletealmustawaya"
                                            action="{{ route('admin.almustawayat.destory.almanhaj', $Item->id) }}"
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
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('js')
    <script>
        $(".openModal ").click(function() {
            $("#addButton").html('ادخال المنهج');
            $(".modal-title").html('ادخال منهج ||  الجزء ' + $(".part_value").html());
            $("#add-input").attr('disabled', false);
            $("#uploadId").val('');
            $("#insert")[0].reset();
        });
        // Update 

        $(document).on('click', '.update-btn', function() {
            $("#add-input").attr('disabled', 'disabled');
            $("#addButton").html('تعديل المنهج');
            $(".modal-title").html('تعديل المنهج');

            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.almustawayat.show.almanhaj', '') }}" + '/' + id,
                type: 'POST',
                success: function(data) {
                    console.log(data);
                    $("#uploadId").val(data.id);
                    $('#title').val(data.title);
                    $('#comment').val(data.comment);
                    $('#modal-add').modal('show');
                }
            });
        });


        document.getElementById('add-input').addEventListener('click', function() {
            var form = document.getElementById('inputs');
            var inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-3';

            var inputText = document.createElement('input');
            inputText.type = 'text';
            inputText.className = 'form-control';
            inputText.name = 'title[]';
            inputText.placeholder = 'المنهج';
            inputText.required = true;

            var inputTextarea = document.createElement('input');
            inputTextarea.className = 'form-control';
            inputTextarea.name = 'comment[]';
            inputTextarea.placeholder = 'الملاحظات';

            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn btn-danger';
            removeButton.innerText = 'إزالة';
            removeButton.addEventListener('click', function() {
                inputGroup.remove();
            });

            inputGroup.appendChild(inputText);
            inputGroup.appendChild(inputTextarea);
            inputGroup.appendChild(removeButton);
            form.appendChild(inputGroup);
        });


        // Dtatables 
        $('#Almanhaj').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json"
            }
        });


        $('#insert').on('submit', function(e) {

            e.preventDefault();
            let formData = new FormData(this);
            let id = $('#uploadId').val();
            //admin.almustawayat.update.almanhaj
            let url = id ? `{{ route('admin.almustawayat.update.almanhaj', '') }}` + '/' + id :
                "{{ route('admin.almustawayat.add.almanhaj') }}";
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
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "تم الاضافة بنجاح",
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $(".btn-close").click();
                        $("#insert")[0].reset();

                        setInterval(() => {
                            location.reload();
                        }, 1000);
                    }


                },
                error: function(response) {
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
