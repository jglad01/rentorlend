$(document).ready(function () {
    var dateFormat = "mm/dd/yy",
        from = $("#date_from")
            .datepicker({
                defaultDate: "+1w",
                minDate: 0,
                changeMonth: true,
                numberOfMonths: 1,
            })
            .on("change", function () {
                to.datepicker("option", "minDate", getDate(this));
            }),
        to = $("#date_to").datepicker({
            defaultDate: "+1w",
            minDate: 0,
            changeMonth: true,
            numberOfMonths: 1
        })
            .on("change", function () {
                from.datepicker("option", "maxDate", getDate(this));
            });
});