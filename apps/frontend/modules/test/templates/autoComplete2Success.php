<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery.autocomplete.2.js'); ?>

<style>
    /* demo */
    label
    {
        display:block;
    }

    /* autocomplete */
    input.autocomplete-loading
    {
        background-image:url(/images/autocomplete.gif);
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
        font-size: 90%;
    }
    ul.autocomplete li
    {
        display: block;
        padding: 2px;
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

<label for="text">Enter php, javascript, mysql etc it will display all blog post that have the keyword in title</label>
<input type="text" name="example" id="example" size="60" autocomplete="off" />
<script>
    $("input#example").autocomplete("searchAirportComplete");
</script>