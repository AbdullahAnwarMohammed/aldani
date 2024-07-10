<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>وحدة تحكم || الداني</title>
    <meta name="msapplication-TileColor" content="#0054a6" />
    <meta name="theme-color" content="#0054a6" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <meta name="description"
        content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!" />
    <meta name="canonical" content="https://tabler.io/demo/layout-rtl.html">
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

    <!-- Datatables -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <link href="/dashboard/dist/css/tabler.rtl.min.css?1695847769" rel="stylesheet" />
    <link href="/dashboard/dist/css/tabler-vendors.rtl.min.css?1695847769" rel="stylesheet" />
    <link href="/dashboard/dist/css/demo.rtl.min.css?1695847769" rel="stylesheet" />
    @stack('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Changa:wght@200..800&display=swap');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
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

        .update-link,.details,.modal-link {
            cursor: pointer;
        }

        .update-link:hover,.details:hover,.modal-link:hover {
            background: #c3e6ff
        }
    </style>
</head>

<body>
    <div class="page">
        <!-- Navbar -->
        @include('admin.layouts.headerOne')
        @include('admin.layouts.headerTwo')

        <div class="page-wrapper">
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
