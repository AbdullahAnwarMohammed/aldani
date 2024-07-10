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
                        استعادة قاعدة البيانات

                    </h2>
                    <span class="alert alert-danger d-block">
                        يرجى الحذر أثناء القيام بهذه الخطوة والاحتفاظ بنسخة من قاعدة البيانات
سيتم حذف قاعدة البيانات الحالية واستعادة التي سترفعها من جهازك

                    </span>
                </div>
                <!-- Page title actions -->
            
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="col-md-6-auto ms-auto d-print-none">
                <div class="btn-list">
        
                    
                <a href="{{ route('admin.settings.export.database') }}" class=" btn btn-primary d-none d-sm-inline-block">
                    تصدير ملف SQL
                </a>
                <a href="{{ route('admin.settings.export.database') }}" class="btn btn-primary d-sm-none btn-icon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings-bolt" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M13.256 20.473c-.855 .907 -2.583 .643 -2.931 -.79a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.07 .26 1.488 1.29 1.254 2.15" />
                        <path d="M19 16l-2 3h4l-2 3" />
                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                      </svg>
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
          <form action="{{ route('admin.settings.store.database') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="sql_file" class="form-control">
            <button type="submit" class="btn btn-danger my-2">استعادة</button>
        </form>
    </div>
@endsection
