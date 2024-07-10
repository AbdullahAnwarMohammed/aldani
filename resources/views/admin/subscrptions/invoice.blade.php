@extends('admin.layouts.app')
@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        طباعة الفاتورة
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                        <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                            </path>
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                        </svg>
                        طباعة فاتورة
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card card-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="h3">موقع الداني</p>
                            <address>
                                المكان : <br>
                                المحافظة : <br>
                                البريد :
                            </address>
                        </div>
                        <div class="col-6 text-end">
                            <p class="h3">مرحباً : {{ $Subscrption->subscrption->name }} </p>
                            <address>
                                تاريخ التسجيل : {{ $Subscrption->subscrption->created_at }}<br>
                                الرقم المدني : {{ $Subscrption->subscrption->cid }}<br>
                                المبلغ المطلوب سداده : {{ $Subscrption->required_value }}<br>
                            </address>
                        </div>
                        <div class="col-12 my-5">
                            <h1>فاتورة استحقاق الاشتراك</h1>
                            <span>تاريخ : <i>{{ date('Y-m-d H:i:s') }}</i></span>
                        </div>
                    </div>
                    <table class="table table-transparent table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%"></th>
                                <th>تاريخ الدفع</th>
                                <th class="text-end" style="width: 1%">القيمة المدفوعة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($Subscrption->payments() as $Item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td>
                                        <p class="strong mb-1">{{ $Item->created_at }}</p>
                                    </td>
                                    <td>{{ $Item->paid_value }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="2" class="strong text-end">المجموع</td>
                                <td class="text-end">{{ $Subscrption->subscrption->get_singal_total_count_paid($Subscrption->id) }}</td>
                            </tr>

                            <tr>
                                <td colspan="2" class="strong text-end">متبقي</td>
                                <td class="text-end">
                                    {{ $Subscrption->required_value - $Subscrption->subscrption->get_singal_total_count_paid($Subscrption->id) }}</td>
                            </tr>



                        </tbody>
                    </table>
                    <p class="text-secondary text-center mt-5">شكرا جزيلا لك على التعامل معنا. نحن نتطلع قدما للعمل معك مرة
                        أخرى!
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        Swal.fire({
  position: "top-start",
  icon: "success",
  title: "تم الدفع بنجاح",
  showConfirmButton: false,
  timer: 1500
});
    </script>
@endpush