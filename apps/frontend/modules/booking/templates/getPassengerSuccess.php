<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>
<?php use_stylesheet('custom-theme/jquery-ui-1.8.16.custom.css'); ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>

<?php use_javascript('jquery-1.6.2.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.16.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>

<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>
<?php use_javascript('jquery.maskedinput.js');?>
<?php //use_javascript('search/searchFlight'); ?>
<?php //use_javascript('search/searchHotel'); ?>
<?php use_javascript('search/airlines.js'); ?>


<style>
    .ui-autocomplete {
        max-height: 100px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
        /* add padding to account for vertical scrollbar */
        padding-right: 20px;
    }
    /* IE 6 doesn't support max-height
	 * we use height instead, but this forces the menu to always be this tall
	 */
    * html .ui-autocomplete {
        height: 100px;
    }


    select{
        margin-top: 3px;
    }

    table.passengers td{
        vertical-align: middle;
    }
    
    table.passengers td.first{
        padding-right: 6px;
        width: 100px;
    }

    table.passengers td.second{
        padding-right: 9px;
        width: 160px;
    }

    table.passengers td.third{
        padding-right: 6px;
    }


</style>
<hr class="space2" />
<div class="span-26 last prepend-top append-bottom">
    
    <div class="span-7">
        <?php include_component('basket', 'checkOut'); ?>
    </div>

    <div class="span-18 last">

        <h2 class="flight"><?php echo __('Passengers information') ?></h2>
        <p class="">
           <?php echo __('All traveler information must match exactly what is on the government-issued ID you use when traveling.') ?>
        </p>

                <?php if ($form->hasGlobalErrors()): ?>
                    <ul class="error-global">
                    <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
                        <li class=""><?php echo $error ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <form action="<?php echo url_for('@booking_passenger') ?>" method="post">

                <?php if(isset($form['adults'])):?>
                <h2 class="title prepend-top small"><?php echo __('Adults') ?></h2>
                <?php foreach ($form['adults'] as $key => $f): ?>
                <?php include_partial('formPassenger',array('f'=>$f, 'key'=>$key, 'type'=>'adult')); ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <hr class="space2" />
                
                <?php if(count($form['children'])>0):?>
                <h2 class="title prepend-top"><?php echo __('Children') ?></h2>
                <?php foreach ($form['children'] as $key => $f): ?>
                <?php include_partial('formPassenger',array('f'=>$f, 'key'=>$key,'type'=>'child')); ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php echo $form['_csrf_token']; ?>

                <div class="span-8 last right append-bottom">
                    <input type="submit" value="<?php echo __('Next'); ?>" class="blue right" />
                </div>
        </form>
    </div>

</div>

<hr class="space3" />

    <script type="text/javascript">


        $('document').ready(function(){

            $(".dob").mask("9999-99-99");

            $('.dob').datepicker({
			showOn: "button",
			buttonImage: "/images/icons/calendar.png",
			buttonImageOnly: true,
                        changeMonth: true,
			changeYear: true,
                        dateFormat: 'yy-mm-dd',
                        yearRange: '1900:2011',
                        maxDate: "0"
            });


            var projects = [
                {
                    value: "jquery",
                    label: "jQuery",
                    desc: "the write less, do more, JavaScript library",
                    icon: "jquery_32x32.png"
                },
                {
                    value: "jquery-ui",
                    label: "jQuery UI",
                    desc: "the official user interface library for jQuery",
                    icon: "jqueryui_32x32.png"
                },
                {
                    value: "sizzlejs",
                    label: "Sizzle JS",
                    desc: "a pure-JavaScript CSS selector engine",
                    icon: "sizzlejs_32x32.png"
                }
            ];

            $( ".airline_code" ).autocomplete({
                autoFocus: true,
                minLength: 2,
                delay: 200,
                source: airlines,
                select: function( event, ui ) {
                    $( this ).val( ui.item.label );
                    return false;
                }
            })
            .data( "autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "</a>" )
                .appendTo( ul );
            };



        
        });

    </script>