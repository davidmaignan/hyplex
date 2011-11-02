<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>
<?php //use_javascript('jquery.maskedinput.js');?>

<?php require_once sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'search'.DIRECTORY_SEPARATOR.'variables.php'; ?>

<?php //use_javascript('search/airport_list_'.$sf_user->getCulture().'.js'); ?>
<?php use_javascript('culture/datepicker_'.$sf_user->getCulture().'.js'); ?>

<?php //use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php //use_javascript('debugger/myLogger.js'); ?>

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
        <?php include_component('prevSearch', 'index', array()); ?>
    </div>

</div>


<div class="span-16 last append-bottom">

<?php include_component('promotionalBanner', 'index'); ?>
<?php include_component('topdestination', 'index'); ?>
<?php include_component('promotionalBanner','featureDealsIndex'); ?>

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
        <h2 class="smaller">
            <?php echo __('Get deals in your inbox!') ?><br />
            <?php echo __('Sign up for Hypertech E-promotions') ?><br /></h2>
        <table>
            <tr>
                <td>
                    <input type="text" name="newsletter_signup" value="enter you email" />
                </td>
                <td>
                    <input type="submit" value="<?php echo ucwords( __('sign in')) ?>" class="blue small" style="float: left;" />
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