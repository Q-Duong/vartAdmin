$(document).ready((function(){$(".report_degree").on("change",(function(){"Sinh viên"==$(this).val()?($(".report-graduation-year").addClass("hidden"),$(".report-image-block").addClass("hidden"),$(".report-image-card-block").removeClass("hidden")):($(".report-image-card-block").addClass("hidden"),$(".report-image-block").removeClass("hidden"),$(".report-graduation-year").removeClass("hidden"))}))})),$("#file-abstract, #file-card, #file-image").change((function(){$(this).next().html('<i class="far fa-check-circle check-success"></i><p>'+$(this).val().split("\\").pop()+"</p>")})),$(".button-submit").on("click",(function(){var e=new FormData($("#report-form")[0]);$(".error").addClass("hidden"),$(".button-submit").attr("disabled",!0),$("#loading").show(),$.ajax({url:url_register_report_submit,method:"POST",data:e,processData:!1,contentType:!1,success:function(e){e.errors?($.each(e.validator,((e,a)=>{errorsMsgInput(e,a)})),$("#loading").delay(200).fadeOut("slow"),$(".button-submit").removeAttr("disabled")):window.location.assign("../../"+e.route)},complete:()=>$(".button-submit").removeAttr("disabled")})}));