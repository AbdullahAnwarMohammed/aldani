@extends('admin.layouts.app')
@section('header')
@php
$Explode = explode("/",url()->full());
$idAlmustawaya =  end($Explode);
$idPart = $Explode[5];
$Almustawaya  = \App\Models\Almustawayat::where('id',$idAlmustawaya)->first();
$Part = \App\Models\Part::where('id',$idPart)->first();
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
                    التابعه للمستوي  <span class="badge bg-info">{{$Almustawaya->name}}</span>
                    والجزء  <span class="badge bg-danger part_value">{{$Part->title}}</span>
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
           
                    <a href="{{route("admin.almustawayat.index")}}" class="btn btn-dark">المستويات</a>
                    <a href="{{route("admin.almustawayat.parts",$idAlmustawaya)}}" class="btn btn-dark">الاجزاء</a>

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
                <form id="insert" enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" id="uploadId" name="uploadId">
                    <input type="hidden" id="idAlmustawaya" value="{{$idAlmustawaya}}" name="idAlmustawaya">
                    <input type="hidden" id="idPart" value="{{$idPart}}" name="idPart">
                  <div id="inputs">
                    <div class="input-group mb-3">
                            <input type="text" placeholder="المنهج"  name="title[]" id="title" class="form-control">
                            <div class="text-danger titleError"></div>
                           <input type="text" placeholder="الملاحظات" id="comment" class="form-control" name="comment[]">
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
<table id="Almanhaj" class="table table-danger table-striped" style="width:100%">
    <thead>
        <tr>
            <th>المستوي</th>
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
                    <form class="d-inline" action="{{ route('admin.almustawayat.destory.almanhaj', $Item->id) }}"
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
        inputTextarea.rows = 2;
        inputTextarea.placeholder = 'الملاحظات';

        inputGroup.appendChild(inputText);
        inputGroup.appendChild(inputTextarea);
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
let url = id ? `{{ route('admin.almustawayat.update.almanhaj','') }}`+'/'+ id : "{{ route('admin.almustawayat.add.almanhaj') }}";
let type = id ? 'POST' : 'POST';

$.ajax({
    type: type,
    url: url,
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
        console.log(response);
       if(response.status == 201)
        {
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