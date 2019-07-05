$(document).ready(function() {
    $(".sentences").on("click", ".sentence", function() {
        $(".btn").removeClass("button-invisible").addClass("button-visible");
    });
});