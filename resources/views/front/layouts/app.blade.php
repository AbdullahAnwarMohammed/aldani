<!doctype html>
<html lang="ar">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta property="og:site_name" content="Maqraa">
    <meta name="twitter:site" content="@Maqraa">
    <meta property="og:url" content="https://ahlelquran.net/ar">
    <link rel="canonical" href="https://ahlelquran.net/ar">
    <meta id="token" name="csrf-token" content="MTf5PI5obMFfpX1aWkPZwr6oS0NTTZqsfQ6EgYo6">
    <meta id="locale" name="locale" content="ar">
    <meta name="title" content="home" />
    <meta name="description" content="home" />
    <title>منصة الداني</title>
    <link rel="icon" href="https://ahlelquran.net/assets/images/logo/fav.png" type="image/x-icon">
    <!-- styles CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/front/css/main-style.css">
    <link media="all" type="text/css" rel="stylesheet" href="/front/css/ahlquran.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap');

        body,
        h1,
        h2,
        h3,h4,h5 {
            font-family: "Almarai", sans-serif !important;
        }
    </style>
    @stack('css')

</head>



<body class="rtl-mode default-theme">
    <section id="wrapper">
        <div id="notifications">
            <header class="main-header">
                <div class="container">
                 @include('front.layouts.navbar')
                    <div class="header-caption">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <h1>أكبر تجمع قرآني على شبكة الإنترنت يجمع بين الطلاب ومعلمي القرآن حول العالم </h1>
                                <p> يستطيع الطالب اختيار المعلم المناسب له والإنضمام إلى حلقاته كما يستطيع معلم القران
                                    فتح حلقاته القرآنية بنفسه ليجتمع فيها مع طلابه </p>
                                <a href="#register-as" class="btn btn-warning shadow-lg">اشترك الآن </a>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="header-video">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/uV8Hogo9dCg"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="mobile-header">
                <div class="content">
                    <div class="mob-menu">
                        <a data-toggle="modal" data-target="#sideModal" class="btn"><i class="fas fa-bars"></i> </a>
                    </div>
                    <div class="space"> </div>
                    <div class="mob-logo">
                        <a href="https://ahlelquran.net/ar">
                            <img src="https://ahlelquran.net/assets/images/logo/white-logo.png"
                                class="img-fluid mx-auto" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
        <footer class="main-footer ">
            <div class="top-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-4 col-sm-12">
                            <div class="about text-center">
                                <img src="https://ahlelquran.net/assets/images/logo/footer-logo-2.png"
                                    class="img-responsive align-center" alt="logo">
                                <p>أكبر تجمع قرآني على شبكة الإنترنت يجمع بين الطلاب ومعلمي القرآن حول العالم</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="footer-links">
                                <ul class="list-unstyled no-margin">
                                    <li><a href="https://support.utrujja.com/ar/category-list/ahl-quran"> الدعم
                                            الفنى</a></li>

                                    <li><a href="https://ahlelquran.net/ar/join-as-instructor"> انضم كمعلم</a></li>
                                    <li><a href="https://ahlelquran.net/ar/auth/register"> انضم كمتعلم</a></li>

                                    <li><a href="https://ahlelquran.net/ar/privacy-policy"> سياسية الخصوصية</a></li>
                                    <li><a href="https://ahlelquran.net/ar/terms-conditions"> الشروط والأحكام</a></li>
                                    <li> <a href="#home-contact-us">اتصل بنا</a>
                                    </li>




                                </ul>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="mail-list">
                                <h6> يمكنك متابعة كل جديد بالموقع بالاشتراك فى القائمة البريدية</h6>
                                <form action="https://ahlelquran.net/ar/maillist/add/1" id="form" method="post"
                                    role="search" data-parsley-validate>
                                    <input type="hidden" name="_token" value="MTf5PI5obMFfpX1aWkPZwr6oS0NTTZqsfQ6EgYo6">
                                    <div class="form-group ">
                                        <input name="email" id="email" type="email" class="form-control"
                                            placeholder="ادخل بريدك الالكتروني" required data-parsley-trigger='change'
                                            data-parsley-required-message="أدخل بريدك الإلكتروني"
                                            data-parsley-email-message="يجب عليك إدخال بريد إلكتروني صحيح"
                                            data-parsley-errors-container="#parsly_error">

                                        <button class="btn btn-block btn-info"><i
                                                class="fas fa-paper-plane"></i></button>
                                    </div>
                                </form>


                            </div>





                            <a href="https://utrujja.com" target="_blank">
                                <div class="media">
                                    <div class="media-body text-center">
                                        <img src="https://ahlelquran.net/assets/images/logo/white-logo2.png" alt="">
                                        <p> تم التطوير بإستخدام نظام الأترجة لبناء المنصات التعليمية </p>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
            <div class="bottom-footer">
                <div class="container">
                    <div class="footer-content">
                        <div class="social-icons">
                            <h5 style="display:none">تابعنا</h5>
                            <div class="social">
                                <a href="https://www.youtube.com/watch?v=uV8Hogo9dCg" target="_blank"><img
                                        src="https://ahlelquran.net/themes/midade/frontend/utrujja/assets/images/youtube-icon.svg"
                                        alt="icon"></a>




                            </div>

                        </div>

                        <div class="bottom-links">

                        </div>
                        <div class="copyrights">
                            <p> جميع الحقوق محفوظة &copy; <a href="https://midade.com/" target="_blank">midade.com</a>
                                <span>2024</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>



    </section>
    <script src="/front/js/app.js" type="text/javascript"></script>
    <script src="/front/js/main-scripts.js" type="text/javascript"></script>




</body>

<style>
    .MomMove {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 40px;
        line-height: 39px;
        z-index: 999999
    }

    @media screen and (max-width:480px) {
        .MomMove {
            line-height: 18px;
        }
    }

    .ribbon-badge {
        position: fixed;
        top: 150px;
        left: -70px;
        background: #ffc107;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        z-index: 999;
        -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        transform: rotate(270deg);
    }

    .ribbon-badge span {
        color: #000;
    }

    .ribbon-badge span i {
        margin-left: 5px;
    }

    @media screen and (max-width:991px) {
        .ribbon-badge {
            top: 200px
        }
    }
</style>

@stack('js')

</html>