
<?php
//Get the password if the are valid

if(!$sf_user->isAuthenticated()){

$parameters = $sf_request->getPostParameters();
$password = '';
$password_again = '';


if(isset($parameters['address'])){

    if($form['password']->hasError()){
        $password = '';
    }else{
        $password = $parameters['address']['password'];
    }

    if($form['password_again']->hasError()){
        $password_again = '';
    }else{
        $password_again = $parameters['address']['password_again'];
    }
}

}

?>



<div class="span-26 last append-bottom">

    <div class="span-7">
        <?php include_component('basket', 'checkOut'); ?>
    </div>

    <div class="span-17 prepend-1 last">

        <form action="<?php echo url_for('@booking_check_address') ?>" method="post">
            <h2 class="title blue1 fontface"><?php echo __('Payment & Billing information') ?></h1>
            <h2 class="title"><?php echo __('Credit card information') ?></h2>
            <table class="middle append-bottom">
                <tr>
                    <td class="span-4 append-bottom"><?php echo $form['credit_card_type']->renderLabel(); ?></td>
                    <td colspan="2">
                        <ul class="none">
                            <li><?php echo $form['credit_card_type']->render(); ?></li>
                            <li><?php echo $form['credit_card_type']->renderError(); ?></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['credit_card_number']->renderLabel(); ?></td>
                    <td>
                        <ul class="none">
                            <li><?php echo $form['credit_card_number']->render(array('class'=>'text span-5')); ?><br /><br /></li>
                            <li><?php echo $form['credit_card_number']->renderError(); ?></li>
                        </ul>
                    </td>
                    <td class="">
                        <ul class="none">
                            <li>Amex: 3400 0000 0000 009</li>
                            <li>MasterCard: 5500 0000 0000 0004</li>
                            <li>Visa: 4111 1111 1111 1111</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['expiration_date']->renderLabel(); ?></td>
                    <td>
                        <ul class="none">
                            <li><?php echo $form['expiration_date']; ?></li>
                            <li><?php echo $form['expiration_date']->renderError(); ?></li>
                        </ul>
                    </td>
                </tr>
            </table>

            <h2 class="title">Contact information</h2>
            
            <?php if($sf_user->isAuthenticated()): ?>
            
            <?php include_partial('booking/formAddress_isAuthenticated', array('form'=>$form)); ?>
            
            <?php else: ?>
            
            <?php include_partial('booking/formAddress_notAuthenticated', array('form'=>$form)); ?>
            
            <?php endif; ?>
            
            <?php echo $form['_csrf_token']; ?>
            <?php echo $form['country_id']; ?>



            <div class="span-8 last right append-bottom">
                <input type="submit" value="<?php echo __('Payment'); ?>" class="blue bigger right" />
            </div>

        </form>
    </div>

</div>
<hr />

<?php

//$parameters = $sf_request->getPostParameters();
//var_dump($parameters);

?>

<script>

$('document').ready(function(){

    $( "#country" ).autocomplete({
            autoFocus: true,
            source: function( request, response ) {
                    $.ajax({
                            url: "../autocomplete/country",
                            dataType: "json",
                            delay: 000,
                            data: {
                                    featureClass: "P",
                                    style: "full",
                                    maxRows: 12,
                                    name_startsWith: request.term
                            },
                            success: function( data ) {
                                    response( $.map( data.results, function( item ) {
                                            return {
                                                    label: item.t_name,
                                                    value: item.t_name,
                                                    id: item.a_id
                                            }
                                    }));
                            }
                    });
            },
            minLength: 2,
            select: function( event, ui ) {
                    $('#address_state_id').val('');
                    $('#state').val('');
                    $('#address_country_id').val(ui.item.id);
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

    $( "#state" ).autocomplete({
            autoFocus: true,
            source: function( request, response ) {
                    $.ajax({
                            url: "../autocomplete/state",
                            dataType: "json",
                            delay: 000,
                            data: {
                                    featureClass: "P",
                                    style: "full",
                                    maxRows: 12,
                                    name_startsWith: request.term
                            },
                            success: function( data ) {
                                    response( $.map( data.results, function( item ) {
                                            return {
                                                    label: item.t_name,
                                                    value: item.t_name,
                                                    id: item.a_id,
                                                    country_id: item.c_id,
                                                    country_name: item.u_name
                                            }
                                    }));
                            }
                    });
            },
            minLength: 2,
            select: function( event, ui ) {
                    //alert(ui.item.country_name);
                    $('#address_state_id').val(ui.item.id);
                    $('#address_country_id').val(ui.item.country_id);
                    $('#country').val(ui.item.country_name);

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

</script>