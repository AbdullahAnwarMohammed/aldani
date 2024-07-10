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
                        الاجزاء التابعه || {{ $Almustawaya->name }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        <a href="{{ route('admin.almustawayat.index') }}" class="btn btn-dark">المستويات</a>
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
                            اضافة جزء جديد
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
                    <h5 class="modal-title">انشاء جزء</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="error-messages"></div>
                    <form id="insert" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="uploadId" name="uploadId">
                        <input type="hidden" id="idAlmustawaya" value="{{ $Almustawaya->id }}" name="idAlmustawaya">
                        <div id="inputs">
                            <div class="input-group mb-3">
                                <input type="text" placeholder="الجزء" name="title[]" id="title"
                                    class="form-control">
                                <div class="text-danger titleError"></div>
                                <input type="text" placeholder="الملاحظات" id="comment" class="form-control"
                                    name="comment[]">
                            </div>
                        </div>


                        <button type="submit" id="AlmustawayaSubmit" class="btn btn-primary">ادخال جزء</button>
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
    @if (Session::has("delete"))
    
    <div class="alert alert-important alert-warning alert-dismissible" role="alert">
        <div class="d-flex">
          <div>
            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
          </div>
          <div>
            {{Session::get('delete')}}
          </div>
        </div>
        
      </div>

    @endif
      <table id="parts" class="table table-warning table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>الاجزاء</th>
                <th>الملاحظات</th>
                <th>المنهج</th>
                <th>الاجراءت</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach ($Parts as $Item)
                <tr>
                    <td>{{ $Item->title }}</td>
                    <td>{{ $Item->comment }}</td>
                    <td><a href="{{ route('admin.almustawayat.almanhaj', [$Item->id, $Almustawaya->id]) }}"
                            class="btn btn-info btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-books"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                                <path d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                                <path d="M5 8h4" />
                                <path d="M9 16h4" />
                                <path
                                    d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z" />
                                <path d="M14 9l4 -1" />
                                <path d="M16 16l3.923 -.98" />
                            </svg>
                            المنهج</a></td>
                    <td>
                        <form class="d-inline" action="{{ route('admin.almustawayat.destory.part', $Item->id) }}"
                            onsubmit="return confirm('سوف تقوم بحذف العنصر')" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="#" class="btn btn-indigo btn-sm update-btn"
                                data-id="{{ $Item->id }}">تعديل</a>
                            <button class="btn btn-pink btn-sm">حذف</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@push('js')
    <script>
        // 7:5 - 7:25 !! 7:30 - 7:50 
        // 10:35   : 11:45
        // 4:00  : 4:30
        // 6 : 25  - 7:00
        // 7:10 - 7:50
        // 8:30 : 10:20
        // 10:25 : 12:15
        // 1:30 - 1:50
        // Add New Input 


        $(".openModal ").click(function() {
            $("#AlmustawayaSubmit").html('ادخال جزء');
            $(".modal-title").html('ادخال الجزء');
            $("#add-input").attr('disabled', false);
            $("#insert")[0].reset();
        });
        // Update 

        $(document).on('click', '.update-btn', function() {
            $("#add-input").attr('disabled', 'disabled');
            $("#AlmustawayaSubmit").html('تعديل الجزء');
            $(".modal-title").html('تعديل الجزء');

            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.almustawayat.show.part', '') }}" + '/' + id,
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
            inputText.placeholder = 'الجزء';
            inputText.required = true;

            var inputTextarea = document.createElement('input');
            inputTextarea.className = 'form-control';
            inputTextarea.name = 'comment[]';
            inputTextarea.rows = 2;
            inputTextarea.placeholder = 'الملاحظات';

            inputGroup.appendChild(inputText);
            inputGroup.appendChild(inputTextarea);
            form.appendChild(inputGroup);
        });

        // Dtatables 
        $('#parts').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json"
            }
        });


        $('#insert').on('submit', function(e) {

            e.preventDefault();
            let formData = new FormData(this);
            var id = $('#uploadId').val();
            var idAlmustawaya = $("#idAlmustawaya").val();
            let url = id ? `{{ route('admin.almustawayat.update.part', '') }}` + '/' + id :
                "{{ route('admin.almustawayat.add.part') }}";
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
                                '{{ route('admin.almustawayat.parts', '') }}' + '/' +
                                idAlmustawaya;
                        }, 1000);
                    }


                },
                error: function(response) {
                    console.log(response);
                    // console.log(response);
                    // let errors = response.responseJSON.errors;
                    // $('.titleError').text(errors.title ? errors.title : '');
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
