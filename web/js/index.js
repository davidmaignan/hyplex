$('document').ready(function(){

    $('#hotel-form').hide();
    $('#car-form').hide();

    $('#flight-tab').click(function(){
        $('#flight-form').show();
        $('#hotel-form').hide();
        $('#car-form').hide();
        $('#package-form').hide();
        $('.form-tab').each(function(){
            $(this).removeClass('selected');
        });
        $(this).addClass('selected');

    });

    $('#hotel-tab').click(function(){
        $('#flight-form').hide();
        $('#hotel-form').show();
        $('#car-form').hide();
        $('#package-form').hide();
        $('.form-tab').each(function(){
            $(this).removeClass('selected');
        });
        $(this).addClass('selected');
    });

    $('#car-tab').click(function(){
        $('#flight-form').hide();
        $('#hotel-form').hide();
        $('#car-form').show();
        $('#package-form').hide();
        $('.form-tab').each(function(){
            $(this).removeClass('selected');
        });
        $(this).addClass('selected');
    });

    $('#package-tab').click(function(){
        $('#flight-form').hide();
        $('#hotel-form').hide();
        $('#car-form').hide();
        $('#package-form').show();
        $('.form-tab').each(function(){
            $(this).removeClass('selected');
        });
        $(this).addClass('selected');
    });

});