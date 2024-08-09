@extends('admin.layouts.app')
@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        وحدة التحكم
                    </div>
                    <h2 class="page-title">
                        تصدير [SQL]

                    </h2>
                    {{-- <span class="alert alert-danger d-block">
                        يرجى الحذر أثناء القيام بهذه الخطوة والاحتفاظ بنسخة من قاعدة البيانات
سيتم حذف قاعدة البيانات الحالية واستعادة التي سترفعها من جهازك

                    </span> --}}
                </div>
                <!-- Page title actions -->
            
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="col-md-6-auto ms-auto d-print-none">
                <div class="btn-list">
        
                    
                <a href="{{ route('admin.export.all.database') }}" class=" btn btn-primary d-none d-sm-inline-block">
                    تصدير قاعدة البيانات
                </a>

              
        
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
      


        @if (Session::has("error"))
    
        <div class="alert alert-important alert-danger alert-dismissible" role="alert">
            <div class="d-flex">
              <div>
                <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
              </div>
              <div>
                {{Session::get('error')}}
              </div>
            </div>
            
          </div>
        
          @endif

        @if (Session::has("success"))
    
        <div class="alert alert-important alert-success alert-dismissible" role="alert">
            <div class="d-flex">
              <div>
                <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
              </div>
              <div>
                {{Session::get('success')}}
              </div>
            </div>
            
          </div>
        
          @endif
          {{-- <form action="{{ route('admin.settings.store.database') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="sql_file" class="form-control">
            <button type="submit" class="btn btn-danger my-2">استعادة</button>
        </form> --}}
        <hr style="margin-bottom: 15px">

        <h2>تصدير جدول [SQL,EXCEL]</h2>
        <form action="{{route("admin.export.file.database")}}" method="POST">
          @csrf
          <div class="row g-3">
            <div class="col">
              <select name="type" class="form-control">
                <option value="1">الطلاب</option>
                <option value="2">المحفظين</option>
                <option value="3">المستخدمين</option>
                <option value="4">الحلقات</option>
                <option value="5">المستويات</option>
                <option value="6">درجات الحلقات</option>
                <option value="7">درجات الاختبارات</option>
              </select>
            </div>
            <div class="col-2">
              <select name="file" id="file" class="form-control">
                <option value="" selected disabled> النوع</option>
                <option value="sql">SQL</option>
                <option value="excel">EXCEL</option>
                <option value="reader">بيانات</option>
              </select>
            </div>
           
            <div class="col">
              <input type="submit" value="تصدير" class="btn btn-primary ">
            </div>
          </div>
        </form>
    </div>
@endsection

@push('js')
  {{-- <script>
   $("#file").on("change",function(){
    let fileValue = $(this).val();
    if(fileValue == "excel")
   {
    $(".export-type").removeClass("d-none")
   }else{
    $(".export-type").addClass("d-none")

   }
   })
  </script> --}}
@endpush