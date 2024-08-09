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
                        <a href="{{ route('admin.manger.index') }}" class=" btn btn-primary d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-plus"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 9h8" />
                                <path d="M8 13h6" />
                                <path
                                    d="M12.01 18.594l-4.01 2.406v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v5.5" />
                                <path d="M16 19h6" />
                                <path d="M19 16v6" />
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
    @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif

    <form method="POST" action="{{ route('admin.manger.update',$admin->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <input type="hidden" name="passwordHidden" value="{{$admin->showPassword}}">
                <label for="">الاسم</label>
                <input type="text" value="{{ $admin->name }}" name="name" id="name" class="form-control">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="">البريد</label>
                <input type="text" value="{{ $admin->email }}" name="email" id="email" class="form-control">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="row">
            <div class="col">
                <label for="">كلمة المرور</label>
                <input type="text" name="password" id="password" class="form-control">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="">الهاتف</label>
                <input type="number" value="{{ $admin->phone }}" name="phone" id="phone" class="form-control">
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="">اطلاع على بيانات</label>
            <select required name="male_or_female[]" class="form-control" multiple>
            
                <option value="1" @selected(in_array(1,$admin->male_or_female))>ذكور</option>
                <option value="0" @selected(in_array(0,$admin->male_or_female))>اناث</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label for="">الجنس</label>
            <select name="gender" id="gender" class="form-control">
                <option id="male" value="1" @selected($admin->gender == 1)>ذكر</option>
                <option id="female" value="0" @selected($admin->gender == 0)>انثي</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="">الصلاحيات</label>
            <select name="roles[]" class="form-control" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                        {{ $role }}
                    </option>
                @endforeach
            </select>
            @error('roles')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" id="submit" class="btn btn-teal">تعديل</button>
    </form>
@endsection
