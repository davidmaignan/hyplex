<?php if(in_array($sf_user->getCulture(), array('fr_FR','zh_CN'))):?>
<?php use_javascript('culture/datepicker_'.$sf_user->getCulture().'.js') ?>
<?php endif; ?>

<?php use_javascript('search/searchFlight'); ?>

<form action="<?php echo url_for('@search_flight_form') ?>" method="post" name="flight_search_form_1" id="fligh_search_form_1">
    <fieldset class="type1">
        <legend></legend>
        <h5><?php echo __('Trip details'); ?></h5>
        <table  class="form">
            <tr>
                <td><?php echo $form['oneway']->render(); ?></td>
                <td colspan=""><a class="multiple-destination" href="<?php echo url_for('multipleDestination') ?>"><?php echo __('Multiple destinations'); ?></a></td>
            </tr>
        </table>
        <p>
            <?php echo $form['origin']->renderLabel(); ?><br>
            <?php echo $form['origin']->render(array('class'=>'text span-7')) ?>
            <a class="dest-pop-up" href="#"><?php echo image_tag('icons/world.png', array('alt'=>'S'))?></a><br />
        </p>
        <p>
            <?php echo $form['destination']->renderLabel(); ?><br>
            <?php echo $form['destination']->render(array('class'=>'text  span-7')) ?>
            <a class="dest-pop-up" href="#"><?php echo image_tag('icons/world.png', array('alt'=>'S'))?></a><br /><br />
        </p>
        <table class="form">
            <tr>
                <td>
                    <?php echo $form['depart_date']->renderLabel(); ?><br>
                    <?php echo $form['depart_date']->render(array('class'=>'text span-3')); ?>
                </td>
                <td>
                    <?php echo $form['depart_time']->renderLabel(); ?><br>
                    <?php echo $form['depart_time']->render(array('class'=>'text span-2')); ?>
                </td>
            </tr>
        </table>
        <table class="form">
            <tr>
                <td>
                    <?php echo $form['return_date']->renderLabel(); ?><br>
                    <?php echo $form['return_date']->render(array('class'=>'text span-3')); ?>
                </td>
                <td>
                    <?php echo $form['return_time']->renderLabel(); ?><br>
                    <?php echo $form['return_time']->render(array('class'=>'text span-2')); ?>
                </td>
            </tr>
        </table>
        <h5><?php echo __('Flight options'); ?></h5>
        <table class="form">
            <tr>
                <td>
                    <?php echo $form['cabin']->renderLabel(); ?><br />
                    <?php echo $form['cabin']; ?>
                </td>
                <td class="bottom">
                    <?php echo $form['prefer_nonstop']; ?>
                </td>
            </tr>
        </table>
        <h5><?php echo __('Passengers informations');?></h5>
        <table class="form">
            <tr>
                <td>
                    <?php echo $form['number_adults']->renderLabel(); ?><br>
                    <?php echo $form['number_adults']; ?>
                </td>
                <td>
                    <?php echo $form['number_children']->renderLabel(); ?><br>
                    <?php echo $form['number_children']; ?>
                </td>
                <td>
                    <?php echo $form['number_infants']->renderLabel(); ?><br>
                    <?php echo $form['number_infants']; ?>
                </td>
            </tr>
        </table>
        <div>
            <?php echo $form['type']; ?>
            <?php echo $form['_csrf_token']; ?>
        </div>
        <input type="submit" class="blue right bigger" value="search">

    </fieldset>
</form>