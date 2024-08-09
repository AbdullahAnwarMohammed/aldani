<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="{{asset('uploads/favicon/'.$Setting->favicon_site)}}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap');

        body {

            font-family: "Cairo", sans-serif;
        }

        .nav-link {
            color: #fff;
        }

        .nav-link:hover {
            color: #ffe083;
        }

        .navbar-nav .nav-link.active {
            color: #ffe083 !important;
            font-weight: bold;
        }
    </style>
    <link rel="stylesheet" href="/front/assetsFrontend/css/style.css">
    <title>مـوقع الداني</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: rgb(243 243 243)">
        <div class="container-fluid">
            <a class="navbar-brand ms-lg-auto" href="{{route("home.index")}}">
                <img src="{{asset('uploads/logo/'.$Setting->logo_small)}}" alt="" width="50px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @foreach ($PageHeader as $header)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" 
                            href="{{route('home.page',$header->id)}}">
                                {!! $header->icon !!}
                                {{ $header->name }}
                            </a>
                        </li>
                    @endforeach
                 
                </ul>
            </div>
            <!-- زر تسجيل الدخول يظهر فقط على الشاشات الكبيرة -->
            @if (Auth::guard('admin')->check())
                {{-- <button class="btn  rounded-3 d-none d-lg-block mx-2" style="background-color: #2e2e2e;color:#fff"
                    type="button"> <i class="fa-solid fa-user"></i> {{ Auth::guard('admin')->user()->name }}</button> --}}
                <a href="{{ route('admin.home') }}" target="_blank" class="btn text-white rounded-0" style="background: #000">
                    <i class="fa-solid fa-gauge"></i> لوحة التحكم </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary rounded-0"><i
                            class="fa-solid fa-right-from-bracket"></i></button>
                </form>
            @endif

            @if (Auth::check() && !Auth::guard('admin')->check())
                {{-- <button class="btn  rounded-3 d-none d-lg-block mx-2" style="background-color: #2e2e2e;color:#fff"
                    type="button"> <i class="fa-solid fa-user"></i> {{ Auth::guard('admin')->user()->name }}</button> --}}
                <a href="{{ route('almuhfazun.home') }}" target="_blank" class="btn text-white" style="background: #6f42c1">
                    <i class="fa-solid fa-gauge"></i> لوحة التحكم </a>
                <form action="{{ route('users.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger"><i
                            class="fa-solid fa-right-from-bracket"></i></button>
                </form>
            @endif


        </div>
    </nav>
    <div class="banner">
        <img src="{{asset('uploads/logo/'.$Setting->logo_big)}}" alt="">
    </div>

    @yield('content')

    <div id="items">
        <div class="container">
            <div class="row text-right">
                @foreach ($PageContainer as $page)
                    <div class="col-md-6 my-2">
                        <div class="item p-2">
                            {!! $page->icon !!}
                            <h5>
                                <a href="{{route('home.page',$page->id)}}" class="text-white" >{{ $page->name }}</a>
                            </h5>
                           <p>
                            {{ substr(strip_tags($page->content), 0, 101) }}...
                           </p>

                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </div>  

    <div class="containerMaps" style="background: #fff8e6">

   
   <div class="container">
    <div class="row">
        <div class="col-12 my-4" id="maps">
            <h3 class="text-center fw-bold" style="color:#605d56">الخريطة</h3>
            {!! $Setting->maps !!}
        </div>
       </div>
   </div>
</div>
    <div id="footerTop" class="text-center">
        <h2 style="color: #64511a;"> <i class="fa-solid fa-magnifying-glass-chart"></i> احصائيات المركز </h2>
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-md-3 item d-flex  flex-column justify-content-center">
                    <span class="text-primary">ذكور</span>
                    <hr />
                    <span class="text-danger">اناث</span>
                </div>
                <div class="col-md-3 item d-flex  flex-column justify-content-center">
                    <div>
                        <span class="badge bg-primary">
                            {{ \App\Models\Alhalaqat::where('type', 1)->count() }}
                        </span>
                        <hr style="margin: 5px 0" />
                        <span class="badge bg-danger">
                            {{ \App\Models\Alhalaqat::where('type', 0)->count() }}
                        </span>
                    </div>
                    <p class="mt-3">حلقة</p>
                </div>
                <div class="col-md-3 item">
                    <div>
                        <span class="badge bg-primary">
                            {{ \App\Models\User::where('gender', 1)->count() }}
                        </span>
                        <hr style="margin: 5px 0" />
                        <span class=" badge bg-danger">
                            {{ \App\Models\User::where('gender', 0)->count() }}
                        </span>
                    </div>
                    <p class="mt-3">محفظ</p>
                </div>
                <div class="col-md-3 item">
                    <div>
                        <span class="badge bg-primary">
                            {{ \App\Models\Talib::where('gender', 1)->count() }}
                        </span>
                        <hr style="margin: 5px 0" />
                        <span class=" badge bg-danger">
                            {{ \App\Models\Talib::where('gender', 0)->count() }}
                        </span>
                    </div>
                    <p class="mt-3">طالب</p>
                </div>

            </div>
        </div>
    </div>


    <div id="footerBottom">
        <div class="container text-center">
            <div class="row d-flex  justify-content-between ">
                <div class="col-md-4">
                    <p>جميع الحقوق محفوظة لشركة 
                        <a target="_blank" href="https://line-soft.com/">@linesoft</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <ul>
                        <a target="_blank" href="{{ $Setting->facebook_site }}"><i class="fa-brands fa-facebook"></i></a>
                        <a target="_blank" href="{{ $Setting->twitter_site }}"> <i class="fa-brands fa-twitter"></i></a>
                        <a target="_blank" href="{{ $Setting->youtube_site }}"><i class="fa-brands fa-youtube"></i></a>
                        <a target="_blank"href="{{ $Setting->whatsapp }}"><i class="fa-brands fa-whatsapp"></i></a>
                        <a target="_blank" href="{{ $Setting->instgram_site }}"><i class="fa-brands fa-instagram"></i></a>
                    </ul>
                </div>
              
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <script>
        var splide = new Splide('.splide', {
            type: 'loop',
            autoplay: 'true'
        });

        splide.mount();
    </script>

</body>

</html>
