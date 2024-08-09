<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2024 The Tabler Authors
* Copyright 2018-2024 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <meta name="msapplication-TileColor" content="#066fd1" />
    <meta name="theme-color" content="#066fd1" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <meta name="description"
        content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!" />
    <meta name="canonical" content="https://tabler.io/demo/layout-vertical-right.html">
    <meta name="twitter:image:src" content="https://tabler.io/demo/static/og.png">
    <meta name="twitter:site" content="@tabler_ui">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title"
        content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta name="twitter:description"
        content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <meta property="og:image" content="https://tabler.io/demo/static/og.png">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="640">
    <meta property="og:site_name" content="Tabler">
    <meta property="og:type" content="object">
    <meta property="og:title"
        content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta property="og:url" content="https://tabler.io/demo/static/og.png">
    <meta property="og:description"
        content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <!-- CSS files -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="/dashboard/dist/css/tabler.min.css?1720208459" rel="stylesheet" />
    <link href="/dashboard/dist/css/tabler-flags.min.css?1720208459" rel="stylesheet" />
    <link href="/dashboard/dist/css/tabler-payments.min.css?1720208459" rel="stylesheet" />
    <link href="/dashboard/dist/css/tabler-vendors.min.css?1720208459" rel="stylesheet" />
    <link href="/dashboard/dist/css/demo.min.css?1720208459" rel="stylesheet" />
    @stack('css')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Changa:wght@200..800&display=swap');

        * {
            direction: rtl !important;
        }

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        a:hover {
            text-decoration: none
        }

        .table thead th {
            color: #efff00 !important;
            background: #1563bf;
            font-size: 13px;
        }

        body,
        a,
        button,
        input,
        span,
        textarea,
        label,
        select {
            font-family: "Changa", sans-serif !important;
        }

        .update-link,
        .details,
        .modal-link {
            cursor: pointer;
        }

        .update-link:hover,
        .details:hover,
        .modal-link:hover {
            background: #c3e6ff
        }

        select option:checked {
            background-color: #ff5656;
            /* Custom background color for selected option */
            margin: 5px 0;
            padding: 5px;
            border-radius: 5px;
            color: white;
            /* Custom text color for selected option */
        }

        .nav-item {
            padding: 3px 0;
            border-bottom: 1px solid #eee;
            transition: .5s ease-in-out
        }

        .nav-item:hover {
            background: #e7f2ff
        }

        .nav-item.active {
            background: #206bc4;
        }

        .nav-item.active a {
            color: #fff;
        }
    </style>
</head>

<body>
    <script src="/dashboard/dist/js/demo-theme.min.js?1720208459"></script>
    <div class="page">

        <!-- Sidebar -->
        @include('admin.layouts.aside')
        <div class="page-wrapper">
            <nav class="navbar navbar-expand-lg " style="background: #edf5ff">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="/uploads/logo/{{ $Setting->logo_big }}" width="220" class="img-thumbnail">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown" style="justify-content: left;">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="#">مرحباً :
                                    {{ auth()->guard('admin')->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="#"
                                    onclick="document.getElementById('logout').submit();"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout-2"
                                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="#000000" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                        <path d="M15 12h-12l3 -3" />
                                        <path d="M6 15l-3 -3" />
                                    </svg>
                                    خروج
                                </a>
                                <form action="{{ route('admin.logout') }}" id="logout" method="POST">
                                    @csrf
                                </form>
                            </li>


                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page header -->
            
            @yield('header')
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Datatables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>


    <script src="/dashboard/dist/js/tabler.min.js?1695847769"></script>
    <script src="/dashboard/dist/js/demo.min.js?1695847769"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".update-link").on("click", function(e) {
            e.preventDefault(); // Prevent defaeult action of the link
            var route = $(this).data('route'); // Get the route from data attribute
            // window.location.href = route; // Redirect to the route
            window.open(route, '_blank');
        })

        $(".details").on("click", function(e) {
            e.preventDefault(); // Prevent defaeult action of the link
            var route = $(this).data('route'); // Get the route from data attribute
            // window.location.href = route; // Redirect to the route
            window.open(route, '_blank');

        })
    </script>
    @stack('js')
</body>

</html>
