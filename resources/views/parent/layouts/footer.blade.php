<footer class="footer"> <img width="150" src="dashboard/uploads/footer/171836577790325.jpg" alt=""> </footer>

<div class="navbar-bottom">
    <div> <a href="{{route("home.parent.home",$cid)}}" class="home {{Route::currentRouteName() == 'home.parent.home' ? 'active' : ''}}"> <i class="ri-home-5-fill"></i> الحلقات </a>
        <a href="{{route("home.parent.alaikhtibarat",$cid)}}"
        
        class="{{Route::currentRouteName() == 'home.parent.alaikhtibarat' ? 'active' : ''}}"> <i class="ri-list-check-3"></i>الاختبارات</a> 
 </div>
</div>
</div>
<script src="/front/assets/js/jquery.min.js"></script>
<script src="/front/assets/js/bootstrap.bundle.min.js"></script>
<script src="/front/assets/js/sweetalert2.min.js"></script>
<script src="/front/assets/js/jquery.dataTables.min.js"></script>
<script src="/front/assets/js/select2.min.js"></script> <!-- <script src="/front/assets/js/main/ajax.js"></script> -->
<script src="/front/assets/js/script2.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
</script>
@stack('js')
</body>

</html>
