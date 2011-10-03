<div class="span-26 last append-bottom">
    <form action="<?php echo url_for('@booking_check_address') ?>" method="post">
    <h1>Payement method</h1>
    <h2 class="title">Credit card information</h2>
    <table>
        <tr>
            
        </tr>
    </table>


    <h2 class="title">Address information</h2>
    <p>Please supply the cardholder's billing address as listed on the credit/debit card statement. </p>




</div>


<?php echo $form; ?>



<div class="span-8 last right append-bottom">
            <input type="submit" value="<?php echo __('next'); ?>" class="next" />
        </div>

</form>