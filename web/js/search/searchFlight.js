/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var targetInfos;

$(document).ready(function(){
    

    $('#search-more-options').toggle(function(){
        $('#form-details').show();
    }, function(){
        $('#form-details').hide();
    });

    var dates = $('#search_flight_depart_date, #search_flight_return_date').datepicker({
        minDate: 0,
        dateFormat: "yy-mm-dd",
        defaultDate: "+1w",
        changeMonth: false,
        numberOfMonths: 2,
        onSelect: function(selectedDate) {
            var option = this.id == "search_flight_depart_date" ? "minDate" : "maxDate";
            var instance = $(this).data("datepicker");
            var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
            dates.not(this).datepicker("option", option, date);
        }
    });
    /*
    $("#search_flight_origin").focus().autocomplete(airports, {
        minChars: 2,
        width: 300,
        matchContains: true,
        autoFill: false,
        highlight: function(value, search){

            //value =
            return highlight2(value, search);
            //return value + ':'+highlight2(value, search);

            //var replace = "<span style='font-weight:bold;color:#ED145B;'>" + search + "</span>";
            //value = value.replace(/search/i, replace);

            //var search2 = ucwords(search);
            //var replace2 = "<span style='font-weight:bold;color:#ED145B;'>" + search2 + "</span>";
            
            //value = value.replace(search2, replace2);

            //return value + ':'+replace+':'+ search2;

            //var result = value.replace(/search/)

            //return value.replace(/search/i,"<span style='font-weight:bold;color:green;'>" + "$&" + "</span>");
        },
        formatItem: function(row, i, max) {
            return formatAirportString(row);
        },
        formatMatch: function(row, i, max) {
            return formatAirportStringNoComma(row);
        },
        formatResult: function(row) {
            return formatAirportString(row);
        }
    });
    */

    $("#search_flight_destination, #search_flight_origin").autocomplete(airports, {
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

    

    $(".multidestination-popup").click(function(){
        //Get the number
        //alert('multidestination popup');
        targetInfos = $(this).attr('id').split('-');
        //alert(targetInfos);
    });

    

    $(".multidestination-popup").fancybox({
            'width'		: 700,
            'height'		: 400,
            'autoScale'     	: false,
            'centerOnScroll'        : true,
            'transitionIn'		: 'none',
            'transitionOut'		: 'none',
            'type'			: 'iframe'
        });

    //ADS.log.header('Debug session');

    $('.child_number').change(function(){
        //ADS.log.write(this.value);
        //var roomNumber = 1; //$(this).parent().parent().parent().parent().attr('id');
        //var cible = $('#children_age_subcontainer');
        //var cible2 = $('#children_age_container').removeClass('cache')
        //var cible2 = $(this).parent().parent().next().children().first();
        //cible.empty();

        
        if(this.value != 0){
            $('#child-info-flight').removeClass('cache');
            for(var i=1;i<=6;i++){
                $('#child-'+i).addClass('cache');
            }

            for(var i=1;i<=this.value;i++){
                $('#child-'+i).removeClass('cache');
            }
            $('#child-1').removeClass('cache');
        }else{
            $('#child-info-flight').addClass('cache');
            for(var i=1;i<=6;i++){
                $('#child-'+i).addClass('cache');
            }
        }
    });

    var nbrChildActive = $('.child_number').val();
    //ADS.log.write(nbrChildActive);

    for(var i=1;i<=nbrChildActive;i++){
        $('#child-info-flight').removeClass('cache');
        $('#child-'+i).removeClass('cache');
    }

    //Remove data from return date to avoid validation pb for oneway ticket
    $('#search_flight_oneway_1').click(function(){
        $('#search_flight_return_date').val('');
        $('.return-date').css('display','none');
        $('.return-time').css('display','none');
    });

    $('#search_flight_oneway_0').click(function(){
        $('#search_flight_return_date').val('');
        $('.return-date').css('display','block');
        $('.return-time').css('display','block');
    });

    //ADS.log.write($('#search_flight_oneway_1').attr('checked'));

    if($('#search_flight_oneway_1').attr('checked') == true){
        $('.return-date').css('display','none');
        $('.return-time').css('display','none');
    }


    //Rules to add the matches to the input field origin and destination

    $('documtent').ready(function(){

        $('.matches').click(function(){

            var value = $(this).attr('innerHTML');

            if($(this).hasClass('origin') == true){
                var target = '#search_flight_origin';
            }else{
                var target = '#search_flight_destination';
            }

            $(target).val(value);

            //alert(target);
            return false;

            //alert('here');
        });
        
    });

});


