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
                        اعدادت الموقع

                    </h2>
                </div>
                <!-- Page title actions -->
            
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
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
        <form action="{{route("admin.settings.update")}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card p-2">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">السنة</label>
                        <input type="text" name="year" class="form-control" value="{{$Setting->year}}">
                    </div>
                    <div class="col-md-6">
                        <label for="">الترم الدراسي</label>
                        <select name="session_id" class="form-control">
                            @if (!$Setting->session_id)
                                <option value="" selected disabled>اختر</option>  
                            @endif
                            @foreach ($Sessions as $item)
                               
                                <option value="{{$item->id}}" @selected($Setting->session_id == $item->id)>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">اسم الموقع</label>
                    <input type="text" value="{{$Setting->name_site}}" class="form-control" name="name_site">
                    @error('name_site')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="">بريد الموقع</label>
                    <input type="text" value="{{$Setting->email_site}}"  class="form-control" name="email_site">
                    @error('name_site')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">العنوان</label>
                    <input type="text" value="{{$Setting->address}}"  class="form-control" name="address">
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="">رقم الهاتف</label>
                    <input type="text" value="{{$Setting->phone}}"  class="form-control" name="phone">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="">فيس بوك</label>
                    <input type="text"  value="{{$Setting->facebook_site}}"  class="form-control" name="facebook_site">
                    @error('facebook_site')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="">تويتر</label>
                    <input type="text"   value="{{$Setting->twitter_site}}"  class="form-control" name="twitter_site">
                    @error('twitter_site')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">يوتيوب</label>
                    <input type="text" value="{{$Setting->youtube_site}}"   class="form-control" name="youtube_site">
                    @error('youtube_site')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="">آنستجرام</label>
                    <input type="text" value="{{$Setting->instgram_site}}"  class="form-control" name="instgram_site">
                    @error('instgram_site')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="">الخريطة</label>
                    <textarea name="maps" value="{{$Setting->maps}}" class="form-control"  col-md-6s="30" rows="10"></textarea>
                </div>
                <div class="col-md-6">
                    <label for="">رسالة اغلاق الموقع</label>
                    <textarea name="message_close_site" class="form-control"  col-md-6s="30" rows="10">{{$Setting->message_close_site}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="">الشعار الاكبر</label>
                    <input type="hidden" name="logo_big_value" value="{{$Setting->logo_big}}" >

                    <input type="file" accept="image/*" class="form-control" value="{{$Setting->logo_big}}" name="logo_big">
                    @error('logo_site')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">الشعار الاصغر</label>
                    <input type="hidden" name="logo_small_value" value="{{$Setting->logo_small}}" >

                    <input type="file" accept="image/*" class="form-control" value="{{$Setting->logo_small}}" name="logo_small">
                    @error('logo_site')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="">الايقون</label>
                    <input type="hidden" name="favicon_hidden" value="{{$Setting->favicon_site}}" >

                    <input type="file" accept="image/*"   value="{{$Setting->favicon_site}}"  class="form-control" name="favicon_site">
                    @error('favicon_site')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-6">
                    <label for="">حالة الموقع</label>
                    <select name="status_site" class="form-control">
                        <option value="1" @selected($Setting->status_site == 1)>يعمل</option>
                        <option value="0" @selected($Setting->status_site == 0) >مغلق</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="">دخول الحافظون</label>
                    <select name="login_almuhfazin" class="form-control">
                        <option value="1" @selected($Setting->login_almuhfazin == 1) >يعمل</option>
                        <option value="0" @selected($Setting->login_almuhfazin == 0) >لا يعمل</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-dark" value="تعديل">
            </div>
        </form>

    </div>
@endsection
