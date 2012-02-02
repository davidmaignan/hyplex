<?php //echo $form['newPhotos'][$num]  ?>

<table id="segment-<?php echo $num ?>">
    <tr>
        <td class="first">&nbsp;</td>
        <td colspan="2"><?php echo $form['newSegments'][$num]['origin']->renderLabel(); ?></td>
        <td colspan="2"><?php echo$form['newSegments'][$num]['destination']->renderLabel(); ?></td>
        <td><?php echo $form['newSegments'][$num]['depart_date']->renderLabel(); ?></td>
        <td></td>
    </tr>
    <tr>
        <td style="font-size: 80%; vertical-align: middle;"><?php echo __('Segment') ?>: <?php //echo $num; ?></td>
        <td><?php echo $form['newSegments'][$num]['origin']->render(array('class'=>'text span-5')) ?></td>
        <td style="vertical-align: middle;"><a href="<?php echo url_for('multidestination'); ?>" id="origin-<?php echo $num; ?>" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a></td>
        <td><?php echo $form['newSegments'][$num]['destination']->render(array('class'=>'text span-5')) ?></td>
        <td style="vertical-align: middle;"><a href="<?php echo url_for('multidestination'); ?>" id="origin-<?php echo $num; ?>" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a></td>
        <td><?php echo $form['newSegments'][$num]['depart_date']->render(array('class'=>'text span-3')) ?></td>
        <td style="width: 90px; vertical-align: middle;">
            <a href="#" class="remove-segment remove-small" id="<?php echo $num; ?>" onclick="do_delete(this)"><?php echo __('remove'); ?></a>
        </td>
    </tr>
    <tr class="line">
        <td></td>
        <td style="font-size: 80%;" colspan="2"><?php echo $form['newSegments'][$num]['origin']->renderError(); ?></td>
        <td style="font-size: 80%;" colspan="2"><?php echo $form['newSegments'][$num]['destination']->renderError(); ?></td>
        <td style="font-size: 80%;"><?php echo $form['newSegments'][$num]['depart_date']->renderError(); ?></td>
        <td></td>
    </tr>
</table>



<script>


    $('document').ready(function(){

        $(".multidestination-popup").click(function(){
            //Get the number
            targetInfos = $(this).attr('id').split('-')
        });


        $(".multidestination-popup").fancybox({
            'width'		: 550,
            'height'		: 400,
            'autoScale'     	: false,
            'centerOnScroll'        : true,
            'transitionIn'		: 'none',
            'transitionOut'		: 'none',
            'type'			: 'iframe'
        });



    });

</script>