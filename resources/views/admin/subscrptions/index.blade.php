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
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                        <button class=" btn btn-primary d-none d-sm-inline-block " onclick="javascript:window.print();">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
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
    <div class="table-responsive">
        <table id="subscrptions" class="table table-bordered table-sm">
            <thead>

                <tr>
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
                        <td><a href="{{ route('admin.subscrption.single', $Item->id) }}">
                                {{ $Item->name }}
                            </a></td>
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
