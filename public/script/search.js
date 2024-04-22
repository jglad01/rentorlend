$(document).ready(function () {
    $('#car-search').on('keyup', function () {
        var search = $(this).val();

        $.ajax({
            type: "GET",
            url: "/otodom_clone/public/searchresult",
            data: { search: search },
            dataType: "html",
            success: function (response) {
                document.getElementById('search-container').innerHTML = response;
            }
        });
    })
})