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
                         الحلقات
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                        @can('اضافة حلقة')
                            
                        <a href="{{ route('admin.alhalaqat.create') }}" class=" btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            اضافة حلقة 
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
                        @endcan


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
                <tr 
                style="
                background:{{$Item->type == 1 ? "#dfecff" : "#ffbcd4"}}
                "
                >
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
                            @if (isset($Item->room_url))
                            <a class="btn btn-sm btn-indigo" target="_blank" href="{{$Item->room_url}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-zoom" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M17.011 9.385v5.128l3.989 3.487v-12z" />
                                    <path d="M3.887 6h10.08c1.468 0 3.033 1.203 3.033 2.803v8.196a.991 .991 0 0 1 -.975 1h-10.373c-1.667 0 -2.652 -1.5 -2.652 -3l.01 -8a.882 .882 0 0 1 .208 -.71a.841 .841 0 0 1 .67 -.287z" />
                                  </svg>
                                الغرفة</a>
                            @endif

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">حذف</button>
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
