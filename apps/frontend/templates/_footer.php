<style>
    #footer{
        height: 360px;
        background: url('/images/generic/bg_footer.gif') repeat-x left top;
        abackground: url('../images/tmp/footer.jpg') no-repeat left top;
        display: block;
        width: 100%;
        color: white;
        padding-top: 10px;
        font-size: 90%;
        line-height: 18px;
        margin:0;   
    }

    #footer a{
        color: #acacac;
    }

    #footer a:hover{
        color: white;
    }


    #footer h2{
        color: white;
    }

    #footer h3{
        margin: 0;
        padding: 0;
    }



    #footer dl {
        margin-bottom:5px;
        border-bottom: 1px solid #777777;
        height: 60px;
    }

    #footer dl dt {
        color: #acacac;
        float:left;
        font-weight:bold;
        margin-right:3px;
        margin-top: 4px;
        width: 80px;
    }

    #footer dd .desc{
        width: 165px;
        float: left;
        font-size: 95%;
        color: #acacac;

    }

    #footer dd .price{
        width: 45px;
        float: left;

    }

    #footer #disclaimer{

    }

    #footer li.rss, #footer li.twitter, #footer li.facebook, #footer li.newsletter{
        background: url('/images/icons/rss.gif') no-repeat left 4px;
        padding-left:14px;
    }

    #footer li.twitter{
        background-image: url('/images/icons/twitter.gif');
    }

    #footer li.facebook{
        background-image: url('/images/icons/facebook.gif');
    }

    #footer li.newsletter{
        background-image: url('/images/icons/newsletter.gif');
    }

</style>

<?php

use_helper('Number','Text','Date');

?>

<div id="footer">

    <div class="container">

        <div style="height: 333px;">

            <?php $arDatas = array('mexico', 'tahiti', 'carribean', 'hawaii'); ?>

            <div class="span-8">
                <h2 class="title">Latest deals</h2>
                <?php for ($i = 0; $i < 4; $i++): ?>
                <?php $val = $arDatas[rand(0, count($arDatas) - 1)]; ?>
                    <dl class="deals">
                        <dt><?php echo image_tag('tmp/' . $val . '.png', array('width' => '70px')); ?> </dt>
                        <dd>
                            <h3><?php echo ucfirst($val); ?></h3>
                            <div class="desc">4 nights in 4 stars for 2 adults, lorem ipsum etc</div>
                            <div class="price">
                            <?php echo format_currency(rand(300, 600), sfConfig::get('app_currency')) ?>
                        </div>
                    </dd>
                </dl>
                <?php endfor; ?>

                        </div>

                        <div class="span-4">
                            <h2 class="title">Partner sites</h2>
                            <ul id="">
                                <li><a href="#"><?php echo __('Disney World Resort'); ?></a></li>
                                <li><a href="#"><?php echo __('Bahamas Tourism Board'); ?></a></li>
                                <li><a href="#"><?php echo __('Hawaii Tourism'); ?></a></li>
                                <li><a href="#"><?php echo __('Cruises Travel'); ?></a></li>
                                <li><a href="#"><?php echo __('Disney World '); ?></a></li>

                            </ul>

                        </div>

                        <div class="span-4">
                            <h2 class="title">More sections</h2>
                            <ul id="">
                                <li><a href="#"><?php echo __('All inclusive'); ?></a></li>
                                <li><a href="#"><?php echo __('Collections'); ?></a></li>
                                <li><a href="#"><?php echo __('Discovery'); ?></a></li>
                                <li><a href="#"><?php echo __('Romance'); ?></a></li>
                                <li><a href="#"><?php echo __('Pursuits'); ?></a></li>
                                <li><a href="#"><?php echo __('Romance'); ?></a></li>

                            </ul>

                        </div>

                        <div class="span-4">
                            <h2 class="title">Updates</h2>
                            <ul id="">
                                <li class="rss"><a href="#"><?php echo __('RSS feeds'); ?></a></li>
                                <li class="twitter"><a href="#"><?php echo __('Hypertech on Twitter'); ?></a></li>
                                <li class="facebook"><a href="#"><?php echo __('Hypertech on Facebook'); ?></a></li>
                                <li class="newsletter"><a href="#"><?php echo __('E-newsletters'); ?></a></li>
                            </ul>

                        </div>

                        <div class="span-4 last">
                            <h2 class="title">Home</h2>
                            <ul id="">
                                <li><a href="#"><?php echo __('About us'); ?></a></li>
                                <li><a href="#"><?php echo __('My bookings'); ?></a></li>
                                <li><a href="#"><?php echo __('Advertise'); ?></a></li>
                                <li><a href="#"><?php echo __('Privacy'); ?></a></li>
                                <li><a href="#"><?php echo __('Feedback'); ?></a></li>
                                <li><a href="#"><?php echo __('Mobile version'); ?></a></li>

                            </ul>

                        </div>

                    </div>
                    <div style="clear: both;"></div>
                    <div id="disclaimer">
                        <p style="float: right;">&copy; Hypertech Solutions - <?php echo date('Y'); ?></p>
                    </div>

    </div>

</div>

