@extends('front.layouts.app')
@section('content')
   <!-- هيكل السلايدر -->
   <div id="slideshow">
    <div id="splide" class="splide">
        @php
            $Sliders = \App\Models\Slider::orderBy('position','asc')->get();
        @endphp
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($Sliders as $Slider)
                    <li class="splide__slide">
                        <img src="uploads/slider/{{ $Slider->photo }}" alt="Slide 1">
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
    @if (!Auth::guard('admin')->check() && !Auth::check())
        <div class="container" >

            <div class="row my-4 p-4" id="containerLogin"
                style="background: #c9c9c9;
        box-shadow: 2px -2px 17px -8px rgb(137 137 137);
        border-bottom:10px solid #8d8d8d;
        border-radius:50px;
            width: 89%;
    margin: auto;

        ">


                <div id="appLogin" class="col-md-6  d-flex flex-column align-items-center" style="">
                    <h5 style="color:#fff;background:#6f42c1;padding:10px;width:100%;"
                        class="fw-bold rounded-3 text-center">دخول المستخدم</h5>
                    @if ($errors->has('email'))
                        <span class="text-danger fw-bold p-2 rounded-2 d-block my-2" style="background: #ffc5c5">*
                            {{ $errors->first('email') }}</span>
                    @endif

                    <form action="{{ route('home.AdminOrUser') }}" id="login" style="width: 90%" method="POST">

                        @csrf
                        <div class="form-group">
                            <input style="background: #f7f7f7;color:#626262" required name="email" type="text"
                                placeholder="اسم المستخدم او الايميل" class="form-control fw-bold">
                        </div>
                        <div class="input-group">
                            <input style="background: #f7f7f7;color:#626262" name="password" required
                                type="password" class="form-control fw-bold">
                                <button type="submit" style="color:#443c21" class="btn btn-warning fw-bold">
                                    دخول</button>
                        </div>
                        <div class="form-group my-2">
                            <span class="fw-bold " style="color:#363636">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">تذكرني</label>
                            </span>
                        </div>
                        {{-- <div class="form-group">
                            <input type="submit" style="color:#443c21" class="btn btn-warning fw-bold"
                                value="دخول">
                        </div> --}}
                    </form>
                </div>
                <div id="appParent" class="col-md-6  d-flex flex-column align-items-center mt-4 mt-md-0">
                    <h5 style="color:#fff;background:#6f42c1;padding:10px;width:100%;"
                        class="fw-bold rounded-3 text-center">دخول ولي الامر</h5>
                    <form action="{{route('home.talib.search')}}" method="POST" id="login" style="width: 90%">
                      
                        @csrf
                        <div class="input-group">
                            <input required name="cid" style="background: #f7f7f7" required type="text"
                                placeholder="الرقم المدني للطالب" class="form-control">
                            <button type="submit" style="color:#443c21" class="btn btn-warning fw-bold">
                                دخول</button>
                        </div>
                        @if (Session::has('error'))
                        <div class="text-danger fw-bold p-2 rounded-2 d-block my-2" style="background: #ffc5c5">* {{Session::get('error')}}</div>
                    @endif
                    </form>
                </div>
            </div>

        </div>
    @endif

</div>
@endsection