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
                        تعديل بيانات : {{ $Tailb->name }}
                    </h2>
                    <a
                        href="
                    @if ($Tailb->subscrption == 1) {{ route('admin.subscrption.single', $Tailb->id) }} @endif"
                    target="_blank"
                    >
                        <span
                            @if ($Tailb->subscrption == 1) class="badge bg-success"
                    @else 
                        class="badge bg-danger" @endif>عضوية
                            : {{ $Tailb->subscrption == 1 ? 'مدفوعة' : 'مجانية' }}
                        </span>
                    </a>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">


                        <a href="{{ route('admin.talibs.index') }}" class=" btn btn-dark d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            الحافظون
                        </a>
                        <a href="{{ route('admin.talibs.index') }}" class="btn btn-dark d-sm-none btn-icon">
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


    <div class="row">
        <div class="col">
            @error('reg_end')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('required_value')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('paid_value')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <form action="{{ route('admin.talibs.update', $Tailb->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <input type="hidden" name="subscrption_update" value="{{ $Tailb->subscrption }}">

                    <div class="col">
                        <label for="">الاسم</label>
                        <input type="text" class="form-control" value="{{ $Tailb->name }}" name="name">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="">الرقم المدني <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $Tailb->cid }}" name="cid" class="form-control">
                        @error('cid')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row my-4">
                    <div class="col">
                        <label for="">الجنس</label>
                        <select name="gender" class="form-control">
                            <option value="1" @checked($Tailb->gender == 1)>ذكر</option>
                            <option value="0" @checked($Tailb->gender == 0)>انثي</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="">تاريخ الميلاد</label>
                        <input type="date" required value="{{ $Tailb->date_of_birth }}" name="date_of_birth"
                            class="form-control">
                        @error('date_of_birth')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <label for="">هاتف الطالب </label>
                        <input type="number" value="{{$Tailb->phone}}"  name="phone" class="form-control">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">هاتف ولي الامر</label>
                        <input type="number" value="{{$Tailb->father_phone}}"  name="father_phone" class="form-control">
                        @error('father_phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col">
                    <label for="">الجنسية</label>
                    <select name="nationality" class="form-control">
                    @php
                        $countries = \App\Models\Country::all();
                       
                    @endphp
                    @foreach ($countries as $item)
                        <option value="{{$item->id}}">{{$item->country_name}}</option>
                    @endforeach
                    </select>
                
                </div>
                <div class="row my-4">


                    <div class="col">
                        <label for="">الحلقة</label>
                        <select name="alhalaqat_id" class="form-control">
                            <option value="" selected>فارغ</option>
                            @foreach ($Alhalaqats as $Item)
                                <option value="{{ $Item->id }}" @selected($Item->id == $Tailb->alhalaqat_id)>{{ $Item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="">المستوي</label>
                        <select name="almustawayat_id" class="form-control">
                            <option value="" selected>فارغ</option>
                            @foreach ($Almustawayats as $Item)
                                <option value="{{ $Item->id }}" @selected($Item->id == $Tailb->almustawayat_id)>{{ $Item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                </div>

                <div class="row">
                    <div class="col">
                        <label for="">الصورة الشخصية</label>

                        <input type="hidden" name="imageUpdate" value="{{ $Tailb->photo }}">
                        <input type="file" class="form-control" name="photo">
                        @if (file_exists(asset('/uploads/tailbs/' . $Tailb->photo)))
                        <img src="{{ asset('/uploads/tailbs/' . $Tailb->photo) }}" width="150" class="img-thumbnail">
                        @else
                        <span class="badge bg-warning">لا يوجد صورة</span>
                        @endif
                    </div>
                    <div class="col">

                        <label for="">الدفعه</label>
                        <select name="aldafeuh" class="form-control">
                        @php
                            $countries = \App\Models\Aldafeuh::all();
                           
                        @endphp
                        @foreach ($countries as $item)
                            <option value="{{$item->id}}" @selected($item->id == $Tailb->aldafeuh_id)>{{$item->name}}</option>
                        @endforeach
                        </select>

                        {{-- <label for="">الدفعة</label>
                        <input type="text" required value="{{old('aldafeuh')}}" name="aldafeuh" class="form-control"> --}}
                    </div>
                </div>
                <div class="my-4">
                    <div class="form-label">نوعية الاشتراك</div>
                    <label class="form-check form-switch">

                        <input class="form-check-input" data-status="{{ $Tailb->subscrption }}" name="subscrption"
                            @checked($Tailb->subscrption == 1) id="checkbox" type="checkbox">
                        <span class="form-check-label">{{ $Tailb->subscrption == 0 ? 'مجانية' : 'مدفوعة' }} </span>
                    </label>
                </div>

                {{-- @if ($Tailb->subscrption == 0)
                   
                <div class="subscrption {{$Tailb->subscrption == 0 ? 'd-none' : 'd-none'}}">
                    <div class="row">
                        <div class="col">
                            <div class="label">تاريخ البدء</div>

                            <input type="date" value="{{old('reg_start')}}" name="reg_start" class="form-control">


                            @error('reg_start')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="label">تاريخ الانتهاء</div>
                            <input type="date" value="{{old('reg_end')}}"  name="reg_end" class="form-control">
                            @error('reg_end')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col">
                            <div class="label">القيمة المطلوبة</div>
                            <input type="text"  value="{{old('required_value')}}"   name="required_value" class="form-control">

                        </div>
                        <div class="col">
                            <div class="label">القيمة المدفوعة</div>
                            <input type="text"  value="{{old('paid_value')}}" name="paid_value" class="form-control">
                        </div>
                    </div>
                </div>

                @endif --}}

                <div class="form-group my-2">
                    <input type="submit" class="btn btn-teal" value="تعديل">
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $("#checkbox").on("change", function() {
            if ($(this).data("status") != 1) {
                if (this.checked) {
                    $(this).next().html("مدفوعة")
                    $(".subscrption").removeClass("d-none");

                    $(".subscrption input").each(function() {
                        $(this).attr('required', 'required');
                    })
                } else {
                    $(this).next().html("مجانية")
                    $(".subscrption").addClass("d-none");
                    $(".subscrption input").each(function() {
                        $(this).attr('required', false);
                    })

                }
            } else {
                if (this.checked) {
                    $(this).next().html("مدفوعة")
                } else {
                    $(this).next().html("مجانية")

                }
            }

        })
    </script>
@endpush
