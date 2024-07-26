$(document).ready(function () {
    var dates;
    let carID = $('form#reservation-form').attr('data-car-id');

    $.ajax({
        type: "GET",
        url: "/public/getblockeddays",
        data: { carid: carID },
        dataType: "json",
        success: function (response) {
            dates = response;
        }
    });

    var dateFormat = "mm/dd/yy",
        from = $("#date_start")
            .datepicker({
                defaultDate: "+1w",
                minDate: 0,
                changeMonth: true,
                numberOfMonths: 1,
                beforeShowDay: function (d) {
                    return checkDateAvailability(d, dates);
                }
            })
            .on("change", function () {
                to.datepicker("option", "minDate", getDate(this));
            }),
        to = $("#date_end").datepicker({
            defaultDate: "+1w",
            minDate: 0,
            changeMonth: true,
            numberOfMonths: 1
        })
            .on("change", function () {
                from.datepicker("option", "maxDate", getDate(this));
            });

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }

    function checkDateAvailability(day, dates) {
        const options = { year: 'numeric', month: '2-digit', day: '2-digit' }
        if (dates.includes(day.toLocaleDateString("en-US", options))) {
            return [false, 'unavailable'];
        }
        else {
            return [true, 'available'];
        }
    }
});