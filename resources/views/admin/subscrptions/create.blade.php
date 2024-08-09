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
                        تسديد اشتراك
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        <a href="{{ route('admin.subscrption.index') }}" class=" btn btn-dark d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 14l-4 -4l4 -4" />
                                <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
                            </svg>
                            الاشتراكات
                        </a>
                        <a href="{{ route('admin.subscrption.index') }}" class="btn btn-dark d-sm-none btn-icon">
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
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    <form action="{{ route('admin.subscrption.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-4">

            <label for="">الحافظ</label>
            <select name="talib_id" id="subscript_insert" class="form-control">
                @php
                    $required_value = 0;

                @endphp
                @foreach ($Subscrptions->subscrptions as $Item)
                    @php
                        $required_value += $Item->required_value;
                    @endphp
                @endforeach
                @if ($Subscrptions->get_total_count_paid() < $required_value)
                    <option value="{{ $Subscrptions->id }}">{{ $Subscrptions->name }}</option>
                @else
                    <option disabled value="{{ $Subscrptions->id }}">{{ $Subscrptions->name }} (مكتمل)</option>
                @endif



            </select>
            @error('talib_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group my-2">
            <label for="">الشهور</label>
            <select name="subscrption_id" required id="subscrption_id" class="form-control">
                <option value="" selected disabled>الشهر</option>

                @foreach ($Subscrptions->subscrptions as $item)
                    {{-- @php
                        $Month = \Carbon\Carbon::parse($item->reg_start);
                        $Month = $Month->month;
                    @endphp --}}
                    <option value="{{ $item->id }}">{{ $item->reg_start }}</option>
                @endforeach
            </select>
            <div class="my-2 info_subscrption">

            </div>
        </div>

        <div class="form-group mb-2">
            <label for="">القيمة المدفوعة</label>
            <input type="number" name="paid_value" class="form-control">
            @error('paid_value')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" id="submit" class="btn btn-teal">تسديد </button>
    </form>
@endsection
{{-- @push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#subscript_insert').select2();

        })
    </script>
@endpush --}}
@push('js')
    <script>
        $("#subscrption_id").on("change", function() {
            let id = $(this).val();
            /*   'required_value' => $required_value,
                        'paid' => $Tailb->get_singal_total_count_paid($required_value->id),
                        'total' => $required_value - $Tailb->get_singal_total_count_paid($required_value->id)*/
            $.ajax({
                url: '{{ route('admin.subscrption.payments.ajax') }}',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    console.log();
                    $(".info_subscrption").html(`
                       <span class="badge bg-success"> 
                    ${data.required_value}
                    المطلوب
                    </span>
                     <span class="badge bg-info">
                                ${data.paid}
                        القيمة المدفوعه
                        </span>
             
                       <span class="badge bg-danger">
                                        ${data.total}

                    القيمة المتبقي</span>

                    
                    `);
                }
            })
        })
    </script>
@endpush
