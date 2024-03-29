<?php use_helper('I18n'); ?>
<?php use_stylesheet('form'); ?>

<?php //use_javascript('jquery.autocomplete.min.js'); ?>
<?php //use_javascript('fancybox/jquery.mousewheel-3.0.4.pack.js'); ?>
<?php //use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>

<?php //use_javascript('search/airport_list_' . $sf_user->getCulture() . '.js'); ?>
<?php //use_javascript('search/datepicker_' . $sf_user->getCulture() . '.js'); ?>

<?php //use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>
<?php //use_stylesheet('jquery.autocomplete.css'); ?>

<?php use_javascript('search/searchHotel'); ?>

<?php
if ($form->hasGlobalErrors()) {
    //echo $form->renderGlobalErrors();
}
?>

<?php //use_javascript('search/searchHotel'); ?>


<style>
    table.form-error td{
        padding-right: 10px;
    }

</style>

<div class="span-15" id="form-index" >

<form action="<?php echo url_for('@search_hotel_form') ?>" method="post" id="hotel-form-index">
    <fieldset>
        <?php if($form->hasGlobalErrors()): ?>
            <ul class="error-global">
               <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
                  <li class=""><?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        <h3 class="form-index"><?php echo __('Travel details'); ?></h3>
        <table class="form-error">
            <tr>
                <td class="prepend-top"><?php echo $form['wherebox']->renderLabel(); ?></td>
                <td class="prepend-top"><?php echo $form['checkin_date']->renderLabel(); ?></td>
                <td class="prepend-top"><?php echo $form['checkout_date']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td><?php echo $form['wherebox']; ?></td>
                <td><?php echo $form['checkin_date']; ?></td>
                <td><?php echo $form['checkout_date']; ?></td>
            </tr>
            <tr>
                <td><?php echo $form['wherebox']->renderError(); ?></td>
                <td><?php echo $form['checkin_date']->renderError(); ?></td>
                <td><?php echo $form['checkout_date']->renderError(); ?></td>
            </tr>
        </table>
        <hr class="space2"/>
        <h3 class="form-index"><?php echo __('Room details'); ?></h3>
        <?php foreach ($form['newRooms'] as $key => $f): ?>
            <div id="room-container-<?php echo $key ?>" class="room-container <?php echo ($key != 1)? 'bordered': ''; ?>">
                <table id="room-1" class="hotel-form-table">
                    <tr>
                        <td></td>
                        <td style="width: 80px;"><?php echo $f['number_adults']->renderLabel(); ?></td>
                        <td><?php echo $f['number_children']->renderLabel(); ?></td>
                    </tr>
                    <tr>
                        <td class="label" style="vertical-align: middle;">Room:</td>
                        <td><?php echo $f['number_adults']; ?></td>
                        <td style="vertical-align: top; padding-left: 10px;">
                            <?php echo $f['number_children']->render(array('class'=>'hotel-children-age medium')); ?>
                        </td>
                        <td style="width: 250px;">
                            <div id="child-container-<?php echo $key; ?>">
                            <?php foreach ($form['childrenAge'] as $k => $f): ?>
                            <?php if ($k[0] == $key): ?>
                            <?php include_partial('searchHotel/addChildAge', array('form' => $form, 'roomNumber' => $k[0], 'i' => $k[2])) ?>
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

        <div id="extrarooms" ></div>
        <br />
        <button id="add_picture" type="button" class="info">More rooms</button>

        <div class="span-8 last right">
            <input type="submit" value="<?php echo __('search'); ?>" class="blue right" />
        </div>
        <?php echo $form['type']; ?>
        <?php echo $form['_csrf_token']; ?>

        </fieldset>
        </form>

    </div>


<script type="text/javascript">
    var rooms = <?php print_r($form['newRooms']->count() + 1) ?>;

    function addRoom(num) {
        var r = $.ajax({
            type: 'GET',
            url: '<?php echo url_for('searchHotel/addRoomForm2') ?>'+'?num='+num,
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

    $('document').ready(function() {
        $('button#add_picture').click(function() {
            $("#extrarooms").append(addRoom(rooms));
            rooms = rooms + 1;
            activateChildDropMenu();
        });

        activateChildDropMenu();

    });

    function activateChildDropMenu(){
        $('.hotel-children-age').change(function(){
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