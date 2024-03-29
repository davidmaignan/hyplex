<?php use_javascript('jquery-1.6.2.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.16.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>

<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>
<?php use_javascript('jquery.maskedinput.js');?>
<?php use_javascript('search/searchFlight'); ?>
<?php use_javascript('search/searchHotel'); ?>
<?php use_javascript('search/searchPackage'); ?>
<?php require_once sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'search'.DIRECTORY_SEPARATOR.'variables.php'; ?>

<?php //use_javascript('search/airport_list_'.$sf_user->getCulture().'.js'); ?>
<?php //use_javascript('culture/datepicker_'.$sf_user->getCulture().'.js'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>
<?php use_stylesheet('custom-theme/jquery-ui-1.8.16.custom.css'); ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>

<?php //use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php //use_javascript('debugger/myLogger.js'); ?>

<?php use_helper('Date', 'Number', 'I18n'); ?>

<style type="text/css">
    #dialog-message{
        display: none;
        text-align: center;
    }
</style>


<div id="dialog-message" title="<?php echo __('You have sent a request') ?>">
    <p style="text-align: center;"><?php echo image_tag('generic/ajax-loader.gif', array('alt' => '')) ?></p>
    <br />
    <p><?php echo __('Your request has been sent. Please wait !'); ?></p>
    <p><?php //echo __('You can always change your mind. Click cancel'); ?></p>
</div>


<div class="span-9 append-bottom">

    <div class="span-9" id="form-index" >
            <ul id="tabs-form">
                <li><a href="#" class="selected form-tab" id="flight-tab"><?php echo __('Flight'); ?></a></li>
                <li><a href="#" class="form-tab" id="hotel-tab"><?php echo __('Hotel'); ?></a></li>
                <li><a href="#" class="form-tab" id="car-tab"><?php echo __('Car'); ?></a></li>
                <li><a href="#" class="form-tab" id="package-tab"><?php echo __('Package'); ?></a></li>
            </ul>
            <div id="flight-form">
                <?php include_partial('searchFlight/formIndex', array('form' => $flightForm)); ?>
            </div>
            <div id="hotel-form" class="">
                <?php include_partial('searchHotel/formIndex', array('form' => $hotelForm)); ?>
            </div>
            <div id="car-form">
                <?php include_partial('searchCar/formIndex',array('form'=>$carForm)); ?>
            </div>
            <div id="package-form" class="hide">
                <?php include_partial('searchPackage/formIndex',array('form'=>$packageForm)); ?>
            </div>
            
    </div>
    <hr class="space3" />
    <div class="span-9 prepend-top border">
<<<<<<< HEAD

        

        <h2 class="title"><?php echo __('Previous searches'); ?></h2>
        <div class=" span-9">
            <?php for($i=0;$i<5;$i++): ?>
            <table class="prev-searches">
                <tr class="<?php echo (fmod($i, 2) == 0)? 'bg-1': 'bg-2' ?>">
                    <td rowspan="2" style="font-weight: bold;">
                        Flight return
                    </td>

                    <td><a href="#">LAX - JFK</a>

                    <td>&bull; Sep 15 - Sep 17
                    </td>
                    <td rowspan="2" style="width: 60px; text-align: center;">
                        <a>Modify</a><br />
                        
                    </td>
                </tr>
                <tr class="<?php echo (fmod($i, 2) == 0)? 'bg-1': 'bg-2' ?>">
                    <td colspan="2">2 adults, 1 infant</td>
                </tr>
            </table>
            <?php endfor; ?>
        </div>
=======
        <?php include_component('prevSearch', 'index', array()); ?>
        
>>>>>>> release-1.1
    </div>

</div>


<div class="span-16 last append-bottom">

<?php include_component('promotionalBanner', 'index'); ?>
<?php include_component('topdestination', 'index'); ?>

    <div class="span-8 prepend-top append-bottom" id="featureDeals">
        <h2 class="title"><?php echo __('Feature deals'); ?><a href="#" id="featureDeals-rss">RSS</a></h2>
        <?php echo image_tag('tmp/feature_deals.jpg'); ?>
        <select name="featureDeals" class="append-bottom">
            <option>Hypertech selection</option>
            <option>Christmas specials</options>
            <option>Winter breaks specials</options>
            <option>Sunshine deals</option>
        </select>
        <table>
            <tr><td><a>Sheraton Waikiki resort</a></td><td class="bold color2"><?php echo format_currency(rand(267, 999), sfConfig::get('app_currency')); ?></td></tr>
            <tr class="desc">
            <td colspan="2">
                <?php echo image_tag('tmp/feature_deals_1.jpg', array('class'=>'left'));?>
                    <p>Your request has been sent, but you can always change your mind.</p>
            </td>
            </tr>
            <tr><td><a>Europe - Italy</a></td><td class="bold color2"><?php echo format_currency(rand(267, 999), sfConfig::get('app_currency')); ?></td></tr>
            <tr><td><a>Discover South America</a></td><td class="bold color2"><?php echo format_currency(rand(267, 999), sfConfig::get('app_currency')); ?></td></tr>
            <tr class="last"><td><a>Surfing in Hawai</a></td><td class="bold color2"><?php echo format_currency(rand(267, 999), sfConfig::get('app_currency')); ?></td></tr>
        </table>
        <div style="clear:both;"></div>
        <?php //endforeach; ?>
        <ul class="paginator">
            <li><a href="#" class="selected"></a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
        </ul>
    </div>
    <div class="span-8 last prepend-top append-bottom" id="specialInterest">
        <h2 class="title"><?php echo __('Vacations by interest'); ?></h2>
        <?php echo image_tag('tmp/special_interest_1.jpg'); ?>
        <div id="specialInterest-container" class="small">
            <ul>
                <li><a>All inclusive</a></li>
                <li><a>Golf</a></li>
                <li><a>Honeymoons / Wedding</a></li>
                <li><a>Luxary</a></li>
                <li><a>Spa retreat</a></li>
                <li><a>Condominiums</a></li>
                <li><a>Family & kids</a></li>
                <li><a>Winter sports</a></li>
                <li><a>Beach</a></li>
                <li><a>more options</a></li>
            </ul>
        </div>
    </div>
    <div class="span-8 last prepend-top" id="newsletter-signup">
        <h2 class="smaller">Get deals in your inbox!<br />Sign up for Hypertech Email</h2>
        <table>
            <tr>
                <td>
                    <input type="text" name="newsletter_signup" value="enter you email" />
                </td>
                <td>
                    <input type="submit" value="sign in" class="blue small" style="float: left;" />
                </td>
            </tr>
        </table>
        
        
    </div>

    <div class="span-16 shadow bg-white last">
        
    </div>
</div>

    <hr class="space"/>

<div class="span-25 last bg-white no-shadow">
       
</div>

<hr class="space3" />


<script type="text/javascript">

    $('document').ready(function(){

        $('#hotel-form').hide();
        $('#car-form').hide();

        $('#flight-tab').click(function(){
            $('#flight-form').show();
            $('#hotel-form').hide();
            $('#car-form').hide();
            $('#package-form').hide();
            $('.form-tab').each(function(){
                $(this).removeClass('selected');
            });
            $(this).addClass('selected');

        });

        $('#hotel-tab').click(function(){
            $('#flight-form').hide();
            $('#hotel-form').show();
            $('#car-form').hide();
            $('#package-form').hide();
            $('.form-tab').each(function(){
                $(this).removeClass('selected');
            });
            $(this).addClass('selected');
        });

        $('#car-tab').click(function(){
            $('#flight-form').hide();
            $('#hotel-form').hide();
            $('#car-form').show();
            $('#package-form').hide();
            $('.form-tab').each(function(){
                $(this).removeClass('selected');
            });
            $(this).addClass('selected');
        });

        $('#package-tab').click(function(){
            $('#flight-form').hide();
            $('#hotel-form').hide();
            $('#car-form').hide();
            $('#package-form').show();
            $('.form-tab').each(function(){
                $(this).removeClass('selected');
            });
            $(this).addClass('selected');
        });

    });

</script>