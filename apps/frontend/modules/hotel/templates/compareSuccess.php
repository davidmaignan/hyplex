<?php use_helper('Date', 'Number', 'I18n', 'Text'); ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<h1><?php ucfirst(__('Hotel Comparison')) ?></h1>

<style>
    #hotelComparison td{
        padding:10px 5px;
        border: 0px solid #aaa;
        font-size: 80%;
        text-align: center;
        vertical-align: middle;
        line-height: 18px;
        border-right: 1px dotted #a3b9cb;
    }
    

    #hotelComparison a{
        font-weight: bold;
    }

    #hotelComparison table.prices td.style1{
        width: 30px;
        font-size: 70%;
    }

    #hotelComparison table.prices td.style2{
        font-size: 130%;
        color:#0c4878;
        letter-spacing: .2px;
    }

    #hotelComparison .style2{
        font-size: 130%;
        color:#0c4878;
    }

    #hotelComparison .style3{
        font-size: 110%;
        font-weight: bold;
        color:#4c4c4c;
    }


    #hotelComparison .style4{
        font-size: 90%;
        color:#4c4c4c;
    }

    #hotelComparison td.bordered{
        border-top: 1px dotted #a3b9cb;
    }


    #hotelComparison table.prices td{
        font-size: 100%;
        padding:10px 5px;
        border: none;
        border-collapse: collapse;
        border-top: 1px dotted #a3b9cb;
    }

    .facilities.hover{
        background-color: #f2bad3;
    }

    .facilites.green{
        
    }

    #hotelComparison tr td ul li.green{
        color: #ed145b;
        font-weight: bold;
    }

</style>

<table id="hotelComparison">
    
        <tr>
            <td></td>
            <?php foreach ($arHotels as $hotel): ?>
            <td><?php echo image_tag($hotel->getBaseLinkImage()); ?></td>
            <?php endforeach; ?>
        </tr>
        <tr class="odd">
            <td></td>
            <?php foreach ($arHotels as $hotel): ?>
            <td>
                <?php
                echo link_to2($hotel->getName(), 'hotel_detail',
                        array('slug' => Utils::slugify($hotel->getName())),
                        array('class' => 'hotelNameDetailAjaxLink'));
                ?>
            </td>
        <?php endforeach; ?>
        </tr>
         <tr>
            <td></td>
            <?php foreach ($arHotels as $hotel): ?>
            <td><?php echo html_entity_decode(HotelGenericObj::getStarRating($hotel->starRating)); ?></td>
        <?php endforeach; ?>
        </tr>
         <tr class="odd">
            <td>Restaurant</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td><?php echo Utils::getIconCheckCross($hotel->hotelFacilities['Parking']) ?></td>
            <?php endforeach; ?>
        </tr>
         <tr>
             <td>Pool</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td><?php echo Utils::getIconCheckCross($hotel->hotelFacilities['Pool']) ?></td>
        <?php endforeach; ?>
        </tr>
        <tr class="odd">
             <td>Internet</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td><?php echo Utils::getIconCheckCross($hotel->hotelFacilities['Internet Access']) ?></td>
        <?php endforeach; ?>
        </tr>
         <tr>
             <td>Parking</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td><?php echo Utils::getIconCheckCross($hotel->hotelFacilities['Parking']) ?></td>
        <?php endforeach; ?>
        </tr>
        <tr class="odd">
             <td>Fitness center</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td><?php echo Utils::getIconCheckCross($hotel->hotelFacilities['Fitness Center']) ?></td>
        <?php endforeach; ?>
        </tr>

        <?php $jeton = 1; ?>

        <?php foreach($arHotels[0]->numRooms as $key=>$room): ?>

        <tr class="<?php echo (fmod($jeton, 2) == 0)? 'odd': ''; $jeton++;?>">
            <td>
                <?php echo $room; ?>
            </td>

            <?php foreach ($arHotels as $hotel): ?>
                <td style="padding: 0;">
                    <table class="prices">
                        <tr>
                            <td class="style1">min</td>
                            <td class="style2">
                                <?php echo format_currency($hotel->arMinMaxPrice[$room]['min'], sfConfig::get('app_currency')); ?>
                            </td>
                            <td class="style1"></td>
                        </tr>
                         <tr>
                             <td class="style1">max</td>
                             <td class="style2">
                                <?php echo format_currency($hotel->arMinMaxPrice[$room]['max'], sfConfig::get('app_currency')); ?>
                            </td>
                            <td class="style1"></td>
                        </tr>
                    </table>
                </td>
            <?php endforeach; ?>
        </tr>



        <?php endforeach; ?>


        <tr class="<?php echo (fmod($jeton, 2) == 0)? 'odd': ''; $jeton++;?>">
            <td>Number of rates offered</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="style2 bordered"><?php echo $hotel->getNumberRates(); ?></td>
        <?php endforeach; ?>
        </tr>
        <tr class="<?php echo (fmod($jeton, 2) == 0)? 'odd': ''; $jeton++;?>">
            <td>Review score</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="style3"><?php echo rand(55, 85)/10; ?></td>
        <?php endforeach; ?>
        </tr>
        <tr class="<?php echo (fmod($jeton, 2) == 0)? 'odd': ''; $jeton++;?>">
            <td>Number of review</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="style4"><?php echo rand(555, 855); ?> reviews</td>
        <?php endforeach; ?>
        </tr>
        <tr class="<?php echo (fmod($jeton, 2) == 0)? 'odd': ''; $jeton++;?>">
            <td style="vertical-align: top;">Hotel facilities</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td style="text-align: left; vertical-align: top;">

                <ul>
                    <?php foreach($hotel->getFullFacilitiesListSorted() as $facility): ?>
                        
                    <li class="facilities <?php echo (preg_match('#free#i', $facility)>0)?'green':''; ?>">&bull; <?php echo $facility; ?></li>
                       
                    <?php endforeach; ?>
                </ul>

                <?php //var_dump($hotel->getFullFacilitiesListSorted()); ?>

            </td>
        <?php endforeach; ?>
        </tr>
</table>

<script type="text/javascript">


$('document').ready(function(){

        //Function when roll over facilities
        $('.facilities').hover(function(){
            var value = $(this).html();
            $('.facilities').each(function(){
                if($(this).html() == value){
                    $(this).addClass('hover');
                }
            });

        }, function(){
            $('.facilities').removeClass('hover');
        });
});

</script>