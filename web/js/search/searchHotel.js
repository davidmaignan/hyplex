/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



$('document').ready(function(){

    var rooms = $('.room-container').length+1;    

    var dates = $('#search_hotel_checkin_date, #search_hotel_checkout_date').datepicker({
        minDate: 0,
        dateFormat: "yy-mm-dd",
        defaultDate: "+1w",
        changeMonth: false,
        numberOfMonths: 2,
        onSelect: function(selectedDate) {
            var option = this.id == "search_hotel_checkin_date" ? "minDate" : "maxDate";
            var instance = $(this).data("datepicker");
            var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
            dates.not(this).datepicker("option", option, date);
        }
    });
    

    $('.matches').click(function(){
        var value = $(this).attr('innerHTML');
        var target = '#search_hotel_wherebox';
        $(target).val(value);
        return false;
    });

    $("#search_hotel_wherebox").autocomplete(airports, {
        minChars: 0,
        width: 300,
        matchContains: "word",
        autoFill: false,
        formatItem: function(row, i, max) {
            return formatAirportString(row);
        },
        formatMatch: function(row, i, max) {
            return formatAirportString(row);
        },
        formatResult: function(row) {
            return formatAirportString(row);
        }
    });

});

