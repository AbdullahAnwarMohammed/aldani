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
                    استعراض الحلقات الخاصة بـ : {{$User->name}}
                </h2>
            </div>
           
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="table-resposive">
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>اسم الحلقة</th>
            <th>عدد الحافظون</th>
            <th>الاجراءت</th>
        </tr>
        @php
            $i = 1;
        @endphp
        @foreach ($User->alhalaqats as $item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->name}}</td>
                <td>{{count($item->talibs)}}</td>
                <td>
                    @if (count($item->talibs) > 0)
                    <a href="{{route("admin.talibs.halqa",$item->id)}}" class="btn btn-outline-info btn-sm">الحافظون</a>

                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection