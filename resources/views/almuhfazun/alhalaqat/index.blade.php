@extends('almuhfazun.layouts.app')
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
                    {{$Alhalaqat->name}} ({{date("Y-m-d")}})
                </h2>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
{{-- 7:30 --}}
<div class="row">
<table class="table">
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>الحضور</th>
        <th>الدفعة</th>
        <th>المستوي</th>
        <th>الجزء</th>
        <th>عدد الأرباع	</th>
        <th>المنهج	</th>
        <th>الدرجة	</th>
        <th>الملاحظات	</th>
    </tr>
    @php
        $i = 1;
    @endphp
    <form action="{{route('almuhfazun.alhalaqat.update')}}" method="POST">
        @csrf
    @foreach ($Alhalaqat->talibs as $item)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$item->name}}</td>
            <td>
                <select name="tailbs[{{$item->id}}][attend]" class="form-control">
                    <option value="1">حاضر</option>
                    <option value="3">حاضر اون لاين</option>
                    <option value="0">غائب</option>
                    <option value="2">غائب بعذر</option>
                </select>
            </td>
            <td>{{$item->aldafeuh}}</td>
            <td>{{$item->almustawayat->name}}</td>
            <td>
                <select name="tailbs[{{$item->id}}][parts]" class="form-control">
                <option value="1"></option>
                   @for ($i = 1; $i<=30;$i++)
                       <option value="{{$i}}">{{$i}}</option>
                   @endfor
                </select>
            </td>
            <td>
                <select name="" class="form-control"></select>
            </td>
            <td>
                <select name="" class="form-control"></select>

            </td>
            <td width="10">
                <input type="text" class="form-control">
            </td>
            <td>
            <input type="text" class="form-control">
            </td>
        </tr>
    @endforeach
    <input type="submit" class="btn btn-success" value="التعديل">
</form>
</table>
{{--   
    <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-stamp">
            <div class="card-stamp-icon bg-yellow">
              <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg>
            </div>
          </div>
          <div class="card-body">
            <h3 class="card-title">الحافظون</h3>
            <p class="text-secondary">
               
           
                <span class="badge bg-warning">
                    @foreach (Auth::user()->alhalaqats as $item)
                      {{$item->name}}
                    @endforeach
                </span>
            </p>
          </div>
        </div>
      </div> --}}
</div>
@endsection