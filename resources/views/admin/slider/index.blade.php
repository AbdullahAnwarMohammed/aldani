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
                        معرض الصور <span class="badge bg-dark">{{ $AllSlider }}</span>
                    </h2>
                </div>
                <!-- Page title actions -->

            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3"
            style="background:#fff;justify-content: center;
    display: flex;
    flex-direction: column;
    border-radius:10px
    "
            class="align-item-center">
            <h3>رفع الصور {jpeg,.jpg,.png}</h3>
            @error('file')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @if (Session::has('success'))
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
                            {{ Session::get('success') }}
                        </div>
                    </div>

                </div>
            @endif
            <form action="{{ route('admin.slider.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="file-upload" class="custom-file-upload">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud-upload" width="44"
                        height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                        <path d="M9 15l3 -3l3 3" />
                        <path d="M12 12l0 9" />
                    </svg> اختر الصور
                </label>
                <input id="file-upload" accept="image/*" type="file" name="file[]" multiple />

                <button type="submit" class="btn btn-outline-info">رفع الصور</button>
            </form>

        </div>
        <div class="col-md-9">
            @if (Session::has('delete'))
                <div class="alert alert-warning">{{ Session::get('delete') }}</div>
            @endif
            <div class="row" id="sortable">
                @forelse ($Sliders as $Item)
                    <div class="col-md-6">
                        <div class="card card-sm">
                            <span style="position: absolute;left:0"
                                class="bg-info rounded-2 p-3 text-white">{{ ($Sliders->currentPage() - 1) * $Sliders->perPage() + $loop->iteration }}</span>
                            <a href="#" class="d-block image-container ui-state-default"
                                data-id="{{ $Item->id }}">
                                <img src="/uploads/slider/resize/{{ $Item->photo }}" class="card-img-top">
                            </a>
                            <form action="{{ route('admin.slider.destory', $Item->id) }}" style="position: absolute"
                                onsubmit="return confirm('سوف تقوم بحذف الصورة')" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                    حذف الصورة</button>
                                <a href="#" data-src="/uploads/slider/resize/{{ $Item->photo }}"
                                    data-id="{{ $Item->id }}" data-name="{{ $Item->photo }}"
                                    class="btn btn-teal btn-edit-image" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">تعديل</a>
                            </form>

                        </div>
                    </div>
                @empty
                    <div class="text-danger text-center alert">* لا يوجد صور</div>
                @endforelse
                {{ $Sliders->links('vendor.pagination.bootstrap-4') }}

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-update-image" enctype="multipart/form-data">
                        <input type="hidden" name="old_image" id="old_image_hidden">
                        <input type="hidden" name="id" id="id">
                        <input type="file" name="image" required id="imageInput" class="form-control">
                        <div class="row my-2">
                            <div class="col-md-6 old_image">
                                <label for="">قبل</label>
                                <img class="img-thumbnail" src="" alt="">
                            </div>
                            <div class="col-md-6 new_image">
                                <label for="">بعد</label>
                                <img src="" class="img-thumbnail" alt="" id="previewImg">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-teal" value="حفظ">
                        <a class="btn btn-pink" data-bs-dismiss="modal">اغلاق</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script>
        $("#sortable").sortable({
            update: function(event, ui) {
                var positions = [];
                $('#sortable .ui-state-default').each(function(index) {
                    positions.push($(this).data('id'));
                });

                $.ajax({
                    url: '{{ route('admin.slider.reorder') }}',
                    method: 'POST',
                    data: {
                        positions: positions
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
        });
        $(".btn-edit-image").on("click", function() {
            let src = $(this).data("src");
            let imageName = $(this).data("name");
            let id = $(this).data("id");
            $(".old_image img").attr("src", src);
            $("#old_image_hidden").val(imageName);
            $("#id").val(id);

        })

        $('#imageInput').on('change', function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImg').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        $("#form-update-image").on("submit", function(event) {
            event.preventDefault();

            var formData = new FormData(this);


            $.ajax({
                url: '{{ route('admin.slide.update') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response == 'success') {
                      location.reload();
                    }
                }
            })
        })
    </script>
@endpush


@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

    <style>
        /* Style for the file upload container */
        .custom-file-upload {
            display: block;
            margin: 10px 0;
            cursor: pointer;
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #ffffff;
            border: 2px solid #3498db;
            background-color: #3498db;
            padding: 8px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        .custom-file-upload:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        /* Styling for the file input itself (hidden) */
        #file-upload {
            display: none;
        }
    </style>
@endpush
