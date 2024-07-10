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
                        استعراض الحلقات
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        <a href="{{ route('admin.alhalaqat.create') }}" class=" btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            اضافة حلقة جديدة
                        </a>
                        <a href="{{ route('admin.alhalaqat.create') }}" class="btn btn-primary d-sm-none btn-icon">
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
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <table id="alhalaqats" class="table table-bordered">
        <thead>

            <tr>
                <th>#</th>
                <th>اسم الحلقة</th>
                {{-- <th>القسم</th> --}}
                <th>المحفظ</th>
                <th>الحافظون</th>
                <th>الخيارات</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($Alhalaqats as $Item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td class="update-link" data-route="{{ route('admin.alhalaqat.edit', $Item->id) }}">{{ $Item->name }}
                    </td>
                    {{-- <td>
                        @if ($Item->subdivision)
                            <span class="badge bg-success">{{ $Item->subdivision->name }}</span>
                        @else
                            <span class="badge bg-danger">لا يوجد</span>
                        @endif
                    </td> --}}
                    <td>
                        @if ($Item->user)
                            <span class="badge bg-success">{{ $Item->user->name }}</span>
                        @else
                            <span class="badge bg-danger">لا يوجد</span>
                        @endif
                    </td>
                    <td>
                        @if (count($Item->talibs) > 0)
                            <span class="badge bg-success">{{ count($Item->talibs) }}</span>
                        @else
                            <span class="badge bg-danger">0</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.alhalaqat.destroy', $Item->id) }}"
                            onsubmit="return confirm('سوف تقوم بالحذف')" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('js')
    <script>
        // Dtatables 
        $('#alhalaqats').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json"
            }
        });
    </script>
@endpush
