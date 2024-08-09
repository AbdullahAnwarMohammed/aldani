@extends('admin.layouts.app')

@push('css')
    <style>
        @media print {
            #search {
                display: none;
            }

            /* Hide all elements except the table with ID 'table' */
            .navbar,
            #table_length,
            #table_filter,
            .dataTables_info,
            .paging_simple_numbers,
            .d-print-none {
                display: none;
            }

            .in-print {
                display: flex !important;
                justify-content: space-between;
                align-items: center;
            }

            .in-print img {
                max-width: 100px;
            }

            .table-responsive {
                overflow: hidden;
            }

            #table thead th {
                color: #000 !important;
            }
        }
    </style>
@endpush

@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        التقارير
                    </div>
                    <h2 class="page-title">
                        <div class="d-flex justify-content-between" style="width:100%">
                            <span>المحفظون</span>
                            <div>
                                <button class="btn btn-primary d-none d-sm-inline-block" onclick="javascript:window.print();">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                    </svg>
                                    طباعة
                                </button>
                                <a href="{{ route('admin.reports.index') }}" class="btn btn-dark">للخلف</a>
                            </div>
                        </div>
                    </h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="d-none in-print">
        <h2>طباعة تقرير المحفظون</h2>
        <img src="/uploads/logo/{{ $Setting->logo_small }}" style="width:200px" class="img-thumbnail">
    </div>

    <form action="{{ route('admin.reports.users') }}" id="search" class="row gx-3 gy-2 align-items-center">
        <div class="col-10">
            <label class="visually-hidden" for="specificSizeInputGroupUsername">Username</label>
            <div class="input-group">
                <select name="gender" class="form-control">
                    <option value="" selected disabled>اختر الجنس</option>
                    <option value="1">ذكور</option>
                    <option value="0">إناث</option>
                </select>
            </div>
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary">بحث</button>
        </div>
    </form>

    <div class="table-responsive">
        <table id="table" class="table my-2 table-bordered">
            <thead>
                <tr>
                    <th>م</th>
                    <th>الاسم</th>
                    <th>الجنس</th>
                    <th>الحلقة</th>
                    <th>عدد الحافظين</th>
                    <th>الهاتف</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                    $countTalibs = 0;
                @endphp
                @foreach ($Users as $user)
                    @php
                        $gender = $user->gender == 1 ? 'ذكر' : 'أنثى';
                    @endphp
                    <tr @if ($user->gender == 0) style="background: #fd9cff;font-weight:bold;color:#551456" @endif>
                        <td>{{ $i++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $gender }}</td>
                        <td>
                            @foreach ($user->alhalaqats as $item)
                                @php
                                    $countTalibs += count($item->talibs);
                                @endphp
                                <span class="badge bg-dark ">{{ $item->name }} {{ count($item->talibs) }}</span>
                            @endforeach
                        </td>
                        <td>{{ $countTalibs }}</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    @php
                        $countTalibs = 0;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('js')
    <script>
        // Initialize DataTables
        $('#table').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json",

            },
            'pageLength': 100

        });
    </script>
@endpush
