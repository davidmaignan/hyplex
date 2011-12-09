<?php require_once sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'search' . DIRECTORY_SEPARATOR . 'variables.php'; ?>

<?php if (in_array($sf_user->getCulture(), array('fr_FR', 'zh_CN'))): ?>
    <?php use_javascript('culture/datepicker_' . $sf_user->getCulture() . '.js') ?>
<?php endif; ?>

<?php use_javascript('search/searchFlight'); ?>

<?php use_javascript('fancybox/jquery.mousewheel-3.0.4.pack.js'); ?>
<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>

<div class="span-15 last">

    <?php if ($form->hasGlobalErrors()): ?>
        <ul class="error-global">
            <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
                <li class=""><?php echo $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form id="flight_search_form_2" name="flight_search_form_2" action="<?php echo url_for('@search_flight_form') ?>" method="post" >

        <fieldset class="type1">
            <legend></legend>
            <h5>Trip details</h5>
            <?php echo $form['oneway']; ?>
            <br />
            <table class="form">
                <tr>
                    <td class="span-7" colspan="2">
                        <?php echo $form['origin']->renderLabel(); ?><br>
                        <?php echo $form['origin']->render(array('class' => 'span-6 text')); ?>
                        <a class="dest-pop-up" href="#"><?php echo image_tag("icons/world.png", array('alt' => 'S')) ?></a>
                    </td>
                    <td class="span-7" colspan="2">
                        <?php echo $form['destination']->renderLabel(); ?><br>
                        <?php echo $form['destination']->render(array('class' => 'span-6 text')); ?>
                        <a class="dest-pop-up" href="#"><?php echo image_tag("icons/world.png", array('alt' => 'S')) ?></a>
                    </td>
                </tr>
                <tr>
                    <td class="span-7" colspan="2">
                        <?php echo $form['origin']->renderError(); ?>
                    </td>
                    <td class="span-7" colspan="2">
                        <?php echo $form['destination']->renderError(); ?>
                    </td>
                </tr>
                <tr>
                    <td class="span-4">
                        <?php echo $form['depart_date']->renderLabel(); ?><br>
                        <?php echo $form['depart_date']->render(array('class' => 'span-3 text')); ?>
                    </td>
                    <td class="span-3">
                        <?php echo $form['depart_time']->renderLabel(); ?><br />
                        <?php echo $form['depart_time']->render(array('class' => 'span-2 text')); ?><br />
                    </td>
                    <td class="span-4">
                        <?php echo $form['return_date']->renderLabel(); ?><br>
                        <?php echo $form['return_date']->render(array('class' => 'span-3 text')); ?>
                    </td>
                    <td class="span-3">
                        <?php echo $form['return_time']->renderLabel(); ?><br />
                        <?php echo $form['return_time']->render(array('class' => 'span-2 text')); ?><br />
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form['depart_date']->renderError(); ?>
                    </td>
                    <td>
                        <?php echo $form['depart_time']->renderError(); ?>
                    </td>
                    <td>
                        <?php echo $form['return_date']->renderError(); ?>
                    </td>
                    <td>
                        <?php echo $form['return_time']->renderError(); ?>
                    </td>
                </tr>
            </table>
            <h5><?php echo __('Flight options'); ?></h5>
            <table class="form">
                <tr>
                    <td class="span-3">
                        <?php echo $form['cabin']->renderLabel(); ?><br>
                        <?php echo $form['cabin']->render(array('class' => 'text span-3')); ?>
                    </td>
                    <td class="span-4 bottom">
                        <?php echo $form['prefer_nonstop']->render(); ?>
                    </td>
                    <td class="span-7">
                        <?php echo $form['airline']->renderLabel(); ?><br />
                        <?php echo $form['airline']->render(array('class' => 'text span-5')); ?>
                    </td>
                </tr>
            </table>
            <h5>Passengers details</h5>
            <table class="form">
                <tr>
                    <td class="span-3">
                        <?php echo $form['number_adults']->renderLabel(); ?><br />
                        <?php echo $form['number_adults']->render(array('class' => 'span-2')); ?>
                    </td>
                    <td  class="span-3">
                        <?php echo $form['number_children']->renderLabel(); ?><br />
                        <?php echo $form['number_children']->render(array('class' => 'span-2')); ?>
                    </td>
                    <td>
                        <?php echo $form['number_infants']->renderLabel(); ?><br />
                        <?php echo $form['number_infants']->render(array('class' => 'span-2')); ?>
                    </td>
                </tr>
            </table>
            <input type="submit" class="blue right bigger" value="search">
            <?php echo $form['type']; ?>
            <?php echo $form['_csrf_token']; ?>
        </fieldset>

    </form>
</div>






<script>
    var flightSearchType = 'simple';
</script>