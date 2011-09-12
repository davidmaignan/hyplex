$(document).ready(function(){

    $('.search-box-list').toggle(function(){
        $(this).next('.flight-details-container').css('display', 'block');
    }, function(){
        $(this).next('.flight-details-container').css('display', 'none');
    });


});