@extends('admin.layouts.app')

@push('css')
<style>
      @media print {
        /* Hide all elements except the table with ID 'subscrptions' */
      .navbar,#subscrptions_length,#subscrptions_filter,.dataTables_info,.paging_simple_numbers{
        display: none
      }
      .in-print{
        display: flex !important;
        justify-content: space-between;
        align-items: center
      }
      .in-print img{
        max-width: 100px;
      }
      .table-responsive{
        overflow: hidden;
      }
      #subscrptions  thead th{
        color:#000 !important;
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
                        وحدة التحكم
                    </div>
                    <h2 class="page-title">
                        قائمة الاشتراكات
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                        <button class=" btn btn-primary d-none d-sm-inline-block " onclick="javascript:window.print();">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                              </svg>
                            طباعة القائمة
                        </button>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="d-none in-print">
        <h2>طباعة جدول كل المشتركين</h2>
        <img src="/uploads/logo/{{ $Setting->logo_small }}" style="width:200px" class="img-thumbnail">

    </div>
    <div class="table-responsive">
        <table id="subscrptions" class="table table-bordered table-sm">
            <thead>

                <tr style="background: red">
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الرقم المدني</th>

                    <th>المبلغ المطلوب</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                    $required_value = 0;
                    $payments = 0;
                @endphp
                @foreach ($Subscrptions as $Item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td class="update-link fw-bold" data-route="{{ route('admin.subscrption.single', $Item->id) }}">
                                {{ $Item->name }}
                            </td>
                        <td>{{ $Item->cid }}</td>
                        @foreach ($Item->payments() as $payment)
                        @php
                              $payments += $payment->paid_value;
                        @endphp
                       @endforeach
                       @foreach ($Item->subscrptions as $item)
                       @php
                          $required_value += $item->required_value
                       @endphp
                       @endforeach
                        <td
                        @if ($required_value > $payments)
                        style="background:#ff7ca0;color:#fff;font-weight:bold"
                        @else
                        style="background:green;color:#fff;font-weight:bold"

                        @endif
                        >
                         
                          @if ($required_value > $payments)
                              متبقي {{$required_value - $payments}}
                        @else 
                            مكتمل 
                          @endif
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
        $('#subscrptions').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json"
            }
        });
    </script>
@endpush
