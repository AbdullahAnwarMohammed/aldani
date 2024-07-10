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
                    اضافة اشتراك جديد للطالب : {{$Talib->name}}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">


                    <a href="{{ route('admin.subscrption.index') }}" class=" btn btn-dark d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        الاشتراكات
                    </a>
                    <a href="{{ route('admin.subscrption.index') }}" class="btn btn-dark d-sm-none btn-icon">
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
@if (Session::has("success"))
    
<div class="alert alert-important alert-success alert-dismissible" role="alert">
    <div class="d-flex">
      <div>
        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
      </div>
      <div>
        {{Session::get('success')}}
      </div>
    </div>
    
  </div>

  @endif
  

  @if (Session::has("error"))
    
<div class="alert alert-important alert-danger alert-dismissible" role="alert">
    <div class="d-flex">
      <div>
        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
      </div>
      <div>
        {{Session::get('error')}}
      </div>
    </div>
    
  </div>

  @endif
  
<form action="{{route("admin.subscrption.new.store")}}" method="POST">
    @csrf
        <div class="row">
            <div class="col">
                <div class="label">تاريخ البدء</div>
                <input type="hidden" name="talib_id" value="{{$Talib->id}}">
                <input type="date" value="{{old('reg_start')}}"  name="reg_start" class="form-control">
                @error('reg_start')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <div class="label">تاريخ الانتهاء</div>
                <input type="date" value="{{old('reg_end')}}"  name="reg_end" class="form-control">
                @error('reg_end')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row my-4">
            <div class="col">
                <div class="label">القيمة المطلوبة</div>
                <input type="text"  value="{{old('required_value')}}"   name="required_value" class="form-control">
                @error('required_value')
                <div class="text-danger">{{$message}}</div>
            @enderror
            </div>
            <div class="col">
                <div class="label">القيمة المدفوعة</div>
                <input type="text"  value="{{old('paid_value')}}" name="paid_value" class="form-control">
                @error('paid_value')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-teal">اشتراك</button>
        </div>


</form>
@endsection