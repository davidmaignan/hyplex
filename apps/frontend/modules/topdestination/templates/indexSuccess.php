<?php
    $arTopDestination = array('','Discover Australia', 'Romantic Paris','Historic Rome','Surfing Hawaii','Traditional Japan','Discover Easter');
?>

<div class="span-26 last append-bottom">

    <div class="span-26 append-bottom" id="top-destination2">

        <div class="span-10 last bg-2 right">
            <?php echo image_tag('tmp/topDestination_top.jpg'); ?>
        </div>
        <div class="span-4 right" style="margin: 35px 20px 15px 10px; width: 180px; padding: 8px; font-size: 110%; text-align: right; border:1px solid #c2dae9; background-color: #eff7fd;">
            <p class="price">
                <span class="from smallest">from</span><br />
                <span class="price biggest bold color2"><?php echo format_currency(rand(1487, 6030), sfConfig::get('app_currency')) ?></span>
            </p>
            <p class="minMargin">
                <span class="date">starts <span class="bold"><?php echo format_date(date('Y-m-d'), 'top-destination') ?></span></span>
            </p>
            <p class="minMargin">
                    <a class="button action blue">Book now</a>
            </p>
        </div>
        
        <h1 class="biggest fontface">I love NY</h1>
        <p>There's nothing like fall in New York City. The crisp autumn air, changing colors, romantic restaurants, nonstop nightlife, and all that shopping. Stay 3 or more nights and experience all that the Big Apple has to offer with these special rates.</p>
        <ul class="bullet prepend-1">
            <li>What's included:</li>
            <li>Return flight in economy class</li>
            <li>1 room for 2 persons in a 3 stars hotel in Manhattan</li>
            <li>2 tickets to Empire State Building</li>
            <li>Transfert from airport</li>
            <li>2 tickets for the Phantom of the Opera</li>
            <li>Transfert from airport</li>
        </ul>
      
    </div>
    
    
      <p class="smallest grey2 prepend-top">Terms and Conditions
        Special offers are only available at participating hotels. Prices shown above include applicable discount.
        Minimum stay of 3 nights may be required. Sample air/hotel packages above include 4 nights' accommodation
        plus roundtrip air for travel November 10, 2011 through March 31, 2012. Sample air/hotel package prices are per person,
        based upon double occupancy, with departure from Chicago; however, package prices vary by date, departure city,
        and availability. Sample air/hotel package prices include taxes and fees. Offers are subject to availability and may
        be discontinued without notice. Additional restrictions and blackout dates may apply. </p>
    
</div>


<div class="span-26 last append-bottom">
    <hr class="space" />
    <h2 class="title fontface">More deals</h2>
    <?php for($i=1;$i<count($arTopDestination); $i++): ?>
    <div class="top-destination2" <?php echo ($i % 3 == 0 && $i != 0)? 'style="margin-right: 0px"': ''; ?> >
        <div class="bg">
            <?php echo image_tag('tmp/topDestination'.($i).'.jpg', array('width'=>'304px', 'height' => '155px')) ?>
        </div>
        <a class="button action blue" style="padding: 2px 22px;"><?php echo __('search') ?></a>
        <h4><?php echo $arTopDestination[$i]; ?></h4>
        <p><span class="">from</span>
            <span class="price"><?php echo format_currency(rand(487, 1130), sfConfig::get('app_currency')) ?></span>
            <span class="date">starting <span class="bold"><?php echo format_date(date('Y-m-d'), 'top-destination') ?></span></span>
        </p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua.</p>
    </div>
    <?php endfor; ?>
</div>


<hr class="space3" />


<style>
    
    p.price{
        margin: 0;
    }
    
    .top-destination2{
        width: 304px;
        height: 300px;
        margin-right: 0;
        border-right: 0px solid red;
        margin-right: 34px;
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