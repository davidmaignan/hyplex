$('document').ready(function(){

    var dates = $('#search_package_depart_date, #search_package_return_date').datepicker({
        minDate: 0,
        dateFormat: "yy-mm-dd",
        defaultDate: "+1w",
        changeMonth: false,
        numberOfMonths: 2,
        onSelect: function(selectedDate) {
            var option = this.id == "search_car_pickup_date" ? "minDate" : "maxDate";
            var instance = $(this).data("datepicker");
            var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
            dates.not(this).datepicker("option", option, date);
        }
    });

    $( "#search_package_origin" ).autocomplete({
        autoFocus: true,
        source: function( request, response ) {
                $.ajax({
                        url: autoCompleteURL,
                        dataType: "json",
                        delay: 0,
                        data: {
                                featureClass: "P",
                                style: "full",
                                maxRows: 12,
                                name_startsWith: request.term
                        },
                        success: function( data ) {
                                response( $.map( data.results, function( item ) {

                                        var value = data.values[0];
                                        //$('#log2').append(value);

                                        var string = item.t_name+', '+ item.a_airport + ', '+ item.u_country +' ('+ item.a_code +')';
                                        string = highlight2(string, request.term);


                                        return {
                                                label: string,
                                                value: item.t_name+', '+ item.a_airport + ', '+ item.u_country +' ('+ item.a_code +')'
                                        }
                                }));
                        }
                });
        },
        minLength: 2,
        select: function( event, ui ) {
                //log( ui.item ?
                 //       "Selected: " + ui.item.label :
                 //       "Nothing selected, input was " + this.value);
        },
        open: function() {
                $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
        },
        close: function() {
                $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
        }
    }).data('autocomplete')._renderItem = function( ul, item ) {
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( '<a>' + item.label + '</a>' )
            .appendTo( ul );
    };


    $( "#search_package_destination" ).autocomplete({
        autoFocus: true,
        source: function( request, response ) {
                $.ajax({
                        url: autoCompleteURL,
                        dataType: "json",
                        delay: 0,
                        data: {
                                featureClass: "P",
                                style: "full",
                                maxRows: 12,
                                name_startsWith: request.term
                        },
                        success: function( data ) {
                                response( $.map( data.results, function( item ) {

                                        var value = data.values[0];
                                        //$('#log2').append(value);

                                        var string = item.t_name+', '+ item.a_airport + ', '+ item.u_country +' ('+ item.a_code +')';
                                        string = highlight2(string, request.term);

                                        return {
                                                label: string,
                                                value: item.t_name+', '+ item.a_airport + ', '+ item.u_country +' ('+ item.a_code +')'
                                        }
                                }));
                        }
                });
        },
        minLength: 2,
        select: function( event, ui ) {
                //log( ui.item ?
                 //       "Selected: " + ui.item.label :
                 //       "Nothing selected, input was " + this.value);
        },
        open: function() {
                $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
        },
        close: function() {
                $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
        }
    }).data('autocomplete')._renderItem = function( ul, item ) {
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( '<a>' + item.label + '</a>' )
            .appendTo( ul );
    };

});

