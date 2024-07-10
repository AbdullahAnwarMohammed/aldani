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
                    الحافظون  : {{$Alhalaqat->name}}
                </h2>
            </div>
           
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="table-resposive">
    <table id="users_by_halqa2" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>اسم الحلقة</th>
                <th>الرقم المدني</th>
            </tr>
        </thead>
        @php
            $i = 1;
        @endphp
        <tbody>
        @foreach ($Alhalaqat->talibs as $item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->cid}}</td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection

@push('js')
    <script>
        // Dtatables 
        $('#users_by_halqa2').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json"
            }
        });
    </script>
@endpush
