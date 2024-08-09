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
                        الحافظون
                    </h2>
                    <a href="{{route('admin.talibs.export')}}" class="btn btn-success">تصدير EXCEL</a>

                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        <a href="{{ route('admin.talibs.create') }}" class=" btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            اضافة حافظ
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
    @if (Session::has('delete'))
        <div class="alert alert-success">{{ Session::get('delete') }}</div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <div class="table-responsive">
        <table id="talibs" class="table table-bordered table-sm">
            <thead>

                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>العمر</th>
                    <th>الرقم المدني</th>
                    <th>الحلقة</th>
                    <th>الدفعة</th>
                    <th>المتسويات</th>
                    <th>الاجراءت</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($Talibs as $Item)
                    <tr
                        @if ($Item->gender == 0) style="background:#ffdefb;font-weight:bold;color:#521d4c"
                    @else 
                    style="background:#fff;font-weight:bold;color:#275225" @endif>
                        <td
                        data-route="{{ route('admin.talibs.details', $Item->id) }}"
                         class="details"
                         >{{ $i++ }}</td>

                        <td 
                        style="cursor: pointer"
                        data-route="{{ route('admin.talibs.edit', $Item->id) }}" class="update-link"
                            @if ($Item->subscrption == 1) style="background:#fff93f" @endif>
                            {{ $Item->name }}
                            @if ($Item->subscrption == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet"
                                    width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />
                                    <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" />
                                </svg>
                            @endif

                        </td>
                        <td>

                            @php
                                $age = \Carbon\Carbon::parse($Item->date_of_birth)->age;
                            @endphp
                            {{ $age }} سنة

                        </td>
                        <td>{{ $Item->cid }}</td>
                        <td>
                            @if (isset($Item->alhalaqat))
                                <span class="badge badge-danger">{{ $Item->alhalaqat->name }}</span>
                            @else
                                <span class="badge bg-danger">لا يوجد</span>
                            @endif
                        </td>
                        <td>{{ $Item->aldafeuh->name }}</td>
                        <td>
                            @if (isset($Item->almustawayat))
                                <span class="badge badge-danger">{{ $Item->almustawayat->name }}</span>
                            @else
                                <span class="badge bg-danger">لا يوجد</span>
                            @endif
                        </td>

                        <td>
                            <form action="{{ route('admin.talibs.destroy', $Item->id) }}" method="POST"
                                onsubmit="return confirm('سوف تقوم بالحذف')">
                                @csrf
                                @method('DELETE')
                               
                                <button class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('js')
    <script>
        // Dtatables 
        $('#talibs').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json"
            }
        });


     
    </script>
@endpush
