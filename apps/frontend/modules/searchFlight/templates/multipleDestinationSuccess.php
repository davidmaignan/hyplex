<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>

<?php use_javascript('jquery.autocomplete.min.js'); ?>
<?php use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>
<?php use_stylesheet('jquery.autocomplete.css'); ?>

<?php use_javascript('search/searchFlight.js'); ?>

<?php use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php use_javascript('debugger/myLogger.js'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>


<?php include_partial('form_multipleDestination', array('form' => $form)); ?>

</form>



<script type="text/javascript">
    var pics = <?php print_r($form['newSegments']->count()) ?>;

    function addPic(num) {
        var r = $.ajax({
            type: 'GET',
            url: '<?php echo url_for('searchFlight/addPicForm') ?>'+'?num='+num,
            async: false
        }).responseText;
        return r;
    }

    $('document').ready(function() {
        $('button#add_picture').click(function() {
            $("#extrapictures").append(addPic(pics));
            $( ".datepicker").datepicker({
                dateFormat: "yy-mm-dd",
            });

            $(".autocomplete").autocomplete(airports, {
                minChars: 0,
                width: 250,
                matchContains: "word",
                autoFill: false,
                formatItem: function(row, i, max) {
                    return formatAirportString(row);
                },
                formatMatch: function(row, i, max) {
                    return formatAirportString(row);
                },
                formatResult: function(row) {
                    return formatAirportString(row);
                }
            });

            pics = pics + 1;
        });

        $( ".datepicker").datepicker({
            dateFormat: "yy-mm-dd",
        });

        $(".autocomplete").autocomplete(airports, {
            minChars: 0,
            width: 250,
            matchContains: "word",
            autoFill: false,
            formatItem: function(row, i, max) {
                return formatAirportString(row);
            },
            formatMatch: function(row, i, max) {
                return formatAirportString(row);
            },
            formatResult: function(row) {
                return formatAirportString(row);
            }
        });


    });


    function do_delete(elt)
    {
        var r=confirm("<?php echo __('Are you sure you want to remove this segment'); ?>");
        if (r==true)
        {
            var num = (elt.id);
            var name = '#segment-'+num;
            $(name).remove();
            //var d = document.getElementById('test');
            //document.body.removeChild(d);

            //ADS.log.write( );
            //$(this).closest('table').css('display','none');
            //pics--;
        }
        else
        {
            alert("You pressed Cancel!");
        }
    }

</script>
