@extends('admin.layouts.app')

@push('css')
    <style>

        @media print {
            #search {
                display: none
            }

            /* Hide all elements except the table with ID 'subscrptions' */
            .navbar,
            #subscrptions_length,
            #subscrptions_filter,
            .dataTables_info,
            .paging_simple_numbers {
                display: none
            }

            .in-print {
                display: flex !important;
                justify-content: space-between;
                align-items: center
            }

            .in-print img {
                max-width: 100px;
            }

            .table-responsive {
                overflow: hidden;
            }

            #table thead th , #table tr td {
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
                        لوحة التحكم
                    </div>
                    <h2 class="page-title">
                        <div class="d-flex justify-content-between" style="width:100%">

                          <span>الحافظين</span>
                          <div>
                            <button class=" btn btn-primary d-none d-sm-inline-block " onclick="javascript:window.print();">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                  width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                                  fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path
                                      d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                  <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                  <path
                                      d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                              </svg>
                              طباعة
                          </button>
                          <a href="{{route("admin.reports.index")}}" class="btn btn-dark">للخلف</a>
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
    <h2>طباعة تقرير الحافظين</h2>
    <img src="/uploads/logo/{{ $Setting->logo_small }}" style="width:200px" class="img-thumbnail">

</div>

<form action="{{ route('admin.reports.talibs') }}" id="search" class="row gx-3 gy-2 align-items-center">
    <div class="col-10">
        <label class="visually-hidden" for="specificSizeInputGroupUsername">Username</label>
        <div class="input-group">
            {{-- <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Username"> --}}
            <select name="gender" class="form-control">
                <option value=""  >اختر الجنس</option>
                <option value="1" @selected(Request('gender') == 1 && !empty(Request('gender')))>ذكور</option>
                <option value="0" @selected(Request('gender') == 0 && !empty(Request('gender')))>آناث</option>
            </select>

            <select name="alhalaqat" class="form-control">
                <option value="" selected >الحلقة </option>
                @php
                    $alhalaqats = \App\Models\Alhalaqat::all();
                @endphp
                @foreach ($alhalaqats as $item)
                    <option @selected(Request('alhalaqat') == $item->id && !empty(Request('alhalaqat'))) value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                
            </select>
            <select name="aldafeuh" class="form-control">
                <option value="" selected >اختر الدفعه</option>
                @php
                $aldafeuhs = \App\Models\Aldafeuh::all();
            @endphp
            @foreach ($aldafeuhs as $item)
                <option value="{{$item->id}}" @selected(Request('aldafeuh') == $item->id && !empty(Request('aldafeuh'))) >{{$item->name}}</option>
            @endforeach
            </select>
            <select name="almustawayat" class="form-control">
                <option value="" selected >اختر المستوي</option>
                @php
                $almustawayats = \App\Models\Almustawayat::all();
            @endphp
                @foreach ($almustawayats as $item)
                <option value="{{$item->id}}" @selected(Request('almustawayat') == $item->id && !empty(Request('almustawayat'))) >{{$item->name}}</option>
            @endforeach
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
        <th>الرقم المدني</th>
        <th>تاريخ الميلاد</th>
        <th>الهاتف</th>
        <th>الحلقة</th>
        <th>الدفعه</th>
        <th>المستوي</th>
    </tr>
  </thead>
    @php
        $i = 1;
    @endphp
    @foreach($Talibs as $item)
    <tr @if ($item->gender == 0) style="background: #fd9cff;font-weight:bold;color:#551456" @endif>
        <td>{{$i++}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->gender == 1 ? "ذكر":"انثي"}}</td>
        <td>{{$item->cid}}</td>
        <td>{{$item->date_of_birth}}</td>
        <td>{{$item->phone}}</td>
        <td>{{isset($item->alhalaqat->name) ? $item->alhalaqat->name : "__"}}</td>
        <td>{{isset($item->aldafeuh->name) ? $item->aldafeuh->name : "__"}}</td>
        <td>{{isset($item->almustawayat->name) ? $item->almustawayat->name : "__"}}</td>
    </tr>
    @endforeach

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