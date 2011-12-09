
<?php
//Get the password if the are valid

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

?>



<div class="span-26 last append-bottom">

    <div class="span-7">
        <?php include_component('basket', 'checkOut'); ?>
    </div>

    <div class="span-17 prepend-1 last">

        <form action="<?php echo url_for('@booking_check_address') ?>" method="post">
            <h1 class="flight"><?php echo __('Payement & Billing information') ?></h1>
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
            <p><?php echo __('Please supply a valid email address and telephone. A confirmation will be sent to this email.')?></p>
            <table class="middle">
                <tr>
                    <td class="span-4"><?php echo $form['email']->renderLabel(); ?></td>
                    <td>
                        <?php echo $form['email']->render(array('class'=>'text span-5')); ?><br /><br />
                        <?php echo $form['email']->renderError(); ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['email_again']->renderLabel(); ?></td>
                    <td>
                        <?php echo $form['email_again']->render(array('class'=>'text span-5')); ?><br /><br />
                        <?php echo $form['email_again']->renderError(); ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['telephone']->renderLabel(); ?></td>
                    <td>
                        <?php echo $form['telephone']->render(array('class'=>'text span-5')); ?><br /><br />
                        <?php echo $form['telephone']->renderError(); ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['password']->renderLabel(); ?></td>
                    <td>
                        <?php echo $form['password']->render(array('value' => $password, 'class'=>'text span-5')); ?><br /><br />
                        <?php echo $form['password']->renderError(); ?></li>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['password_again']->renderLabel(); ?></td>
                    <td>
                        <?php echo $form['password_again']->render(array('value' => $password_again, 'class'=>'text span-5')); ?><br /><br />
                        <?php echo $form['password_again']->renderError(); ?>
                    </td>
                </tr>
            </table>
            <h2 class="title">Address information</h2>
            <p><?php echo __("Please supply the cardholder's billing address as listed on the credit/debit card statement.") ?> </p>
            <table class="middle">
                <tr>
                    <td class="span-4"><?php echo $form['address_1']->renderLabel(); ?></td>
                    <td>
                        <?php echo $form['address_1']->render(array('class'=>'text span-5')); ?><br /><br />
                        <?php echo $form['address_1']->renderError(); ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['address_2']->renderLabel(); ?></td>
                    <td>    
                        <?php echo $form['address_2']->render(array('class'=>'text span-5')); ?><br /><br />
                        <?php echo $form['address_2']->renderError(); ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['city']->renderLabel(); ?></td>
                    <td>    
                        <?php echo $form['city']->render(array('class'=>'text span-5')); ?><br /><br />
                        <?php echo $form['city']->renderError(); ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['postcode']->renderLabel(); ?></td>
                    <td>
                        <?php echo $form['postcode']->render(array('class'=>'text span-5'));; ?><br /><br />
                        <?php echo $form['postcode']->renderError(); ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['state']->renderLabel(); ?></td>
                    <td>
                        <?php echo $form['state']->render(array('class'=>'text span-5')); ?><br /><br />
                        <?php echo $form['state']->renderError(); ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['country']->renderLabel(); ?></td>
                    <td>
                        <?php echo $form['country']->render(array('class'=>'text span-5s')); ?><br /><br />
                       <?php echo $form['country']->renderError(); ?>
                    </td>
                </tr>
            </table>
            <?php echo $form['_csrf_token']; ?>
            <?php echo $form['country_id']; ?>



            <div class="span-8 last right append-bottom">
                <input type="submit" value="<?php echo __('Payement'); ?>" class="blue bigger right" />
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