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
                        {{ $Subscrption->subscrption->name }}
                        <br />
                        فاتورة تاريخ  || {{$Subscrption->reg_start}}

                    </h2>
                    <span class="badge bg-danger">
                        القيمة المطلوب : {{ $Subscrption->required_value }}
                    </span>
                    <span class="badge bg-success">
                        المدفوعة : {{ $Subscrption->total_payments() }}
                    </span>
                    <span class="badge bg-info">
                        المتبقي : {{ $Subscrption->Residual() }}
                    </span>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                        <a href="{{ route('admin.subscrption.single', $Subscrption->subscrption->id) }}"
                            class=" btn btn-dark d-none d-sm-inline-block ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 14l-4 -4l4 -4" />
                                <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                            </svg>
                            للخلف
                        </a>
                        <a href="{{route('admin.subscrption.invoice',$Subscrption->subscrption->id)}}" class="btn btn-info">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                            </svg>
                            طباعة


                        </a>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>تاريخ الدفع</th>
            <th>القيمة</th>
        </tr>

        @php
            $i = 1;
        @endphp
        @foreach ($payments as $payment)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $payment->created_at }}</td>
                <td>{{ $payment->paid_value }}</td>
            </tr>
        @endforeach()
    </table>
    {{-- <form action="#" method="POST">
        @csrf
        <input type="hidden" name="required_value" value="{{$Subscrption->required_value}}">
        @foreach ($payments as $payment)
        <h3>مدفوعات : {{$payment->created_at}}</h3>
        <input type="text" class="form-control" name="payment[{{$payment->id}}]" value="{{$payment->paid_value}}">
        @endforeach
       <div class="form-group my-2">
        <input type="submit" class="btn btn-teal" value="حفظ">
       </div>
    </form> --}}
@endsection
