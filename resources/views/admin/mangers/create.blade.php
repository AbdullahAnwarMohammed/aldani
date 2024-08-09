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
                        اضافة مستخدم جديد
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.manger.index') }}" class=" btn btn-dark d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 14l-4 -4l4 -4" />
                                <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                              </svg>
                            للخلف
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <form id="insert" action="{{ route('admin.manger.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-4">
            <label for="">الاسم</label>
            <input type="text" required value="{{old('name')}}"  name="name" id="name" class="form-control">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label for="">البريد</label >
            <input type="text" required  value="{{old('email')}}"  name="email" id="email" class="form-control">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label for="">كلمة المرور</label>
            <input type="text" required   value="{{old('password')}}"  name="password" id="password" class="form-control">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label for="">الهاتف</label>
            <input type="number" value="{{old('phone')}}"  name="phone" id="phone" class="form-control">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label for="">اطلاع على بيانات</label>
            <select required name="male_or_female[]" class="form-control" multiple>
                <option value="1">ذكور</option>
                <option value="0">اناث</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <label for="">الجنس</label>
            <select name="gender" id="gender" class="form-control">
                <option id="male" value="1">ذكر</option>
                <option id="female" value="0">انثي</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="">الصلاحيات</label>
            <select name="roles[]" class="form-control" multiple>
                {{-- <option value="" disabled>Select Role</option> --}}
                @foreach ($roles as $role)
                    <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
            </select>
            @error('roles')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" id="submit" class="btn btn-teal">اضافة</button>
    </form>
@endsection
