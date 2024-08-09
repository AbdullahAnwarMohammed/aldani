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
            <p> هذه الصفحة تمكنكم من متابعة <span class="fw-bold">الحلقات</span> <br /> ولكم كل الشكر والتقدير على دعمكم لنا
                🌹 </p>
            <p> </p>
        </div>

        <div class="info bg-success text-white p-2 d-flex justify-content-between rounded-1"
            style="width:70%;margin:10px auto">
            <span>العام الدراسي : {{ $Setting->year }} || {{ $Setting->year + 1 }}</span>
            <span>الترم : {{ $Setting->session->name }}</span>
        </div>

        <div class="information">
            <div class="container">
                <div class="row mt-3  py-2" style="background: #fee3c4">
                    <div class="col-md-2 col-4 text-center" style="border: 1px solid #dfc3a2;border-bottom:5px solid #6c3a0f"">
                        <h6>الرقم المدني
                            <br />
                            {{ $Talib->cid }}
                        </h6>
                    </div>
                    <div class="col-md-2 col-4  text-center" style="border: 1px solid #dfc3a2;border-bottom:5px solid #6c3a0f"">
                        <h6>الهاتف
                            <br />
                            {{ $Talib->phone }}
                        </h6>
                    </div>
                    <div class="col-md-2  col-4 text-center" style="border: 1px solid #dfc3a2;border-bottom:5px solid #6c3a0f"">
                        <h6>الدفعة
                            <br />
                            {{ $Talib->aldafeuh->name }}
                        </h6>
                    </div>
                    <div class="col-md-2 col-4 text-center" style="border: 1px solid #dfc3a2;border-bottom:5px solid #6c3a0f"">
                        <h6>المستوى
                            <br />
                            {{ $Talib->almustawayat->name }}
                        </h6>
                    </div>
                    <div class="col-md-2 col-4 text-center" style="border: 1px solid #dfc3a2;border-bottom:5px solid #6c3a0f"">
                        <h6>الحلقة
                            <br />
                            {{ $Talib->alhalaqat->name }}
                        </h6>
                    </div>
                    <div class="col-md-2  col-4 text-center" style="border: 1px solid #dfc3a2;border-bottom:5px solid #6c3a0f">
                        <h6>المحفظ
                            <br />
                            {{ $Talib->alhalaqat->user->name }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-primary text-center table-bordered" style="margin: 0">
            <thead>
             
                <tr>
                    <th>اسم الحافظ/ة</th>
                    <th>اختبار 1</th>
                    <th>اختبار 2</th>
                    <th>السرد</th>
                    <th>النهائي</th>
                </tr>
            </thead>
            <tbody>
        
                <tr>
                    <td> {{ $Talib->name }}</td>
                    <td>
                        {{$AlaikhtibaratOne ? $AlaikhtibaratOne->degree : '...'}}
                    </td>
                    <td>
                        {{$AlaikhtibaratTwo ? $AlaikhtibaratTwo->degree : '...'}}
                    </td>
                    <td>
                        {{$AlaikhtibaratThere ? $AlaikhtibaratThree->degree : '...'}}
                    </td>
                    <td>
                        {{$AlaikhtibaratFour ? $AlaikhtibaratFour->degree : '...'}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
