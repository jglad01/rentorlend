$(document).ready(function () {
    setTimeout(() => $('#session-message').addClass('-translate-y-full'), 3000);

    $("button#menu-button").on("click", function () {
        $(this).parents("div#dropdown-wrapper").find("div#dropdown").toggleClass("hidden");
    })
});