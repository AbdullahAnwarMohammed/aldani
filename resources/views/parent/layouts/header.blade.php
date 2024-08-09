<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" type="image/x-icon" href="/front/assets/images/icon.png">
    <title>حملة</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="/front/assets/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/front/assets/css/remixicon.css" rel="stylesheet">
    <link href="/front/assets/css/sweetalert2.min.css" rel="stylesheet" />
    <link href="/front/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/front/assets/css/select2.min.css" rel="stylesheet" />
    <link href="/front/assets/css/style.css" rel="stylesheet">
    <link href="/front/assets/css/responsive_min.css" rel="stylesheet"> <input type="hidden" class="id_event" value="3">
    <style>
        #block {
            width: 100%;
            height: 100vh;
            background-color: #3b324a;
            position: fixed;
            z-index: 9999999;
            top: 0;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            display: none;
        }
    </style>
   @stack('css')
</head>

<body>


    <div class="app">
        <div class="header" style="background: url({{asset('uploads/logo/'.$Setting->logo_big)}}) no-repeat  center;    background-size: cover;">
            <div class="appHeader ">          
            <div >
                <a href="{{route('home.index')}}" target="_blank">
                    <img style="border-radius: 10%;border:5px solid #e7c39b" src="/uploads/logo/{{$Setting->logo_small}}"  height="120" alt="">

                </a>
                {{-- <p class=" p-2 rounded-2 fw-bold" style="font-size:10px;background:#b76201;color:#fff1e1">
                    {{$Setting->email_site}} 
                   </p>  --}}
            </div>

            </div>
        </div>