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
                    تعديل حلقة : {{$Alhalaqat->name}}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
           

                    <a href="{{route('admin.alhalaqat.index')}}" class=" btn btn-dark d-none d-sm-inline-block" 
                      >
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        الحلقات
                    </a>
                    <a href="{{route('admin.alhalaqat.index')}}"  class="btn btn-dark d-sm-none btn-icon" >
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
<div class="row">
    <div class="col">
        <form action="{{route("admin.alhalaqat.update",$Alhalaqat->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">اسم الحلقة</label>
                <input type="text" name="name" value="{{$Alhalaqat->name}}" class="form-control">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group my-4">
                <label for="">تلمحية الحلقة</label>
                <input type="text"  value="{{$Alhalaqat->descrption}}"  name="descrption" class="form-control">
            </div>
            <div class="row">
                <div class="col">
                    {{-- <label for="">التقسيم</label>
                    <select name="subdivision_id" class="form-control">
                        @foreach($Subdivision as $Item)
                        <option value="{{$Item->id}}">{{$Item->name}}</option>
                        @endforeach
                       
                    </select>
                </div> --}}
                <div class="col">
                    <label for="">المحفظ</label>
                    <select name="user_id" class="form-control">
                        @foreach ($Users as $Item)
                        <option value="{{$Item->id}}" @selected($Alhalaqat->user_id == $Item->id)>{{$Item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group my-2">
                <input type="submit" class="btn btn-teal" value="تعديل">
            </div>
        </form>
    </div>
</div>
@endsection