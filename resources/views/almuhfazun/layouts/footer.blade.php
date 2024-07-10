<footer class="footer"> <img width="150" src="dashboard/uploads/footer/171836577790325.jpg" alt=""> </footer>

<div class="navbar-bottom">
    <div> <a href="index.php" class="home active"> <i class="ri-home-5-fill"></i> الحلقات </a>
        @if (auth()->user()->test == 1)
        <a href="tasks.php"
        class=" "> <i class="ri-list-check-3"></i>الاختبارات</a> 
        @endif
 </div>
</div>
</div>
<script src="/front/js/jquery.min.js"></script>
<script src="/front/js/bootstrap.bundle.min.js"></script>
<script src="/front/js/sweetalert2.min.js"></script>
<script src="/front/js/html2pdf.bundle.js"></script>
<script src="/front/js/jquery.dataTables.min.js"></script>
<script src="/front/js/select2.min.js"></script> <!-- <script src="/front/js/main/ajax.js"></script> -->
<script src="/front/js/script2.js"></script>
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
