<?php //use_javascript('jquery.autocomplete.min.js'); ?>
<?php //use_javascript('search/searchFlight'); ?>

<?php if(in_array($sf_user->getCulture(), array('fr_FR','zh_CN'))):?>
<?php use_javascript('culture/datepicker_'.$sf_user->getCulture().'.js') ?>
<?php endif; ?>


<?php use_javascript('fancybox/jquery.mousewheel-3.0.4.pack.js'); ?>
<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>

<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>

<?php //use_stylesheet('jquery.autocomplete.css'); ?>


<?php
if ($form->hasGlobalErrors()) {
    echo $form->renderGlobalErrors();
}
?>

<style>
	
	ul.checkbox_list{
		list-style:none;
	}
	
    table.form-error{
        width: 100%;
    }

 #flight-form-multidestination  td{
        padding-right: 10px;
}

</style>

<div class="span-18"  id="form-index">

    <form action="<?php echo url_for('@search_multidestination_form') ?>" method="post" id="flight-form-multidestination">
        <fieldset class="type1">

            <div class="span-17">
                <h5 class="form-index"><?php echo __('Trip details'); ?></h5>
                <table class="form">
                <?php foreach ($form['newSegments'] as $key => $f): ?>
                <?php echo ($key >= 2) ? '<table class="form" id="segment-' . $key . '">' : '<table class="form">'; ?>
                    <tr>
                        <td class="first">&nbsp;</td>
                        <td colspan="2"><?php echo $f['origin']->renderLabel(); ?></td>
                        <td colspan="2"><?php echo $f['destination']->renderLabel(); ?></td>
                        <td colspan="2"><?php echo $f['depart_date']->renderLabel(); ?></td>
                    </tr>
                    <tr>
                        <td class="label" style="vertical-align: middle;"><?php echo __('Segment') ?>: <?php //echo $key;  ?></td>
                        <td><?php echo $f['origin']->render(array('class'=>'text span-5')) ?></td>
                        <td style="vertical-align: middle;">
                            <a href="<?php echo url_for('multidestination'); ?>" id="origin-<?php echo $key; ?>" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a></td>
                        <td><?php echo $f['destination']->render(array('class'=>'text span-5')) ?></td>
                        <td style="vertical-align: middle;">
                            <a href="<?php echo url_for('multidestination'); ?>" id="destination-<?php echo $key; ?>" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a></td>
                        <td><?php echo $f['depart_date']->render(array('class'=>'text span-3')) ?></td>
                        <td style="width: 90px; vertical-align: middle;">
                        <?php echo ($key >= 2) ? '<a href="#" class="remove-segment remove-small" id="' . $key . '" onclick="do_delete(this)">' . __('remove') . '</a>' : ''; ?>

                    </td>
                </tr>
                <tr class="line">
                    <td></td>
                    <td colspan="2"><?php echo $f['origin']->renderError(); ?></td>
                    <td colspan="2"><?php echo $f['destination']->renderError(); ?></td>
                    <td colspan="2"><?php echo $f['depart_date']->renderError(); ?></td>
                </tr>
                </table>

                <?php endforeach; ?>
                        <div id="extrapictures"></div>
                        <br />
                        <button id="add_picture" type="button" class="info right" ><?php echo __("More legs") ?></button>
                 </div>
                    <hr class="space" />
                    <h5 class="form-index"><?php echo __('Flight options'); ?></h5>
                    <div class="span-4 last">
                        <?php echo $form['cabin']; ?>
                    </div>
                    <div class="span-4 last">
                       <?php echo $form['prefer_nonstop']; ?>
                    </div>
                    <hr class="space" />
                    <h5 class="form-index"><?php echo __('Passengers informations'); ?></h5>
                    <div class="span-3 last">
                        <p class="label-block"><?php echo $form['number_adults']->renderRow(); ?></p>
                    </div>
                    <div class="span-3 last">
                        <p class="label-block"><?php echo $form['number_children']->renderRow(); ?></p>
                    </div>
                    <div class="span-3 last">
                        <p class="label-block"><?php echo $form['number_infants']->renderRow(); ?></p>
                    </div>
                    <div class="span-3 last" style="height: 0px;">
                <?php echo $form['type']; ?>
                <?php echo $form['_csrf_token']; ?>
                    </div>

                    <div style="clear:both"></div>
                    <div class="span-8 last right">
                        <input type="submit" value="<?php echo __('search'); ?>" class="search bigger right" />
                    </div>
                <div style="clear:both"></div>

        </fieldset>

    </form>

</div>
<hr class="space3" />
<script>

    var targetInfos;
    var flightSearchType = 'multiple';
    
    $('document').ready(function(){

        $(".multidestination-popup").click(function(){
            //Get the number
            targetInfos = $(this).attr('id').split('-')
        });
    

        $(".multidestination-popup").fancybox({
            'width'		: 700,
            'height'		: 400,
            'autoScale'     	: false,
            'centerOnScroll'        : true,
            'transitionIn'		: 'none',
            'transitionOut'		: 'none',
            'type'			: 'iframe'
        });


		

    });
    
    
</script>