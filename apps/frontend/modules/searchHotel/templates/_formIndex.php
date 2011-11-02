<?php use_javascript('search/searchHotel'); ?>

<form action="<?php echo url_for('@search_hotel_form') ?>" method="post" id="hotel-form-index">
    <fieldset>
        <h3 class="form-index"><?php echo __('Travel details'); ?></h3>
        <table class="form-index">
            <tr>
                <td colspan="2">
                    <?php echo $form['wherebox']->renderLabel(); ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $form['wherebox']; ?></td>
            </tr>
            <tr class="topPadding">
                <td class="prepend-top"><?php echo $form['checkin_date']->renderLabel(); ?></td>
                <td><?php echo $form['checkout_date']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td><?php echo $form['checkin_date'] ?></td>
                <td><?php echo $form['checkout_date'] ?></td>
            </tr> 
        </table>

        <h3 class="form-index"><?php echo __('Room details'); ?></h3>
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
                <td><?php echo $f['number_children']->render(array('class'=>'hotel-children-age medium')); ?></td>
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


        <div id="extrarooms" ></div>
        <br />
        <div>
        <button class="info" id="add_picture" type="button">More rooms</button>
        </div>
        <div class="last right">
            <input type="submit" value="<?php echo __('search'); ?>" class="blue right" />
        </div>
        <?php echo $form['type']; ?>
        <?php echo $form['_csrf_token']; ?>
        
    </fieldset>
</form>

<script type="text/javascript">
    var rooms = <?php print_r($form['newRooms']->count()+1) ?>;

    function addRoom(num, url) {
        var r = $.ajax({
            type: 'GET',
            url: url+'?num='+num,
            async: false
        }).responseText;
        return r;
    }

    function add_children(roomNumber, num) {
        var r = $.ajax({
            type: 'GET',
            url: '<?php echo url_for('searchHotel/addChildrenAge') ?>'+'?num='+num+'&roomNumber='+roomNumber,
        async: false
        }).responseText;
        return r;
    }

    function add_children_package(roomNumber, num) {
        var r = $.ajax({
            type: 'GET',
            url: '<?php echo url_for('searchPackage/addChildrenAge') ?>'+'?num='+num+'&roomNumber='+roomNumber,
        async: false
        }).responseText;
        return r;
    }

    $('document').ready(function() {

        $('button#add_picture').click(function() {
            $("#extrarooms").append(addRoom(rooms, '<?php echo url_for('searchHotel/addRoomForm') ?>'));
            rooms = rooms + 1;
            activateChildDropMenu();
        });

        activateChildDropMenu();

    });

    function activateChildDropMenu(){

        $('.package-children-age').change(function(){
            //alert('here');
            var name = $(this).closest('div.room-container').attr('id');

            var target = $(this).closest('div.room-container').next('.child-container');

            name = name.charAt(name.length-1);
            var roomNumber = name.charAt(name.length-1);
            //var target = '#child-container-'+roomNumber;

            $(target).html(add_children_package(roomNumber,this.value));
        });

        
        $('.hotel-children-age').change(function(){
            //alert('here');
            var name = $(this).closest('div.room-container').attr('id');

            var target = $(this).closest('div.room-container').next('.child-container');
            
            name = name.charAt(name.length-1);
            var roomNumber = name.charAt(name.length-1);
            //var target = '#child-container-'+roomNumber;
            
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