$(function(){function e(e,t,s){let l=$(".idParent").val(),c=$(".idSupervisor").val(),u=$(".level").val(),v=$(e).data("iduser");$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"updateVoter",idParent:l,idUser:v,idSupervisor:c,rank:u},success:function(t){if("done"==(t=jQuery.trim(t))){if("name_only"===s)a("name_only");else if("aqarbNameOnly"===s){let l=$(".usernameSA").val();n(l)}else if("refreshopenlist"==s){let c=$(e).data("id");i(c)}else if("mychose"==s){let u=$("#changeChose").find(":selected").val(),v=$("#maleOrFemaleChose").find(":selected").val();"empty"!=u?r(u,v):r()}else"mandub"==s?d():"details"==s?o($(e).data("search")):a("name_family")}}})}function a(e=""){let a=$(".input_value_search").val(),t=$(".family_value_search").find(":selected").val(),n=$(".idParent").val(),i=$(".idUser").val(),r=$(".idEvent").val(),d=$(".idSupervisor").val(),s=$(".level").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"load_data_search",input:a,selected:t,idParent:n,idEvent:r,idSupervisor:d,idUser:i,type:e,rank:s},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){console.log(e),$(".loading").css("display","none"),$(".load_data_search").html(e),$("#table_search").dataTable({ordering:!1,pageLength:100,language:{sProcessing:"جارٍ التحميل...",sLengthMenu:" _MENU_ ",sZeroRecords:"لم يعثر على أية سجلات",sInfo:"إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",sInfoEmpty:"يعرض 0 إلى 0 من أصل 0 سجل",sInfoFiltered:"(منتقاة من مجموع _MAX_ مُدخل)",sInfoPostFix:"",sSearch:"ابحث:",sUrl:"",oPaginate:{sFirst:"الأول",sPrevious:"السابق",sNext:"التالي",sLast:"الأخير"}}});let a=$(".idUser").val(),t=$(".idSupervisor").val();a!=t&&$(".dt-buttons").remove()}})}function t(e,t,l,c){let u=$(".idFrontend").val(),v=$(".idSupervisor").val(),p=$(".level").val(),h=[],f=[],m=[];$(e).each(function(e){h.push($(this).data("username")),f.push($(this).data("userid")),m=$(this).data("idparent")}),$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"multiVote",type:t,names:h,idUsers:f,idParent:m,idFrontend:u,idSupervisor:v,rank:p},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){if(e=jQuery.trim(e),console.log(e),$(".loading").css("display","none"),$(".checkboxMulti ").prop("checked",!1),"done"==e){if("name_only"===c)a("name_only");else if("aqarbNameOnly"==c){let t=$(".usernameSA").val();n(t)}else if("mychose"==c){let u=$("#changeChose").find(":selected").val(),v=$("#maleOrFemaleChose").find(":selected").val();"all"==u?r():r(u,v)}else if("mandub"==c){let p=$("#changeChosemandub").find(":selected").val();"empty"==p?d():d(p)}else if("refreshopenlist"==c){let h=$(l).data("id");i(h)}else"details"==c?o(s,$(l).data("name")):a("name_family")}}})}function n(e){let a=$(".idParent").val(),t=$(".idEvent").val(),n=$(".idUser").val(),i=$(".idSupervisor").val(),r=$(".level").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"searchForAqarb",username:e,idParent:a,idEvent:t,idUser:n,idSupervisor:i,rank:r},success:function(e){"notfound"!=(e=jQuery.trim(e))?($(".load_data_search").html(e),$("#table_search").dataTable({ordering:!1,sProcessing:"جارٍ التحميل...",sLengthMenu:"_MENU_",sZeroRecords:"لم يعثر على أية سجلات",sInfo:"",sInfoEmpty:"يعرض 0 إلى 0 من أصل 0 سجل",sInfoFiltered:"",sInfoPostFix:"",sSearch:"",searchPlaceholder:"ابحث من هنا",sUrl:"",pageLength:100,language:{lengthMenu:"_MENU_",search:"",info:"",searchPlaceholder:"ابحث من هنا",paginate:{next:"التالي",previous:"السابق",first:"First page"}}})):$(".load_data_search").html(`
                    <div class="alert alert-danger">لا يوجد بيانات</div>
                    `);let a=$(".idUser").val(),t=$(".idSupervisor").val();a!=t&&$(".dt-buttons").remove()}})}function i(e){var a=$(".idFrontend").val(),t=$(".idParent").val(),n=$(".idEvent").val(),i=$(".level").val(),r=$(".idSupervisor").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"openlist",idList:e,idFrontend:a,idParent:t,idEvent:n,idSupervisor:r,rank:i},success:function(e){if("zero"==(e=jQuery.trim(e)))$(".load_data_search").html(`<div class='alert alert-warning py-4 my-4'>
                    <h4> <i class="ri-error-warning-fill"></i> فارغ </h4>
                    </div>`);else{$(".load_data_search").html(e),$("#table_search").dataTable({ordering:!1,pageLength:100,sProcessing:"جارٍ التحميل...",sLengthMenu:"_MENU_",sZeroRecords:"لم يعثر على أية سجلات",sInfo:"",sInfoEmpty:"يعرض 0 إلى 0 من أصل 0 سجل",sInfoFiltered:"",sInfoPostFix:"",sSearch:"",searchPlaceholder:"ابحث من هنا",sUrl:"",language:{lengthMenu:"_MENU_",search:"",info:"",searchPlaceholder:"ابحث من هنا",paginate:{next:"التالي",previous:"السابق",first:"First page"}}});let a=$(".idUser").val(),t=$(".idSupervisor").val();a!=t&&$(".dt-buttons").remove()}}})}function r(e="",a=""){var t=$(".idParent").val(),n=$(".idUser").val(),i=$(".idEvent").val(),r=$(".idSupervisor").val(),d=$(".level").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"mychose",idParent:t,idEvent:i,idSupervisor:r,idUser:n,change:e,maleOrFemale:a,rank:d},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){if($(".loading").css("display","none"),"zero"==(e=$.trim(e)))$(".load_data_search").html(`
                <div class="alert alert-warning py4">لا يوجد بيانات</div>
                `);else{$(".load_data_search").html(e),$("#table_search").DataTable({ordering:!1,pageLength:100,sProcessing:"جارٍ التحميل...",sLengthMenu:"_MENU_",sZeroRecords:"لم يعثر على أية سجلات",sInfo:"",sInfoEmpty:"يعرض 0 إلى 0 من أصل 0 سجل",sInfoFiltered:"",sInfoPostFix:"",sSearch:"",sUrl:"",language:{lengthMenu:"_MENU_",search:"",info:"",searchPlaceholder:"ابحث من هنا",paginate:{next:"التالي",previous:"السابق",first:"First page"}}});let a=$(".idUser").val(),t=$(".idSupervisor").val();a!=t&&$(".dt-buttons").remove()}}})}function d(e=""){var a=$(".idParent").val(),t=$(".idUser").val(),n=$(".idEvent").val(),i=$(".idSupervisor").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"mandub",idParent:a,idEvent:n,idSupervisor:i,idUser:t,change:e},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){if($(".loading").css("display","none"),"zero"==(e=$.trim(e)))$(".load_data_search").html(`
                <div class="alert alert-warning py4">لا يوجد بيانات</div>
                `);else{$(".load_data_search").html(e),$("#table_search").DataTable({ordering:!1,pageLength:100,sProcessing:"جارٍ التحميل...",sLengthMenu:"_MENU_",sZeroRecords:"لم يعثر على أية سجلات",sInfo:"",sInfoEmpty:"يعرض 0 إلى 0 من أصل 0 سجل",sInfoFiltered:"",sInfoPostFix:"",sSearch:"",sUrl:"",language:{lengthMenu:"_MENU_",search:"",info:"",searchPlaceholder:"ابحث من هنا",paginate:{next:"التالي",previous:"السابق",first:"First page"}}});let a=$(".idUser").val(),t=$(".idSupervisor").val();a!=t&&$(".dt-buttons").remove()}}})}$(document).on("click",".button_search",function(){let e=$(".input_value_search").val();"none"==$(".family_value_search").find(":selected").val()?a("name_only"):e.length>0?a("name_family"):a("family_only")}),$(document).on("click",".votemandub",function(){let a=$(this).data("page");if(e(this,"votemandub",a),$("#showVoters").hasClass("d-none")){var t=$(".getTableMadmen").DataTable();t.ajax.reload();let n=parseInt($(".paginate_button.current").data("dt-idx"));t.page(n).draw(!1)}else{var t=$(".myTable").DataTable();t.ajax.reload();let i=parseInt($(".paginate_button.current").data("dt-idx"));t.page(i).draw(!1)}}),$(document).on("click",".vote",function(){let a=$(this).data("page");e(this,"name_only",a);var t=$(".myTable").DataTable();t.ajax.reload();let n=parseInt($(".paginate_button.current").data("dt-idx"));t.page(n).draw(!1)}),$(document).on("click",".resetVote",function(){let e=$(this).data("page"),t,d;l=this,c=e,t=$(".idParent").val(),d=$(l).data("iduser"),$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"deleteVote",idParent:t,idUser:d},success:function(e){if(e=jQuery.trim(e),"name_only"===c)a("name_only");else if("aqarbNameOnly"===c){let t=$(".usernameSA").val();n(t)}else if("refreshopenlist"==c){let d=$(l).data("id");i(d)}else"mychose"==c?r():"details"==c?o(s,$(l).data("search")):a("name_family")}});var l,c,u=$(".myTable").DataTable();u.ajax.reload();let v=parseInt($(".paginate_button.current").data("dt-idx"));u.page(v).draw(!1)}),$(document).on("click",".btnMultiVote",function(){let e=$(".checkboxMulti:checkbox:checked"),a=$(".insertMulti").find(":selected").val();var n=$(".insertMulti").find(":selected").data("value");let i=$(this).data("page");if(e.length>0){if("insert"==a){t(e,"insert",this,i);var r=$(".myTable").DataTable();r.ajax.reload();let d=parseInt($(".paginate_button.current").data("dt-idx"));r.page(d).draw(!1)}else if("insertVote"==a){t(e,"insertVote",this,i);var r=$(".myTable").DataTable();r.ajax.reload();let s=parseInt($(".paginate_button.current").data("dt-idx"));r.page(s).draw(!1)}else if("insertlist"==a){var o=$("#userNow").val(),l=$(".idFrontend").val(),c=$(".idSupervisor").val(),u=[];$(e).each(function(e){u.push($(this).data("userid"))}),$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"insertSearchToList",idUser:u,idParent:o,idList:n,idFrontend:l,idSupervisor:c},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){e=jQuery.trim(e),$(".loading").css("display","none"),$(".checkboxMulti ").prop("checked",!1),"done"==e&&Swal.fire({title:"القائمة",text:"تم الاضافة بنجاح",icon:"success"})}})}else if("insert2"==a){t(e,"insertLevel2",this,i);var r=$(".myTable").DataTable();r.ajax.reload();let v=parseInt($(".paginate_button.current").data("dt-idx"));r.page(v).draw(!1)}else if("deleteFromList"==a){t(e,"deleteFromList",this,i);var r=$(".myTable").DataTable();r.ajax.reload();let p=parseInt($(".paginate_button.current").data("dt-idx"));r.page(p).draw(!1)}else if("NotPresent"==a){t(e,"NotPresent",this,i);var r=$(".myTable").DataTable();r.ajax.reload();let h=parseInt($(".paginate_button.current").data("dt-idx"));r.page(h).draw(!1)}else{t(e,"delete",this,i);var r=$(".myTable").DataTable();r.ajax.reload();let f=parseInt($(".paginate_button.current").data("dt-idx"));r.page(f).draw(!1)}}else Swal.fire({position:"top-center",icon:"error",title:"من فضلك حدد الاشخاص",showConfirmButton:!1,timer:1500})}),$(document).on("click",".searchForAqarb",function(){let e=$(this).data("username");n(e)}),$(".voteButtonMain").on("click",function(){if($("#showVoters").hasClass("d-none"))var e=$("#valueList2").find(":selected").val();else var e=$("#valueList").find(":selected").val();var a=$("#userNow").val(),t=$(".idFrontend").val(),n=$(".idSupervisor").val(),i=[],r=[];if($(".getVote:checkbox:checked").length>0){if("insertnameoflist"==e)$(".getVote:checkbox:checked").each(function(e){i.push($(this).data("id")),r.push($(this).next().val())}),$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"insertVoteMulti",idUsers:i,idParent:a,names:r,level:1,idFrontend:t,idSupervisor:n},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){if("done"==(e=jQuery.trim(e))){if($("#showVoters").hasClass("d-none")){var a=$(".getTableMadmen").DataTable();a.ajax.reload();let t=parseInt($(".paginate_button.current").data("dt-idx"));a.page(t).draw(!1)}else{var a=$(".myTable").DataTable();a.ajax.reload();let n=parseInt($(".paginate_button.current").data("dt-idx"));a.page(n).draw(!1)}$(".loading").css("display","none"),Swal.fire({title:"بنجاح",text:"تم بنجاح",icon:"success"}),u("madmen",".getNumberMadmen")}}});else if("presentmain"==e){if($(".getVote:checkbox:checked").length>0){var i=[],a=$(".idParent").val(),d=$(".level").val(),n=$(".idSupervisor").val();$(".getVote:checkbox:checked").each(function(e){i.push($(this).data("id"))}),$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"presetnmain",idUsers:i,idParent:a,rank:d,idSupervisor:n},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){if(e=jQuery.trim(e),$(".loading").css("display","none"),console.log(e),"done"==e){"done"==e&&Swal.fire({title:"بنجاح",text:"تم بنجاح",icon:"success"});var a=$(".myTable").DataTable();a.ajax.reload();let t=parseInt($(".paginate_button.current").data("dt-idx"));a.page(t).draw(!1),u("attend",".getNumberAttend")}}})}}else if("notpresentmain"==e){var i=[],a=$(".idParent").val(),d=$(".level").val(),n=$(".idSupervisor").val();$(".getVote:checkbox:checked").each(function(e){i.push($(this).data("id"))}),$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"notpresetnmain",idUser:i,idParent:a,rank:d,idSupervisor:n},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){if(e=jQuery.trim(e),$(".loading").css("display","none"),console.log(e),"done"==e){if($(".getVote").prop("checked",!1),$("#showVoters").hasClass("d-none")){var a=$(".getTableMadmen").DataTable();a.ajax.reload();let t=parseInt($(".paginate_button.current").data("dt-idx"));a.page(t).draw(!1)}else{var a=$(".myTable").DataTable();a.ajax.reload();let n=parseInt($(".paginate_button.current").data("dt-idx"));a.page(n).draw(!1)}u("attend",".getNumberAttend"),"done"==e&&Swal.fire({title:"بنجاح",text:"تم بنجاح",icon:"success"})}}})}else if("insert2"==e){var a=$("#userNow").val(),t=$(".idFrontend").val(),n=$(".idSupervisor").val(),e=$(".lists").data("value"),d=$(".level").val(),i=[],r=[];$(".getVote:checkbox:checked").each(function(e){i.push($(this).data("id")),r.push($(this).data("name"))}),$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"insertLevel2",names:r,idUsers:i,idParent:a,idFrontend:t,idSupervisor:n,rank:d},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){if(e=jQuery.trim(e),console.log(e),$(".loading").css("display","none"),"done"==e){if($("#showVoters").hasClass("d-none")){var a=$(".getTableMadmen").DataTable();a.ajax.reload();let t=parseInt($(".paginate_button.current").data("dt-idx"));a.page(t).draw(!1)}else{var a=$(".myTable").DataTable();a.ajax.reload();let n=parseInt($(".paginate_button.current").data("dt-idx"));a.page(n).draw(!1)}u("attend",".getNumberAttend"),u("madmen",".getNumberMadmen")}}})}else if("resetdata"==e){var i=[],a=$("#userNow").val(),n=$(".idSupervisor").val();$(".getVote:checkbox:checked").each(function(e){i.push($(this).data("id"))}),$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"deleteVoteMulti",idUser:i,idParent:a,idSupervisor:n},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){if(e=jQuery.trim(e),$(".loading").css("display","none"),$(".getVote").prop("checked",!1),console.log(e),"done"==e){if(Swal.fire({title:"حذف",text:"تح الحذف بنجاح",icon:"success"}),$("#showVoters").hasClass("d-none")){var a=$(".getTableMadmen").DataTable();a.ajax.reload();let t=parseInt($(".paginate_button.current").data("dt-idx"));a.page(t).draw(!1)}else{var a=$(".myTable").DataTable();a.ajax.reload();let n=parseInt($(".paginate_button.current").data("dt-idx"));a.page(n).draw(!1)}u("madmen",".getNumberMadmen")}}})}else{var a=$("#userNow").val(),t=$(".idFrontend").val(),n=$(".idSupervisor").val(),e=$("#valueList").find(":selected").val(),i=[];$(".getVote:checkbox:checked").length>0&&($(".getVote:checkbox:checked").each(function(e){i.push($(this).data("id"))}),$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"insertVoteList",idUser:i,idParent:a,idList:e,idFrontend:t,idSupervisor:n},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){e=jQuery.trim(e),console.log(e),$(".loading").css("display","none"),$(".getVote").prop("checked",!1),"done"==e&&Swal.fire({title:"اضافة للقائمة",text:"تح  بنجاح",icon:"success"})}}))}}else Swal.fire({position:"top-center",icon:"error",title:"من فضلك حدد الاشخاص",showConfirmButton:!1,timer:1500})}),$(document).on("click",".resVoteBackMandob",function(){let e=$(this).data("iduser"),a=$(".idParent").val(),t=$(".idSupervisor").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"resVoteBackMandob",idUser:e,idParent:a,idSupervisor:t},success:function(e){let a=$("#changeChosemandub").find(":selected").val();if("empty"!=a?d(a):d(),$("#showVoters").hasClass("d-none")){var t=$(".getTableMadmen").DataTable();t.ajax.reload();let n=parseInt($(".paginate_button.current").data("dt-idx"));t.page(n).draw(!1)}else{var t=$(".myTable").DataTable();t.ajax.reload();let i=parseInt($(".paginate_button.current").data("dt-idx"));t.page(i).draw(!1)}}})}),$(document).on("click",".resVoteBack",function(){let e=$(this).data("iduser"),a=$(".idParent").val(),t=$(".idSupervisor").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"resVoteBack",idUser:e,idParent:a,idSupervisor:t},success:function(e){let a=$("#changeChose").find(":selected").val();"empty"!=a?r(a):r();var t=$(".myTable").DataTable();t.ajax.reload();let n=parseInt($(".paginate_button.current").data("dt-idx"));t.page(n).draw(!1),u("attend",".getNumberMadmen")}})}),$(document).on("click",".resetVoteMainMandob",function(){let e=$(this).data("iduser"),a=$(".idParent").val(),t=$(".idSupervisor").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"resetVoteMandob",idUser:e,idParent:a,idSupervisor:t},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){$(".loading").css("display","none");var a=$(".myTable").DataTable();a.ajax.reload();let t=parseInt($(".paginate_button.current").data("dt-idx"));a.page(t).draw(!1)}})}),$(document).on("click",".resetVoteMain",function(){let e=$(this).data("iduser"),a=$(".idParent").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"resetVote",idUser:e,idParent:a},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){$(".loading").css("display","none");var a=$(".myTable").DataTable();a.ajax.reload();let t=parseInt($(".paginate_button.current").data("dt-idx"));if(a.page(t).draw(!1),u("madmen",".getNumberMadmen"),$("#showVoters").hasClass("d-none")){var a=$(".getTableMadmen").DataTable();a.ajax.reload();let n=parseInt($(".paginate_button.current").data("dt-idx"));a.page(n).draw(!1)}else{var a=$(".myTable").DataTable();a.ajax.reload();let i=parseInt($(".paginate_button.current").data("dt-idx"));a.page(i).draw(!1)}}})}),$(document).on("click",".voteLevel2MainPage",function(){let e=$(this).data("iduser"),a=$(this).data("idparent"),t=$(this).data("level");$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"updateVote",idUser:e,idParent:a,level:t},success:function(e){if("done"==(e=jQuery.trim(e))){var a=$(".myTable").DataTable();a.ajax.reload();let t=parseInt($(".paginate_button.current").data("dt-idx"));a.page(t).draw(!1)}}})}),$(document).on("submit","#createList",function(e){e.preventDefault(),""!=$("#nameList").val()?$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:$(this).serialize(),beforeSend:function(){$("#insert").val("Inserting")},success:function(e){e=jQuery.trim(e),console.log(e),"done"==e?(Swal.fire({position:"top-center",icon:"success",title:"تم انشاء القائمة بنجاح",showConfirmButton:!1,timer:1500}),setTimeout(function(){window.location.reload()},1e3)):Swal.fire({position:"top-center",icon:"error",title:"اسم القائمة موجود من قبل",showConfirmButton:!1,timer:1500})}}):Swal.fire({position:"top-center",icon:"error",title:"من فضلك ادخل اسم القائمة",showConfirmButton:!1,timer:1500})}),$(".itemlist").on("click",function(){let e=$(this).data("id");i(e)}),$(document).on("click",".updateLevelList",function(){let e=$(this).data("idlist"),a=$(this).data("id"),t=$(this).data("name");var n=$("#userNow").val(),r=$(".idFrontend").val(),d=$(".idSupervisor").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"updateVoteLevelOneByCircle",idUser:a,username:t,idParent:n,idFrontend:r,idSupervisor:d},beforeSend:function(){$(".loading").css("display","flex")},success:function(a){if($(".loading").css("display","none"),"done"==(a=jQuery.trim(a))){i(e);var t=$(".myTable").DataTable();t.ajax.reload();let n=parseInt($(".paginate_button.current").data("dt-idx"));t.page(n).draw(!1),u("madmen",".getNumberMadmen")}}})}),$(document).on("click",".mandub",function(){d()}),$(document).on("change","#changeChosemandub",function(){let e=$("#changeChosemandub").find(":selected").val();d(e)}),$(document).on("click",".mychose",function(){r()}),$(document).on("change","#changeChose",function(){let e=$("#changeChose").find(":selected").val(),a=$("#maleOrFemaleChose").find(":selected").val();r(e,a)}),$(document).on("change","#maleOrFemaleChose",function(){let e=$("#changeChose").find(":selected").val(),a=$("#maleOrFemaleChose").find(":selected").val();r(e,a)}),$(document).on("click",".details",function(){let e=$(this).data("id"),a=$(".idUser").val(),t=$(".idSupervisor").val(),n=$(".level").val(),i=$(".idEvent").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"details",idUser:e,idUserNow:a,idParent:$(".idParent").val(),idSupervisor:t,rank:n,idEvent:i},success:function(e){e=$.trim(e),$(".load_deta_details").html(e)}})});let s=1;function o(e="",a){let t=$(".idParent").val(),n=$(".idEvent").val(),i=$(".idSupervisor").val(),r=$(".idUser").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"search_degree",select_value:e,username:a,idParent:t,idEvent:n,idSupervisor:i,idUser:r},beforeSend:function(){$(".load_data_degree").html(`
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
            `)},success:function(e){$(".load_data_degree").html(e),$("#table_search_degree").dataTable({ordering:!1,pageLength:100,language:{lengthMenu:"_MENU_",search:"",info:"",searchPlaceholder:"ابحث من هنا",paginate:{next:"التالي",previous:"السابق",first:"First page"}}})}})}$(document).on("change",".select_degree",function(){s=$(this).val()}),$(document).on("click",".search_degree",function(){o(s,$(this).data("name"))}),$(document).on("click",".btndeletelist",function(e){e.stopPropagation(),$(".checkboxlist:checked").each(function(){let e=$(this).data("id");$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"deletelist",idList:e},success:function(e){location.reload()}})})});let l="",c="";function u(e,a){let t=$(".idSupervisor").val(),n=$(".idParent").val(),i=$(".level").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"getNumberMadmen",type:e,idSupervisor:t,idParent:n,rank:i},success:function(e){e=$.trim(e),$(a).html(e)}})}$(document).on("keyup",".newValeLjna",function(){l=$(this).val()}),$(document).on("keyup",".newValuePhone",function(){c=$(this).val()}),$(document).on("click",".changeDataDetails",function(){InputnewValeLjna=l,InputnewValuePhone=c,idUser=$(this).data("id"),$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"changeDataDetails",newValeLjna:InputnewValeLjna,newValuePhone:InputnewValuePhone,idUser:idUser},success:function(e){if("empty"==(e=$.trim(e)))Swal.fire({title:"خطأ",text:"من فضلك ادخل قيمة",icon:"error"});else{let a=$(".idUser").val(),t=$(".idSupervisor").val(),n=$(".level").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"details",idUser:idUser,idUserNow:a,idParent:$(".idParent").val(),idSupervisor:t,rank:n},success:function(e){e=$.trim(e),$(".load_deta_details").html(e),l="",c=""}})}}})}),u("attend",".getNumberAttend"),u("madmen",".getNumberMadmen"),$(document).on("click",".updateVoteLevelOne",function(){let e=$(this).data("id"),a=$(this).data("name");var t=$("#userNow").val(),n=$(".idFrontend").val(),i=$(".idSupervisor").val();$.ajax({url:"_supervisor/ajax_frontend.php",method:"POST",data:{action:"updateVoteLevelOneByCircle",idUser:e,username:a,idParent:t,idFrontend:n,idSupervisor:i},beforeSend:function(){$(".loading").css("display","flex")},success:function(e){if($(".loading").css("display","none"),"done"==(e=jQuery.trim(e))){var a=$(".myTable").DataTable();a.ajax.reload();let t=parseInt($(".paginate_button.current").data("dt-idx"));a.page(t).draw(!1),u("madmen",".getNumberMadmen")}}})})});