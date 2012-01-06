$('document').ready(function(){
    
    $('#filter').toggle(function(){
        $('#sf_admin_bar').show();
        $('#sf_admin_bar').animate({
            right: '0'
        });
        
    }, function(){
        $('#sf_admin_bar').hide();
        $('#sf_admin_bar').attr('right','+=600px');
        
    });
    
});