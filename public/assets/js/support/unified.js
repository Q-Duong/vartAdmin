$(document).ready((function(){$("#pagination-input").on("input",(function(){var e=$(this).val();$(this).val(e.replace(/[^0-9]/g,""))})),$("#pagination-input").keypress((function(e){var a=$(this).val(),n=window.location.href;13===e.which&&""!=a&&a<=lastPage&&(1==a?n=n.replace(/(\?page=)[^\&]+/,""):-1!==n.indexOf("?page=")?n=n.replace(/(\?page=)[^\&]+/,"$1"+a):n+=(-1!==n.indexOf("?")?"&":"?")+"page="+a,location.replace(n))})),$(".pagination-ctrl__btn--previous").click((function(e){2==currentPage&&(e.preventDefault(),location.replace(window.location.href.replace(/(\?page=)[^\&]+/,"")))}))}));