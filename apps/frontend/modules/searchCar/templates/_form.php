<?php if(in_array($sf_user->getCulture(), array('fr_FR','zh_CN'))):?>
<?php use_javascript('culture/datepicker_'.$sf_user->getCulture().'.js') ?>
<?php endif; ?>

<?php use_javascript('search/searchCar'); ?>


<style>
    table.form-error td{
        padding-right: 10px;
    }

</style>

<div class="span-15" id="form-index" >

<form action="<?php echo url_for('@search_car_form') ?>" method="post" id="hotel-form-index">
    <fieldset class="type1">
        <?php if($form->hasGlobalErrors()): ?>
            <ul class="error-global">
               <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
                  <li class=""><?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        <h5><?php echo __('Search details'); ?></h5>
        <table class="form">
            <tr>
                <td colspan="4">
                    <ul class="inline">
                        <li style="width: 60px; float: left;"><?php echo $form['drop_off']->renderLabel(); ?></li>
                        <li><?php echo $form['drop_off']; ?></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $form['location1']->renderLabel(); ?>
                </td>
                <td colspan="2">
                   <?php echo $form['location2']->renderLabel(); ?>
                </td>
            </tr>
            <tr>
                 <td colspan="2"><?php echo $form['location1']->render(array('class'=>'text span-6')); ?></td>
                 <td colspan="2"><?php echo $form['location2']->render(array('class'=>'text span-6')); ?></td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $form['location1']->renderError(); ?></td>

                <td colspan="2"><?php echo $form['location2']->renderError(); ?></td>
               
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <?php echo $form['pickup_date']->renderLabel(); ?><br />
                    <?php echo $form['pickup_date']->render(array('class'=>'text span-3')); ?>
                </td>
                <td>
                    <?php echo $form['pickup_hour']->renderLabel(); ?><br />
                    <?php echo $form['pickup_hour']; ?>
                </td>
                <td>
                    <?php echo $form['dropoff_date']->renderLabel(); ?><br />
                    <?php echo $form['dropoff_date']->render(array('class'=>'text span-3')); ?>
                </td>
                 <td>
                    <?php echo $form['dropoff_hour']->renderLabel(); ?><br />
                    <?php echo $form['dropoff_hour']; ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['pickup_date']->renderError(); ?></td>
                <td><?php echo $form['pickup_hour']->renderError(); ?></td>
                <td><?php echo $form['dropoff_date']->renderError(); ?></td>
                <td><?php echo $form['dropoff_hour']->renderError(); ?></td>
            </tr>
            
        </table>
        <hr class="space"/>

        <div class="span-8 last right">
            <input type="submit" value="<?php echo __('search'); ?>" class="blue right bigger" />
        </div>
        <?php echo $form['type']; ?>
        <?php echo $form['_csrf_token']; ?>

        </fieldset>
        </form>

    </div>

