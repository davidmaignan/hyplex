<?php

$arTopDestination = array('','Discover Australia', 'Romantic Paris','Historic Rome','Surfing Hawaii','Traditional Japan','Discover Easter'); ?>

<div class="span-26 last bg1 append-bottom">
    <hr class="space3" />
    <h2 class="title">Top destinations</h2>
    <?php for($i=1;$i<count($arTopDestination); $i++): ?>
    <div class="top-destination2" <?php echo ($i % 3 == 0 && $i != 0)? 'style="margin-right: 0px"': ''; ?> >
        <div class="bg">
            <?php echo image_tag('tmp/topDestination'.($i).'.jpg', array('width'=>'304px', 'height' => '155px')) ?>
        </div>
        <a class="button action blue">Search</a>
        <h4><?php echo $arTopDestination[$i]; ?></h4>
        <p><span class="from left">from</span>
            <span class="price"><?php echo format_currency(rand(487, 1130), sfConfig::get('app_currency')) ?></span>
            <span class="date">starting <span class="bold"><?php echo format_date(date('Y-m-d'), 'top-destination') ?></span></span>
        </p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua.</p>
    </div>
    <?php endfor; ?>
</div>


<style>
    .top-destination2{
        width: 304px;
        height: 280px;
        margin-right: 0;
        border-right: 0px solid red;
        margin-right: 44px;
        position: relative;
        float: left;
        margin-top: 0;
    }

    .top-destination2 .bg{
        position: absolute;
        width: 304px;
        height: 155px;
        background-color: #0083C1;
        display: block;
        z-index: 0;
    }

    .top-destination2 h4{
        margin-top: 160px;
        font-weight: 130%;
        font-weight: bold;
        margin-bottom: 14px;
    }

    .top-destination2 .button{
        z-index: 100;
        position: absolute;
        margin-top: 142px;
        margin-left: 190px;
        font-weight: 80%;
        padding: 5px 15px;
    }

    .top-destination2 .price{
        font-size: 180%;
        color: #7ea82c;
        line-height: 10px;
        margin-left: 8px;
    }

    .top-destination2 .date{
        text-align: right;
        float: right;
    }


</style>