<?php use_helper('I18n'); ?>
<?php use_stylesheet('form'); ?>

<?php //use_javascript('search/airport_list_' . $sf_user->getCulture() . '.js'); ?>
<?php //use_javascript('search/datepicker_' . $sf_user->getCulture() . '.js'); ?>

<?php
if ($form->hasGlobalErrors()) {
    //echo $form->renderGlobalErrors();
}
?>

<style>

    table{
        width: 100%;
    }

    td{
        border:0px solid #ddd;
        padding-bottom:2px;
    }
    td.prepend-top{
        padding-top: 10px;
    }

    td.error{

    }

</style>

<div class="span-15" id="form-index" >

    <form action="<?php echo url_for('@search_package_form') ?>" method="post" id="">
        <fieldset>

            <?php if($form->hasGlobalErrors()): ?>
            <ul class="error-global">
               <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
                  <li class=""><?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <h3 class="form-index"><?php echo __('Trip details'); ?></h3>
            <table>
                <tr>
                    <td class="" colspan="2">
                        <?php echo $form['origin']->renderLabel(); ?>
                    </td>
                    <td colspan="2">
                        <?php echo $form['destination']->renderLabel(); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo $form['origin']; ?>
                        <span class="multi-icon">
                        <a href="<?php echo url_for('multidestination'); ?>" id="origin-0" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a>
                    </span>
                    </td>
                    <td colspan="2">
                        <?php echo $form['destination']; ?>
                        <span class="multi-icon">
                            <a href="<?php echo url_for('multidestination'); ?>" id="destination-0" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="small" colspan="2" style="width: 49%;">
                        <?php echo $form['origin']->renderError(); ?>
                    </td>
                    <td class="small" colspan="2" style="width: 49%;">
                        <?php echo $form['destination']->renderError(); ?>
                    </td>
                </tr>
                <tr class="topPadding">
                    <td><?php echo $form['depart_date']->renderLabel(); ?></td>
                    <td><?php echo $form['depart_time']->renderLabel(); ?></td>
                    <td><?php echo $form['return_date']->renderLabel(); ?></td>
                    <td><?php echo $form['return_time']->renderLabel(); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form['depart_date'] ?></td>
                    <td><?php echo $form['depart_time'] ?></td>
                    <td><?php echo $form['return_date'] ?></td>
                    <td><?php echo $form['return_time'] ?></td>
                </tr>
                <tr>
                    <td class="small"><?php echo $form['depart_date']->renderError() ?></td>
                    <td class="small"><?php echo $form['depart_time']->renderError() ?></td>
                    <td class="small"><?php echo $form['return_date']->renderError() ?></td>
                    <td class="small"><?php echo $form['return_time']->renderError() ?></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <h3 class="form-index prepend-top"><?php echo __('Flight options'); ?></h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo $form['cabin']->renderLabel(); ?>
                    </td>
                    <td colspan="2">
                        <?php //echo $form['airline']->renderLabel(); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form['cabin']; ?>
                    </td>
                    <td style="vertical-align: top; padding-top: 7px;">
                        <?php echo $form['prefer_nonstop']->render(); ?>
                    </td>
                    <td colspan="2">
                        <?php //echo $form['airline']; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2" id="prefered-airlines-list"></td>
                </tr>
                
            </table>

              <hr class="space2"/>
        <h3 class="form-index"><?php echo __('Room details'); ?></h3>
        <?php foreach ($form['newRooms'] as $key => $f): ?>
            <div id="room-container-<?php echo $key ?>" class="room-container <?php echo ($key != 1)? 'bordered': ''; ?>">
                <table id="room-1" class="hotel-form-table">
                    <tr>
                        <td style="vertical-align: top; padding-top: 25px;  width: 50px;" class="label">Room:</td>
                        <td style="vertical-align: top; width: 80px;">
                            <ul>
                                <li><?php echo $f['number_adults']->renderLabel(); ?></li>
                                <li><?php echo $f['number_adults']; ?></li>
                            </ul>
                        </td>
                        <td style="vertical-align: top; padding-left: 10px;">
                            <ul>
                                <li><?php echo $f['number_children']->renderLabel(); ?></li>
                                <li><?php echo $f['number_children']->render(array('class'=>'package-children-age medium')); ?></li>
                            </ul>
                        </td>
                        <td style="width: 250px;">
                            <div id="child-container-<?php echo $key; ?>">
                            <?php foreach ($form['childrenAge'] as $k => $f): ?>
                            <?php if ($k[0] == $key): ?>
                            <?php include_partial('searchPackage/addChildAge', array('form' => $form, 'roomNumber' => $k[0], 'i' => $k[2])) ?>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            </div>

                        </td>
                        <td style="vertical-align: middle; width: 70px;">
                            <?php if($key != 1): ?>
                            <a href="#" id="room-delete-<?php echo $key ?>" onclick="do_delete(this);" class="remove-small"><?php echo __('remove'); ?></a>
                            <?php endif; ?>
                        </td>
                        </tr>
                    </table>
                </div>
        <?php endforeach; ?>

        <div id="packageExtraRooms" ></div>
        <br />
        <button id="addPackageRoom" type="button" class="info">More rooms</button>

        <div class="span-8 last right">
            <input type="submit" value="<?php echo __('search'); ?>" class="blue right" />
        </div>
        <?php echo $form['type']; ?>
        <?php echo $form['_csrf_token']; ?>

        </fieldset>
        </form>

               
               
</div>


<script type="text/javascript">
    var packageRooms = <?php print_r($form['newRooms']->count()+1) ?>;

    $('button#addPackageRoom').click(function() {
            $("#packageExtraRooms").append(addRoom(packageRooms,'<?php echo url_for('searchPackage/addRoomForm2') ?>'));
            packageRooms = packageRooms + 1;
            activateChildDropMenu();
    });

    activateChildDropMenu();

    function add_children(roomNumber, num) {
        var r = $.ajax({
            type: 'GET',
            url: '<?php echo url_for('searchPackage/addChildrenAge') ?>'+'?num='+num+'&roomNumber='+roomNumber,
        async: false
        }).responseText;
        return r;
    }

    function addRoom(num, url) {
        var r = $.ajax({
            type: 'GET',
            url: url+'?num='+num,
            async: false
        }).responseText;
        return r;
    }

    function activateChildDropMenu(){
        $('.package-children-age').change(function(){
            var name = $(this).closest('div.room-container').attr('id');
            name = name.charAt(name.length-1);
            var roomNumber = name.charAt(name.length-1);
            var target = '#child-container-'+roomNumber;

            $(target).html(add_children(roomNumber,this.value));
        });
    }

    function do_delete(elt)
    {
        var r=confirm("<?php echo __('Are you sure you want to remove this segment'); ?>");
        if (r==true)
        {
            var tmp = elt.id;
            var number = tmp.charAt(tmp.length-1);

            var name = '#room-container-'+number;
            $(name).remove();
        }
    }

</script>