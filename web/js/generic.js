$('document').ready(function(){
    
    
    $('input[type=submit], a.button, a.add, a.select').click(function(){
         $( "#dialog-message" ).dialog({
            modal: true,
            buttons: {
                Cancel: function() {
                    $( this ).dialog( "close" );
                    //Cancel the request sent
                    //ajaxRequest.abort();
                }
            }
        });
    });


    $('#language').hover(function(){
        $('#language .hide').show();
    }, function(){
        $('#language .hide').hide();
                
    });

    $('#currency').hover(function(){
        $('#currency li.hide').show();
    }, function(){
        $('#currency li.hide').hide();
    });


});
