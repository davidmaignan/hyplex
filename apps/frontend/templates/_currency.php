<div id="currency">
    <ul>
        <li class="selected">USD</li>
        <li class="other-currency"><a>RMB</a></li>
        <li class="other-currency"><a>GBP</a></li>
        <li class="other-currency"><a>EUR</a></li>
    </ul>
</div>

<script>

    $('#currency').hover(function(){
        $('#currency li.selected').addClass('hover');
        $('.other-currency').show();

    }, function(){
        $('#currency li.selected').removeClass('hover');
        $('.other-currency').hide();
    });

</script>