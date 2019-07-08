$(document).ready(function() {
    $(".sentences").on("click", ".sentence", function() {
        $(".btn").removeClass("invisible").addClass("visible");
    });
    $(".books").on("click", ".bible-book", function() {
        $(".check-emotions").removeClass("invisible").addClass("visible");
    });
});