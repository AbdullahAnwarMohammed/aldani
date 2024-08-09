@extends('parent.layouts.app')
@section('content')
@php
$url = url()->current();

// Parse the URL to get the path
$parsed_url = parse_url($url, PHP_URL_PATH);

// Explode the path by '/' to get the parts
$path_parts = explode('/', $parsed_url);

// The value you want is the last part of the path
$cid = end($path_parts);
@endphp
    <div class="appOne" style="background: #fff;">
        <div class="guarantor">
            <div class="title" style="color:#fff;background:#555;display:flex; justify-content:center;align-items:center">
                <h5> <span style="color:#75f98c;"> <i class="ri-shield-user-fill"></i>مرحبا </span>
                    {{ $Talib->name }}</h5>
            </div>
            <p> هذه الصفحة تمكنكم من متابعة <span class="fw-bold">الحلقات</span>ولكم كل الشكر والتقدير على دعمكم لنا
                🌹 </p>
        </div>

        <div id="showInfo" class="info bg-success text-white p-2 d-flex justify-content-between rounded-1"
            style="width:70%;margin:10px auto">
            <span>العام الدراسي : {{ $Setting->year }} || {{ $Setting->year + 1 }}</span>
            <span>الترم : {{ $Setting->session->name }}</span>
        </div>
 
        <div class="information">
            <div class="container">
                <div class="row mt-3 py-2" style="background: #fee3c4">
                    <div class="col-md-2 col-4 text-center" style="border: 1px solid #dfc3a2;border-bottom:5px solid #6c3a0f"">
                        <h6 class="heading">
                           <span > الرقم المدني</span>
                           <i class="fw-bold d-block my-1"> {{ $Talib->cid }}</i>
                        </h6>
                    </div>
                    <div class="col-md-2 col-4 text-center" style="border: 1px solid #dfc3a2;border-bottom:5px solid #6c3a0f"">
                        <h6 class="heading">
                            <span>الهاتف</span>
                            <i class="fw-bold d-block my-1"> {{ $Talib->phone }}</i>
                        </h6>
                    </div>
                    <div class="col-md-2 col-4 text-center" style="border: 1px solid #dfc3a2;border-bottom:5px solid #6c3a0f"">
                        <h6 class="heading">
                            <span>الدفعة</span>
                            <i class="fw-bold d-block my-1">{{ $Talib->aldafeuh->name }}</i>
                        </h6>
                    </div>
                    <div class="col-md-2 col-4 text-center" style="border: 1px solid #dfc3a2;border-bottom:5px solid #6c3a0f"">
                        <h6 class="heading">
                            <span>المستوى</span>
                            <i class="fw-bold d-block my-1"> {{ $Talib->almustawayat->name }}</i>
                        </h6>
                    </div>
                    <div class="col-md-2 col-4 text-center" style="border: 1px solid #dfc3a2;border-bottom:5px solid #6c3a0f"">
                        <h6 class="heading">
                            <span>الحلقة</span>
                            <i class="fw-bold d-block my-1">     {{ $Talib->alhalaqat->name }}</i>
                        </h6>
                    </div>
                    <div class="col-md-2 col-4 text-center" style="border: 1px solid #dfc3a2;border-bottom:5px solid #6c3a0f">
                        <h6 class="heading">
                            <span>المحفظ</span>
                            <i class="fw-bold d-block my-1">  {{ $Talib->alhalaqat->user->name }}</i>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('home.parent.home', $cid) }}" class="d-flex justify-content-center" method="GET">
            <div class="col-md-6">
                <div class="input-group">
                    @php
                        $date = Request::query('date') ? Request::query('date') :  date('Y-m-d');
                    @endphp
                    <input type="date" name="date"
                    value="{{$date}}"
                        style="background:#fd7e14;color:#2e1805;font-weight:bold;width:50%;margin:auto" class="form-control"
                        id="date" value="{{ date('Y-m-d') }}">
                    <input type="submit" class="btn btn-dark btn-sm" value="بحث">
                    @if (isset($Tasmie))
                    <a class="btn btn-danger btn-sm" href="{{ route('home.parent.home', $cid)}}" >الكل</a>
                    @endif
                </div>
            </div>
        </form>



      
        <table class="table table-primary text-center table-bordered" style="margin: 0">
            <thead>
                <tr>
                    <th>التاريخ</th>
                    <th>الحضور</th>
                    <th>الجزء</th>
                    <th>المنهج</th>
                    <th>الدرجة</th>
                    <th>الملاحظات</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($Tasmie))
                <tr>
                    <td>{{ $date }}</td>
                    <td>
                        @if ($Tasmie->attend == 1)
                            <span class="btn btn-success btn-sm">حاضر</span>
                        @endif
                        @if ($Tasmie->attend == 3)
                            <span class="btn btn-primary btn-sm">حاضرا ون لاين</span>
                        @endif
                        @if ($Tasmie->attend == 0)
                            <span class="btn btn-danger btn-sm">غائب</span>
                        @endif
                        @if ($Tasmie->attend == 2)
                            <span class="btn btn-warning btn-sm">غائب بعذر</span>
                        @endif
                    </td>

                    </td>
                    <td>{{ $Tasmie->part->title }}</td>
                    <td>{{ $Tasmie->almanhaj->title }}</td>
                    <td>{{ $Tasmie->degree }}</td>
                    <td>{{ $Tasmie->comment }}</td>
                </tr>
                @elseif ($Tasmies)
                @foreach($Tasmies as $item)
                    <tr>
                        <td>{{ $date }}</td>
                        <td>
                            @if ($item->attend == 1)
                                <span class="btn btn-success btn-sm">حاضر</span>
                            @endif
                            @if ($item->attend == 3)
                                <span class="btn btn-primary btn-sm">حاضرا ون لاين</span>
                            @endif
                            @if ($item->attend == 0)
                                <span class="btn btn-danger btn-sm">غائب</span>
                            @endif
                            @if ($item->attend == 2)
                                <span class="btn btn-warning btn-sm">غائب بعذر</span>
                            @endif
                        </td>

                        </td>
                        <td>{{ $item->part->title }}</td>
                        <td>{{ $item->almanhaj->title }}</td>
                        <td>{{ $item->degree }}</td>
                        <td>{{ $item->comment }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">لا يوجد بيانات</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
@endsection
