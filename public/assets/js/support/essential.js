function errorsMsgInput(s,e){$("."+s).parent().addClass("is-error"),$("."+s).removeClass("hidden"),$("."+s+"_message").text(e[0])}function errorMsgInput(s,e){$("."+s).parent().addClass("is-error"),$("."+s).removeClass("hidden"),$("."+s+"_message").text(e)}function successMsg(s){$(".notifications-popup-success").addClass("active"),$(".notifications-icon").html('<i class="fas fa-solid fa-check notifications-success"></i>'),$(".message-text").text(s),setTimeout((function(){$(".notifications-popup-success").removeClass("active")}),3e3),$(".notifications-close").click((function(){$(".notifications-popup-success").removeClass("active")}))}function errorMsg(s){$(".notifications-popup-error").addClass("active"),$(".notifications-icon").html('<i class="fas fa-times notifications-error"></i>'),$(".message-text").text(s),setTimeout((function(){$(".notifications-popup-error").removeClass("active")}),3e3),$(".notifications-close").click((function(){$(".notifications-popup-error").removeClass("active")}))}$(".form-textbox").on("keyup",(function(){$(this).next().addClass("hidden"),$(this).parent().removeClass("is-error")})),$(".file").on("change",(function(){$(this).next().next().addClass("hidden"),$(this).parent().removeClass("is-error")})),$(".select-textbox").on("change",(function(){$(this).next().addClass("hidden"),$(this).parent().removeClass("is-error")})),$(".button-submit").click((function(){$("#loading").show(),$(".loader").fadeIn(),$("#preloder").fadeIn("slow")}));