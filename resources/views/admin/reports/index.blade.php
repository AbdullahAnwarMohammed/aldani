@extends('admin.layouts.app')

@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        لوحة التحكم
                    </div>
                    <h2 class="page-title">
                         التقرير
                        
                    </h2>
                </div>

            </div>


        </div>
    </div>

@endsection
@section('content')
@php
    $Today = date("Y-m-d");
    // Counts
    $countUsers = App\Models\User::count();
    $countTalibs = App\Models\Talib::count();
    $countAbsence = App\Models\Tasmie::whereDate('date',$Today)->count();

@endphp
<table class="table table-bordered table-info">
    <tr>
        <th>#</th>
        <th>النوع</th>
    </tr>
    <tr>
        <td>1</td>
        <td><a href="{{route('admin.reports.users')}}" class="fw-bold text-dark">المحفظين <span class="badge bg-dark">{{$countUsers}}</span></a></td>
    </tr>
    <tr>
        <td>2</td>
        <td><a href="{{route('admin.reports.talibs')}}" class="fw-bold text-dark">الحافظين <span class="badge bg-dark">{{$countTalibs}}</span></a></td>
    </tr>
    <tr>
        <td>3</td>
        <td><a href="{{route('admin.reports.absence')}}" class="fw-bold text-dark">الغياب <span class="badge bg-dark">{{$countAbsence}}</span></a></td>
    </tr>

    <tr>
        <td>4</td>
        <td><a href="{{route('admin.reports.degree')}}" class="fw-bold text-dark">الدرجات للحافظ</a></td>
    </tr>

    <tr>
        <td>5</td>
        <td><a href="{{route('admin.reports.talibs.result')}}" class="fw-bold text-dark">النتائج للحافظ</a></td>
    </tr>
</table>
@endsection