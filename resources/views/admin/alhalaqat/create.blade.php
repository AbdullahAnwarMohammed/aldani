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
                        اضافة حلقة 
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        <a href="{{ route('admin.alhalaqat.index') }}" class=" btn btn-dark d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 14l-4 -4l4 -4" />
                                <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                              </svg>
                            الحلقات
                        </a>
                        <a href="{{ route('admin.alhalaqat.index') }}" class="btn btn-dark d-sm-none btn-icon">
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
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <div class="row">
        <div class="col">
            <form action="{{ route('admin.alhalaqat.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">اسم الحلقة</label>
                    <input type="text" name="name" class="form-control">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-4">
                    <label for="">وصف الحلقة</label>
                    <input type="text" name="descrption" class="form-control">
                </div>
                <div class="form-group my-4">
                    <label for="">نوع الحلقة</label>
                    <select name="type" id="type" required class="form-control">
                        <option value="" selected disabled>اختر</option>
                        <option value="1">ذكور</option>
                        <option value="0">اناث</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">رابط الحلقة</label>
                        <input type="url" class="form-control" name="room_url">
                        @error('room_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">المحفظ</label>
                        <select name="user_id" id="user_id" required class="form-control">
                            {{-- @foreach ($Users as $Item)
                                <option value="{{ $Item->id }}">{{ $Item->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>

                <div class="form-group my-2">
                    <input type="submit" class="btn btn-teal" value="اضافة">
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#type').on('change', function() {
            var type = $(this).val();
           
            if (type) {
                $.ajax({
                    url: "{{route('admin.alhalaqat.type','')}}"+'/'+type,
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        $('#user_id').empty();
                        $.each(data, function(key, value) {
                            $('#user_id').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#user_id').empty();
            }
        });
    </script>
@endpush
