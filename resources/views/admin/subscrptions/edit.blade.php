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
                        تعديل اشتراك الطالب : {{$Subscrption->subscrption->name}}
                    </h2>
                    <span class="badge bg-success">التاريخ : {{$Subscrption->reg_start}}</span>
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
@if (Session::has('error'))
    <div class="alert alert-danger">{{Session::get('error')}}</div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
@endif

<form action="{{route("admin.subscrption.update",$Subscrption->id)}}" method="POST">
    @csrf
        <div class="row">
            <div class="col">
                <input type="hidden" name="talib_id" value="{{$Subscrption->subscrption->id}}">
                <div class="label">تاريخ البدء</div>
                <input type="date" value="{{$Subscrption->reg_start}}" required  name="reg_start" class="form-control">
                @error('reg_start')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <div class="label">تاريخ الانتهاء</div>
                <input type="date" value="{{$Subscrption->reg_end}}" required   name="reg_end" class="form-control">
                @error('reg_end')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row my-4">
            <div class="col">
                <div class="label">القيمة المطلوبة</div>
                <input type="text"  value="{{$Subscrption->required_value}}"  required   name="required_value" class="form-control">

            </div>
          
        </div>

        <div class="row">
        <h3>بيانات المدفوعات</h3>
       
        @foreach ($Subscrption->payments() as $payment)
        <div class="col">
            <h3>مدفوعات : {{$payment->created_at}}</h3>
            <input type="text" class="form-control" name="payment[{{$payment->id}}]" value="{{$payment->paid_value}}">
    
        </div>
        @endforeach
    </div>
        <div class="form-group my-3">
            <button type="submit" class="btn btn-teal">تعديل </button>
        </div>


</form>
  
@endsection

