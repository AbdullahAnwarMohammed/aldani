@extends('admin.layouts.app')
{{--
13/7
8:20 - 9:05
 --}}


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
                        اشتراكات | {{ $Talib->name }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        <a href="{{ route('admin.subscrption.create', $Talib->id) }}"
                            class=" btn btn-teal d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                             تسديد اشتراك
                        </a>

                        <a href="{{ route('admin.subscrption.add', $Talib->id) }}"
                            class=" btn btn-primary d-none d-sm-inline-block ">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            اضافة اشتراك
                        </a>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
            <tr>
                <th>#</th>
                <th>بداية الاشتراك</th>
                <th>نهاية الاشتراك</th>
                <th>القيمة المطلوبة</th>
                <th>القيمة المدفوعة</th>
                <th>المتبقي</th>
                <th>الاجراءت</th>
            </tr>
            @php
                $i = 1;
                $required_value = 0;
                $payments = 0;
                $total_paid = 0;
            @endphp

            @foreach ($Talib->subscrptions as $Item)
                {{-- المدفوعات كلها --}}
                @foreach ($Item->payments() as $payment)
                   @php
                        $total_paid += $payment->paid_value
                   @endphp
                @endforeach
                
                @php       
                    $required_value += $Item->required_value;
                @endphp

                <tr
                    @if (date('Y-m-d') > $Item->reg_end) style="background:#ff9800;color:#422b09;font-weight:bold"
            @else @endif>
                    <td>{{ $i++ }}</td>
                    <td  data-route="{{route('admin.subscrption.edit',$Item->id)}}" class="update-link">{{ $Item->reg_start }}</td>
                    <td>{{ $Item->reg_end }}</td>
                    <td>{{ $Item->required_value }}</td>

                    <td
                        @if (array_sum($Item->payments()->pluck('paid_value')->toArray()) > 0) style="background:#13ad00;font-weight:bold;color:#fff"
                @else 
                style="background:green;font-weight:bold;color:#fff" @endif>
                        {{ array_sum($Item->payments()->pluck('paid_value')->toArray()) }}

                    </td>
                    <td
                    @if ($Item->required_value - array_sum($Item->payments()->pluck('paid_value')->toArray()) > 0 )
                        style="background:#ff548b;font-weight:bold;color:#fff"
                    @endif
                    > {{ $Item->required_value - array_sum($Item->payments()->pluck('paid_value')->toArray()) }}</td>

                    <td>
                        <a href="{{route('admin.subscrption.payments',$Item->id)}}"  class="btn btn-sm btn-outline-teal open-paid update-s"
                        >
                         فاتورة
                     </a>
                        {{-- <a href="{{ route('admin.subscrption.invoice', [$Talib->id, $Item->id]) }}"
                            class="btn btn-info btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                            </svg>
                            طباعة
                        </a>
                        <a href="#" data-id="{{ $Item->id }}" class="btn btn-sm btn-outline-info update-s"
                            data-bs-toggle="modal" data-bs-target="#modal-update">
                            تعديل
                        </a>
                        <a href=""  class="btn btn-sm btn-outline-teal open-paid update-s"
                           >
                            المدفوعات
                        </a> --}}
                    </td>
                </tr>
                
            @endforeach
            {{-- @foreach ($Talib->payments() as $payment)
                @php
                    $payments += $payment->paid_value;
                @endphp
            @endforeach --}}

        </table>

    </div>

    <div class="row my-4">
        <div class="col text-end">
            <span>
                {{-- المدفوع --}}
                <i class="badge bg-success">مدفوع</i> : {{$total_paid}}
                {{-- المتبقي --}}
                <i class="badge bg-danger">متبقي</i> : {{$required_value - $total_paid}}
            </span>
        </div>
    </div>


    <!-- Modal Update Level -->

    <div class="modal modal-blur fade" id="modal-update" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل اشتراك</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="error-messages"></div>

                    <form id="update-subscrption" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="idSingle" value="{{explode("/",Request::URL())[6]}}">
                        <input type="hidden" id="uploadId" name="uploadId">
                        <div class="form-group mb-4">
                            <label for="">بداية الاشتراك</label>
                            <input type="date" required name="reg_start" id="reg_start" class="form-control">
                            <div class="text-danger nameError"></div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="">نهاية الاشتراك </label>
                            <input type="date" required name="reg_end" id="reg_end" class="form-control">
                            <div class="text-danger emailError"></div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="">القيمة المطلوبة </label>
                            <input type="text" required name="required_value" id="required_value" class="form-control">
                            <div class="text-danger passwordError"></div>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary">تعديل</button>
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">اغلاق</button>
                    </form>
                </div>

            </div>
        </div>
    </div>



@endsection

@push('js')
    <script>

$(".update-link").on("click", function(e) {
            e.preventDefault(); // Prevent defaeult action of the link
            var route = $(this).data('route'); // Get the route from data attribute
            window.location.href = route; // Redirect to the route
        })


        // Dtatables 
        $('#subscrptions').DataTable({
            "language": {
                "url": "/dashboard/datatables/ar.json"
            }
        });
        
      
    </script>
@endpush
