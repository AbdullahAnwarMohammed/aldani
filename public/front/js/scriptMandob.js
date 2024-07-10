function exportTableToCSV(){for(var e="\uFEFF",t=document.querySelector(".styleTable"),l=[],n=0;n<t.rows[0].cells.length;n++)l.push('"'+t.rows[0].cells[n].innerText+'"');e+=l.join(",")+"\n";for(var n=1;n<t.rows.length;n++){for(var i=[],a=0;a<t.rows[n].cells.length;a++)i.push('"'+t.rows[n].cells[a].innerText+'"');e+=i.join(",")+"\n"}var r=new Blob([e],{type:"text/csv;charset=utf-8;"}),o=document.createElement("a");o.href=URL.createObjectURL(r),o.download="exported_data.csv",document.body.appendChild(o),o.click(),document.body.removeChild(o)}function hideInPrintPdf(){let e=document.querySelectorAll("table tr td:nth-child(1)"),t=document.querySelectorAll("table tr td:nth-child(4)"),l=document.querySelectorAll("table tr td:nth-child(3)");l.forEach(e=>{e.style.visibility="hidden"}),e.forEach(e=>{e.style.visibility="hidden"}),t.forEach(e=>{e.style.visibility="hidden"});let n=document.querySelectorAll(".hidePdf");n.forEach(e=>{e.style.visibility="hidden"}),document.querySelector("#changeChose")&&(document.querySelector("#changeChose").style.display="none"),document.querySelector("#table_search_paginate").style.display="none",document.querySelector("#table_search_filter").style.display="none",document.querySelector("#table_search_length").style.display="none",document.querySelector(".appBtnPrint").style.display="none",document.querySelector("#table_search_info").style.display="none",document.querySelector(".insertMulti").style.visibility="hidden"}function showAfterPrintPdf(){let e=document.querySelectorAll("table tr td:nth-child(1)"),t=document.querySelectorAll("table tr td:nth-child(3)"),l=document.querySelectorAll("table tr td:nth-child(4)"),n=document.querySelectorAll(".hidePdf");n.forEach(e=>{e.style.visibility="visible"}),e.forEach(e=>{e.style.visibility="visible"}),l.forEach(e=>{e.style.visibility="visible"}),t.forEach(e=>{e.style.visibility="visible"}),document.querySelector("#changeChose")&&(document.querySelector("#changeChose").style.display="inline-block"),document.querySelector("#table_search_paginate").style.display="inline-block",document.querySelector("#table_search_filter").style.display="inline-block",document.querySelector("#table_search_length").style.display="inline-block",document.querySelector(".appBtnPrint").style.display="inline-block",document.querySelector("#table_search_info").style.display="inline-block",document.querySelector(".insertMulti").style.visibility="visible"}function generatePDF(){var e=document.querySelector(".parents");hideInPrintPdf(),html2pdf(e,{margin:0,filename:"table.pdf",image:{type:"jpeg",quality:.98},html2canvas:{scale:2},jsPDF:{unit:"mm",format:"a4",orientation:"portrait"}}).then(function(e){showAfterPrintPdf()}).catch(function(e){console.error("Error generating PDF:",e)})}function printTable(e){var t,l=window.open("","_blank"),n=document.querySelector(".styleTable").outerHTML,i=`<html> <title>Printable Table</title><head>
     <style>
     @import url('https://fonts.googleapis.com/css2?family=El+Messiri&display=swap');

     body { 
        font-family: 'El Messiri', sans-serif;

        margin: 20px;
        direction:rtl;
    }
      table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
       th, td { border: 1px solid #dddddd; text-align: right; font-size:9px }
        th { background-color: #f2f2f2; }
        table input[type='checkbox']{
            display:none;
        }
        a{
            text-decoration:none;
        }
        table tr td:nth-child(1),
        table tr th:nth-child(1),
        table tr td:nth-child(3),
        table tr th:nth-child(3),
        table tr td:nth-child(4),
        table tr th:nth-child(4)
        {
            display:none;
        }
     </style><html> <title>Printable Table</title><head></head><body>
     صفحة ${e}<html> <title>Printable Table</title><head></head><body>
     صفحة 
     ${n}
     </body></html>`;l.document.body.innerHTML=i,l.print(),window.matchMedia("print").matches||l.close()}$(function(){function e(e="all",t="all",l="all"){$(".myTable").DataTable({bAutoWidth:!1,info:!1,columnDefs:[{orderable:!1,targets:0}],order:[[1,"asc"]],bDestroy:!0,responsive:!0,pageLength:100,initComplete:function(e,t){$("#getNumber").html(""),$(".dataTables_info").appendTo("#getNumber")},language:{sProcessing:"جارٍ التحميل...",sLengthMenu:" _MENU_ ",sZeroRecords:"لم يعثر على أية سجلات",sInfo:"_TOTAL_ ",sInfoEmpty:"0",sInfoFiltered:"",sInfoPostFix:"",sSearch:"",searchPlaceholder:"ابحث من هنا",sUrl:"",oPaginate:{sFirst:"الأول",sPrevious:"السابق",sNext:"التالي",sLast:"الأخير"}},processing:!0,serverSide:!0,ajax:{url:"load_data_mandob.php",type:"POST",data:{nameEvent:$(".nameEvent").val(),idEVENT:$(".idEvent").val(),idParent:$(".idParent").val(),idSupervisor:$(".idSupervisor").val(),rank:$(".level").val(),mainMaleOrFemale:e,mandubLgna:t,selectAttendOr:l}},drawCallback:function(e){var t=e.json;$(".getNumberAttend").html(t.attend),$(".countAllMademn").html(t.recordsFiltered)}})}$(document).on("click",".btn-print-csv",()=>{exportTableToCSV()}),$(document).on("click",".btn-print-pdf",()=>{generatePDF()}),$(document).on("click",".print",()=>{printTable($(".print").data("pagename"))}),$(".family_value_search ").select2(),$(".openDropdown").on("click",function(){$(this).siblings(".dropdown").slideToggle()}),$(".colors span").on("click",function(){let e=$(this).css("background-color");$(".search h2").css("background",e),$(".createListNames h3").css("background",e),$("#timer span ").css("color",e)});let t=$("#mainMaleOrFemale").find(":selected").val(),l=$("#mandubLgna").find(":selected").val(),n=$("#selectAttendOr").find(":selected").val();e(t,l,n),$(document).on("change","#mainMaleOrFemale",function(){let t=$("#mainMaleOrFemale").find(":selected").val(),l=$("#mandubLgna").find(":selected").val(),n=$("#selectAttendOr").find(":selected").val();e(t,l,n)}),$(document).on("change","#mandubLgna",function(){let t=$("#mandubLgna").find(":selected").val(),l=$("#mainMaleOrFemale").find(":selected").val(),n=$("#selectAttendOr").find(":selected").val();e(l,t,n)}),$(document).on("change","#selectAttendOr",function(){let t=$("#mandubLgna").find(":selected").val(),l=$("#mainMaleOrFemale").find(":selected").val(),n=$("#selectAttendOr").find(":selected").val();e(l,t,n)});var i=new Date($(".expireDate").val()).getTime(),a=setInterval(function(){$("#timer").css("display","flex");var e=new Date().getTime(),t=i-e;$("#timer .day").html(Math.floor(t/864e5)+"يوم"),$("#timer .hour").html(Math.floor(t%864e5/36e5)+"ساعة"),$("#timer .minute").html(Math.floor(t%36e5/6e4)+"دقيقة"),$("#timer .second").html(Math.floor(t%6e4/1e3)+"ثانية"),t<0&&(clearInterval(a),$(".d-textitme").hide(),$("#timer .day").html("صفر"),$("#timer .hour").html("صفر"),$("#timer .minute").html("صفر"),$("#timer .second").html("صفر"))},1e3);function r(){let e=$(".idUser").val(),t=$(".idSupervisor").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"get_single_count",idUser:e,idSupervisor:t},success:function(e){$(".get_count").html(e)}})}function o(){let e=$(".idUser").val(),t=$(".idSupervisor").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"get_all_counts",idUser:e,idSupervisor:t},success:function(e){$(".all_counts").html(e),"0"==(e=$.trim(e))&&$(".get_count").html("0")}})}$(document).on("click",".details_name_of_item",function(){$(".btn-close").click()}),$(document).on("click",".btn-search-qarib",function(){$(".btn-close-searchuser").click()}),$(".family_value_search").on("change",function(){"none"!=$(this).find(":selected").val()?$(".button_search").removeClass("disabled"):$(".button_search").addClass("disabled")}),$(".input_value_search").on("keyup",function(){0!=$(this).val().length?$(".button_search").removeClass("disabled"):"none"==$(".family_value_search").find(":selected").val()&&$(".button_search").addClass("disabled")}),$(document).on("click",".btn_load_data",function(){$("#itemList").hide(),$("#itemList").find(".btn-close").click()}),$(document).on("click",".checkboxlist",function(e){$(".checkboxlist:checkbox:checked").length>0?$(".btndeletelist").fadeIn():$(".btndeletelist").fadeOut()}),$(document).on("click",".checkall",function(){let e=$(this).data("target");$(e).prop("checked",$(this).prop("checked"))}),r(),o(),$(".all_counts").on("click",function(){o()}),$(".increment_btn").on("click",function(){let e,t;e=$(".idUser").val(),t=$(".idSupervisor").val(),$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"increment_counts",idUser:e,idSupervisor:t},success:function(e){r(),o()}})}),$(".decrement_btn").on("click",function(){let e,t;e=$(".idUser").val(),t=$(".idSupervisor").val(),$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"decrement_counts",idUser:e,idSupervisor:t},success:function(e){r(),o()}})})});