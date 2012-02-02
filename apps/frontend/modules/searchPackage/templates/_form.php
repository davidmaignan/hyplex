<?php if(in_array($sf_user->getCulture(), array('fr_FR','zh_CN'))):?>
<?php use_javascript('culture/datepicker_'.$sf_user->getCulture().'.js') ?>
<?php endif; ?>

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
        <fieldset class="type1">

            <?php if($form->hasGlobalErrors()): ?>
            <ul class="error-global">
               <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
                  <li class=""><?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <h5><?php echo __('Trip details'); ?></h5>
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
                        <?php echo $form['origin']->render(array('class' => 'text span-5')); ?>
                        <span class="multi-icon">
                        <a href="<?php echo url_for('multidestination'); ?>" id="origin-0" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a>
                    </span>
                    </td>
                    <td colspan="2">
                        <?php echo $form['destination']->render(array('class' => 'text span-5')); ?>
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
                    <td><?php echo $form['depart_date']->render(array('class' => 'text span-3')); ?></td>
                    <td><?php echo $form['depart_time'] ?></td>
                    <td><?php echo $form['return_date']->render(array('class' => 'text span-3')); ?></td>
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
                        <h5><?php echo __('Flight options'); ?></h5>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo $form['cabin']->renderLabel(); ?>
                    </td>
                    <td colspan="2">
                        
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

   
        <h5 class="form-index"><?php echo __('Room details'); ?></h5>
        <?php foreach ($form['newRooms'] as $key => $f): ?>
           <?php include_partial('searchHotel/room_html5', array('key'=>$key, 'f' => $f, 'form'=>$form)); ?>
        <?php endforeach; ?>

        <div id="packageExtraRooms" ></div>
        <br />
        <button id="addPackageRoom" type="button" class="info">More rooms</button>

        <div class="span-8 last right">
            <input type="submit" value="<?php echo __('search'); ?>" class="blue bigger right" />
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