import "./bootstrap";
import jQuery from "jquery";
window.$ = jQuery;

$("#addBookButton").on("click", function () {
    var csrfToken = $("input[name=_token]").val();
    var form = document.getElementById("addBookForm");
    var formData = new FormData(form);

    $.ajax({
        url: "/addBook",
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log("Book added successfully:", response);
            //window.location = "/books";
        },
        error: function (error) {
            console.error("Failed to add book:", error);
            $.each(error.responseJSON.errors, function (key, value) {
                $("#" + key)
                    .next()
                    .html(value[0]);
                $("#" + key)
                    .next()
                    .removeClass("d-none");
            });
        },
    });
});
