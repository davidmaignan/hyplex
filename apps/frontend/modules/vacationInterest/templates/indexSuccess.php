<style>

    .gMapCategory{
        margin-right: 45px;
        margin-bottom: 30px;
    }

        .gMapCategory.last{
        margin-right: 0;
    }

</style>

<div class="span-26 last tmp" id="vac-int">


    <div class="span-26 last header append-bottom">
        <?php echo image_tag('tmp/vacationInterest_header.jpg'); ?>
    </div>

    <hr class="space" />

    <ul id="breadcrumb">
        <li><a href="#" class="first">Home</a></li>
        <li><a href="#">Area</a></li>
    </ul>
    
    <hr class="space3" />

    <?php $i = 1; ?>
    <?php foreach($combined as $key=>$category): ?>
        <div class="span-8 gMapCategory <?php echo ($i%3 == 0)? 'last':''; ?>">

            <h3 class="blue append-bottom title bold"><?php echo ucwords(str_replace('-', ' ', $key)); ?></h3>

            <?php foreach($category as $element): ?>
            <div class="gmapActivity">
                <div class="span-3 last">
                    <?php echo image_tag('tmp/'.$element['pic'], array('width'=>'100px')); ?>
                </div>
                <div class="span-5 last">
                    <ul>
                        <li class="grey1 bold smaller append-bottom2">
                            <a href="<?php echo url_for('vacation_interest_country') ?>">
                            <?php echo $element['name'] ?></a>
                        </li>
                        <li class="smaller grey1 append-bottom2 "><?php echo ($element['desc']) ?>
                            
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="space3" />
            <?php endforeach; ?>
        </div>

        <?php ++$i; ?>

    <?php endforeach; ?>



</div>