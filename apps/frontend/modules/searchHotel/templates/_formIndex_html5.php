

<?php if(in_array($sf_user->getCulture(), array('fr_FR','zh_CN'))):?>
<?php use_javascript('culture/datepicker_'.$sf_user->getCulture().'.js') ?>
<?php endif; ?>

<?php use_javascript('search/searchHotel'); ?>

<form action="<?php echo url_for('@search_hotel_form') ?>" method="post" id="hotel-form-index">
    <fieldset class="type1 noborder">
        <legend></legend>
        <h5><?php echo __('Travel details'); ?></h5>
        <p>
            <?php echo $form['wherebox']->renderLabel(); ?><br>
            <?php echo $form['wherebox']->render(array('class'=>'text')); ?>
            <?php echo $form['wherebox']->renderError(); ?>
        </p>
        <table class="form">
            <tr>
                <td>
               		<?php echo $form['checkin_date']->renderLabel(); ?><br />
                	<?php echo $form['checkin_date']->render(array('class'=>'text span-3')) ?><br><br>
                	<?php echo $form['checkin_date']->renderError(); ?>
                <td>
                    <?php echo $form['checkout_date']->renderLabel(); ?><br>
                    <?php echo $form['checkout_date']->render(array('class'=>'text span-3')) ?><br><br>
                    <?php echo $form['checkout_date']->renderError(); ?>
                </td>
            </tr>
        </table>
        <div>
            <?php echo $form['type']; ?>
            <?php echo $form['_csrf_token']; ?>
        </div>
        <h5><?php echo __('Room details'); ?></h5>
        <?php foreach ($form['newRooms'] as $key => $f): ?>
            <?php include_partial('searchHotel/room_html5', array('f'=>$f, 'form'=>$form, 'num'=>0));?>
        <?php endforeach; ?>
        <div id="extrarooms" ></div>
        
        <p class="minMargin">
            <button class="info" id="add_room" type="button"><?php echo __('More rooms') ?></button>
        </p>
        <hr class="dotted blue2"/>
        <p>
            <input type="submit" class="blue right bigger" value="search">
        </p>
        
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

        $('button#add_room').click(function() {
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
            
            var position = $(this).attr('id').search(/[0-9]/);
            var roomNumber = $(this).attr('id').substring(position, position+1);
            if(this.value == 0){
                $(this).closest('table.form').next('div.info').hide();
            }else{
                $(this).closest('table.form').next('div.info').show();
            }
            
            $(this).closest('table.form').next('div.info').children('div.child-age-container').html(add_children(roomNumber,this.value));
        });
    }


    function do_delete(elt)
    {

        var r=confirm("<?php echo __('Are you sure you want to remove this segment'); ?>");
        if (r==true)
        {   
            $(elt).closest('table.form').prev('hr').remove();
            $(elt).closest('table.form').next('div.info').remove();
            $(elt).closest('table.form').remove();
            return false;
        }
        
    }

</script>