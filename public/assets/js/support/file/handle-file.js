FilePond.registerPlugin(FilePondPluginImagePreview);const inputElements=document.querySelectorAll("input.filepond");function deleteFile(e,t,r){confirm("Do you want to delete this file?")&&($(".loader-over").fadeIn(),$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},url:url_file_delete,type:"DELETE",data:{type:e,path:t,id:r},success:function(r){url_file_delete=url_file_delete.replace(t,":path"),$("."+e+"_section").addClass("hidden"),$("."+e).removeClass("hidden"),$(".loader-over").fadeOut(),successMsg(r.message)}}))}Array.from(inputElements).forEach((e=>{FilePond.create(e,{credits:!1,onaddfilestart:()=>{$(".button-submit").attr("disabled",!0)},onprocessfile:()=>{$(".button-submit").removeAttr("disabled")}}).setOptions({server:{headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},process:url_file_process,revert:url_file_revert}})}));