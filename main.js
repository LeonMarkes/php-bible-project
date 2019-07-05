$(document).ready(function() {
    $(".sentences").on("click", ".sentence", function() {
        $(".btn").removeClass("invisible").addClass("visible");
    });
});