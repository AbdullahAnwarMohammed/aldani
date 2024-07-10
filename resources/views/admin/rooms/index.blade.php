@extends('admin.layouts.app')
@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        وحدة التحكم
                    </div>
                    <h2 class="page-title">
                        غرف التسميع

                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        <a href="{{ route('admin.rooms.create') }}" class=" btn btn-teal d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            انشاء غرفة
                        </a>
                       


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>اسم الغرفة</th>
                <th>الحلقة</th>
                <th>المحفظ</th>
                <th>الطلاب</th>
            </tr>
            @php
                $i = 1;
            @endphp
            @forelse ($Rooms as $item)
                <tr>
                    <td class="details" data-route="{{$item->url}}">{{$i++}}</td>
                    <td class="update-link" data-route="{{route('admin.rooms.edit',$item->id)}}">{{$item->name}}</td>
                    <td>{{$item->alhalaqat->name}}</td>
                    <td>{{$item->alhalaqat->user->name}}</td>

                    <td>{{count($item->alhalaqat->talibs)}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-danger fw-bold text-center">لا يوجد اي غرف حتي</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection
