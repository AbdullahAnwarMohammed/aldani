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
                        الصفحات
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        <a href="{{ route('admin.pages.index') }}" class=" btn btn-dark d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            الصفحات
                        </a>
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-dark d-sm-none btn-icon">
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
@endsection
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    <form action="{{route('admin.pages.update',$Page->id)}}" method="POST">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label for="">اسم الصفحة</label>
            <input type="text" value="{{$Page->name}}" name="name" class="form-control">
            @error('name')
            <div class="text-danger">{{$message}}</div>
        @enderror
        </div>
        <div class="form-group">
            <label for="">الايقون</label>
            <input type="text" required name="icon" value="{{$Page->icon}}" class="form-control">
            <span><a target="_blank" href="https://fontawesome.com/icons">مكتبة الايقونات</a></span>
            @error('icon')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">مكان الظهور</label>
            <select name="location" required class="form-control">
                <option value="1" @selected($Page->location == 1)>Header</option>
                <option value="2" @selected($Page->location == 2)>Container</option>
            </select>
            @error('location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">المحتوي</label>
            <textarea name="content"  class="form-control" cols="30" rows="10">{{$Page->content}}</textarea>
            @error('content')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group my-2">
            <div class="form-label">حالة الصفحة</div>
            <label class="form-check form-switch">
                <input class="form-check-input" name="subscrption" id="checkbox" @checked($Page->status == 1) type="checkbox">
                <span class="form-check-label">تعمل</span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-teal" value="حفظ">
        </div>

      
    </form>
@endsection

@push('js')
    <script src="/dashboard/dist/libs/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant")),
        });

        $("#checkbox").on("change", function() {
            if (this.checked) {
                $(this).next().html("تعمل")


            } else {
                $(this).next().html("لا تعمل")


            }


        })
    </script>
@endpush
