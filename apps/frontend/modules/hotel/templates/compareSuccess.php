<h1><?php __('Hotel Comparison') ?></h1>

<table id="hotelComparison">
    
        <tr>
            <td></td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="center"><?php echo image_tag($hotel->getBaseLinkImage()); ?></td>
            <?php endforeach; ?>
        </tr>
        <tr class="odd">
            <td></td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="center bigger blue2">
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
            <td class="center"><?php echo html_entity_decode(HotelGenericObj::getStarRating($hotel->starRating)); ?></td>
        <?php endforeach; ?>
        </tr>
         <tr class="odd">
            <td class="middle">Restaurant</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="center"><?php echo Utils::getIconCheckCross($hotel->hotelFacilities['Parking']) ?></td>
            <?php endforeach; ?>
        </tr>
         <tr>
             <td class="middle">Pool</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="center"><?php echo Utils::getIconCheckCross($hotel->hotelFacilities['Pool']) ?></td>
        <?php endforeach; ?>
        </tr>
        <tr class="odd">
             <td class="middle">Internet</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="center"><?php echo Utils::getIconCheckCross($hotel->hotelFacilities['Internet Access']) ?></td>
        <?php endforeach; ?>
        </tr>
         <tr>
             <td class="middle">Parking</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="center"><?php echo Utils::getIconCheckCross($hotel->hotelFacilities['Parking']) ?></td>
        <?php endforeach; ?>
        </tr>
        <tr class="odd">
             <td class="middle">Fitness center</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="center"><?php echo Utils::getIconCheckCross($hotel->hotelFacilities['Fitness Center']) ?></td>
        <?php endforeach; ?>
        </tr>

        <?php $jeton = 1; ?>

        <?php foreach($arHotels[0]->numRooms as $key=>$room): ?>

        <tr class="<?php echo (fmod($jeton, 2) == 0)? 'odd': ''; $jeton++;?>">
            <td class="middle">
                <?php echo $room; ?>
            </td>

            <?php foreach ($arHotels as $hotel): ?>
                <td style="padding: 0;" class="center">
                    <table class="prices">
                        <tr>
                            <td class="style1 middle">min</td>
                            <td class="bigger">
                                <?php echo Utils::getPrice($hotel->arMinMaxPrice[$room]['min']); ?>
                            </td>
                            <td class="style1"></td>
                        </tr>
                         <tr>
                             <td class="style1 middle">max</td>
                             <td class="bigger">
                                <?php echo Utils::getPrice($hotel->arMinMaxPrice[$room]['max']); ?>
                            </td>
                            <td class="style1"></td>
                        </tr>
                    </table>
                </td>
            <?php endforeach; ?>
        </tr>

        <?php endforeach; ?>


        <tr class="<?php echo (fmod($jeton, 2) == 0)? 'odd': ''; $jeton++;?>">
            <td class="middle">Number of rates offered</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="bigger blue center"><?php echo $hotel->getNumberRates(); ?></td>
        <?php endforeach; ?>
        </tr>
        <tr class="<?php echo (fmod($jeton, 2) == 0)? 'odd': ''; $jeton++;?>">
            <td class="middle">Review score</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="biggest blue1 center bold"><?php echo rand(55, 85)/10; ?></td>
        <?php endforeach; ?>
        </tr>
        <tr class="<?php echo (fmod($jeton, 2) == 0)? 'odd': ''; $jeton++;?>">
            <td class="middle">Number of review</td>
            <?php foreach ($arHotels as $hotel): ?>
            <td class="big blue1 center"><?php echo rand(555, 855); ?> reviews</td>
        <?php endforeach; ?>
        </tr>


        <?php
            //Create array to hold alphabet so we display amenities in front of each other
            // so rollover for amenities gets improved.
            $arAlphabet = array();
            $arHotelsFacilities = array();
            foreach ($arHotels as $hotel){
                foreach($hotel->getFullFacilitiesListSorted() as $facility){
                    array_push($arAlphabet, $facility[0]);
                }
                array_push($arHotelsFacilities, $hotel->getFullFacilitiesListSorted());
            }

            $arAlphabet = array_unique($arAlphabet);
            sort($arAlphabet);

        ?>

        <tr class="<?php echo (fmod($jeton, 2) == 0)? 'odd': ''; $jeton++;?>">
            <td style="vertical-align: top;">Hotel facilities</td>

            <?php foreach ($arHotels as $hotel): ?>

            <td style="text-align: left; vertical-align: top;">
                <ul>
                    <?php foreach($hotel->getFullFacilitiesListSorted() as $facility): ?>  
                        <li class="facilities <?php echo (preg_match('#free#i', $facility)>0)?'green':''; ?>">&bull; <?php echo $facility; ?></li>
                    <?php endforeach; ?>
                </ul>

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