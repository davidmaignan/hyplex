<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php //use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>

<?php use_javascript('jquery.bigframe.min.js'); ?>
<?php use_javascript('thickbox-compressed.js'); ?>
<?php use_javascript('jquery.autocomplete.min.js'); ?>


<?php use_javascript('fancybox/jquery.mousewheel-3.0.4.pack.js'); ?>
<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>
<?php //use_javascript('search/searchFlight'); ?>
<?php //use_javascript('search/searchHotel'); ?>

<?php //use_javascript('search/airport_list_'.$sf_user->getCulture().'.js'); ?>
<?php //use_javascript('search/datepicker_'.$sf_user->getCulture().'.js'); ?>

<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>
<?php use_stylesheet('jquery.autocomplete.css'); ?>
<?php use_stylesheet('thickbox.css'); ?>

<?php use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>

<?php //use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php //use_javascript('debugger/myLogger.js'); ?>

<?php //use_helper('Date', 'Number', 'I18n'); ?>

<br />
<input type="text" id="searchAirport" />

<style>
    #searchAirport{
        width: 250px;
    }


    /* demo */
    label
    {
            display:block;
    }


    /* autocomplete */
    input.autocomplete-loading
    {
            background-image:url(autocomplete.gif);
            background-position: center right;
            background-repeat:no-repeat;
    }
    ul.autocomplete
    {
        position: absolute;
        overflow: hidden;
        background-color: #fff;
        border: 1px solid ButtonShadow;
        margin: 0px;
        padding: 0px;
        list-style: none;
        color: #000;
            display:none;
            z-index:1000;
    }
    ul.autocomplete li
    {
      display: block;
      padding: 0.3em;
      overflow: hidden;
      width: 100%;
      cursor:pointer;
    }

    ul.autocomplete li.selected
    {
      background-color: Highlight ;
      color: #fff;
    }

</style>
<script type="text/javascript">

    $('document').ready(function(){
        
        //ADS.log.header('autocomplete');

        $("#searchAirport").autocomplete('searchAirportComplete', {
                minChars: 3,
  		width: 300,
                autoFill: false,
                max: 20,
                highlight: function(value, search){
                    return highlight2(value, search);
                }
	});



        

    });



</script>

