const inputElements = document.querySelectorAll("input.filepond");
Array.from(inputElements).forEach((inputElement) => {
    const pond = FilePond.create(inputElement, {
        credits: false,
    });
    pond.setOptions({
        server: {
            url: url_upload,
            headers: csrf,
        },
    });
});
function deleteFile(e, p, id) {
    url_delete = url_delete.replace(":path", p);
    if (confirm("Do you want to delete this file?")) {
        $(".loader").fadeIn();
        $("#preloder").fadeIn("slow");
        $.ajax({
            url: url_delete,
            type: "DELETE",
            headers: csrf,
            data: {
                type: e,
                path: p,
                id: id,
            },
            success: function (data) {
                url_delete = url_delete.replace(p, ":path");
                $("." + e + "_section").addClass("hidden");
                $("." + e).removeClass("hidden");
                $(".loader").fadeOut();
                $("#preloder").fadeOut("slow");
                successMsg(data.message);
            },
        });
    }
}
