$(document).ready(function () {
    //setTimeout(() => $('#session-message').addClass('-translate-y-full'), 3000);

    $("button#open-mobile-menu").on("click", function () {
        $(this).parents("nav").find("#mobile-menu").toggleClass("hidden");
    })
});