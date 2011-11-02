<?php use_javascript('search/searchPackage'); ?>

<form action="<?php echo url_for('@search_package_form') ?>" method="post" id="package-form-index">
    <fieldset>
        <h3 class="form-index"><?php echo __('Trip details'); ?></h3>
        <table class="form-index">
            <tr class="topPadding">
                <td colspan="2"><?php echo $form['origin']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="vertical-align: middle;">
                    <?php echo $form['origin'] ?>
                    <span class="multi-icon">
                        <a href="<?php echo url_for('multidestination'); ?>" id="origin-0" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a>
                    </span>
                </td>
            </tr>
            <tr class="topPadding">
                <td colspan="2"><?php echo $form['destination']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $form['destination'] ?>
                    <span class="multi-icon">
                        <a href="<?php echo url_for('multidestination'); ?>" id="destination-0" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a>
                    </span>
                </td>
            </tr>
            <tr class="topPadding">
                <td><?php echo $form['depart_date']->renderLabel(); ?></td>
                <td><?php echo $form['depart_time']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form['depart_date']; ?>
                </td>
                <td>
                    <?php echo $form['depart_time']; ?>
                </td>
            </tr>
            <tr class="topPadding">
                <td><?php echo $form['return_date']->renderLabel(); ?></td>
                <td><?php echo $form['return_time']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form['return_date']; ?>
                </td>
                <td>
                    <?php echo $form['return_time']; ?>
                </td>
            </tr>
        </table>
        
        <h3 class="form-index"><?php echo __('Flight options'); ?></h3>
        <table class="form-index">
            <tr>
                <td><?php echo $form['cabin']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td><?php echo $form['cabin']; ?></td>
                <td style="vertical-align: top; padding-top: 8px;"><?php echo $form['prefer_nonstop']; ?></td>
            </tr>
        </table>
       
        
        <h3 class="form-index"><?php echo __('Passengers & Room details'); ?></h3>
        <?php foreach ($form['newRooms'] as $key => $f): ?>
        <div id="room-container-<?php echo $key?>" class="room-container">
        <table id="room-1" class="hotel-form-table">
        <tr>
            <td></td>
            <td><?php echo $f['number_adults']->renderLabel(); ?></td>
            <td><?php echo $f['number_children']->renderLabel(); ?></td>
        </tr>
        <tr>
            <td class="label" style="width: 55px;">Room:</td>
            <td><?php echo $f['number_adults']; ?></td>
            <td><?php echo $f['number_children']->render(array('class'=>'package-children-age medium')); ?></td>
            <td style="vertical-align: middle; width: 70px;">&nbsp;</td>
        </tr>
        </table>
        </div>
        <div id="child-container-<?php echo $key; ?>" class="child-container">
            <?php foreach($form['childrenAge'] as $k=>$f): ?>
                <?php if($k[0] == $key): ?>
                    <?php include_partial('addChildAge',array('form'=> $form, 'roomNumber'=>$k[0], 'i'=>$k[2])) ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>


        <div id="packageExtraRooms" ></div>

        <br />
        <div>
            <button id="addPackageRoom" class="info" type="button">More rooms</button>
        </div>
        
        <div class="span-2 last" style="height: 8px;">
            <?php echo $form['type']; ?>
            <?php echo $form['_csrf_token']; ?>
        </div>

        <div style="clear:both"></div>
        <div class="span-8 last right">
            <input type="submit" value="<?php echo __('search'); ?>" class="blue right" />
        </div>
    </fieldset>

</form>

<script type="text/javascript">
    var packageRooms = <?php print_r($form['newRooms']->count()+1) ?>;

    $('document').ready(function() {

        $('button#addPackageRoom').click(function() {
            $("#packageExtraRooms").append(addRoom(packageRooms,'<?php echo url_for('searchPackage/addRoomForm') ?>'));
            packageRooms = packageRooms + 1;
            activateChildDropMenu();
        });

        activateChildDropMenu();

    });


</script>