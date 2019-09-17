$(document).ready(function() {
    $(".sentences").on("click", ".sentence", function() {
        $(".btn").removeClass("invisible").addClass("visible");
    });
    $(".books").on("click", ".bible-book", function() {
        $(".check-emotions").removeClass("invisible").addClass("visible");
    });
    $(".emotions").on("click", function() {
        $(".emotion-list").addClass("hide");
    });
    $(".check-emotions").on("click", function() {
        $(".emotion-list").addClass("show");
    });
});