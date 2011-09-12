<div class="search-box-list <?php echo $result->class; ?>">
    <div class="airline-line">
        <?php echo html_entity_decode($result->getAirline()) ?>
        <span class=price><?php echo format_currency($result->TotalPrice, 'USD') ?></span>
    </div>
    <div class="search-box-float">
        <?php echo html_entity_decode($result->getAirlineIcon()) ?>
    </div>
    <div class="search-box-float details">
        <span class=airport><?php echo $result->origin ?></span>
        <span class=time><?php echo format_date($result->SegmentOutbound->Departs, 't') ?></span>
        <span class=arrow><?php echo image_tag('iphone/arrow.gif') ?></span>
        <span class=airport><?php echo $result->destination ?></span>
        <span class=time><?php echo format_date($result->SegmentOutbound->Arrives, 't')?></span>
        <span class=stop>
            <?php echo format_number_choice(
                    '[0]0 stop|[1] 1 stop|(1,+Inf]%count% stops',
                    array('%count%' => $result->nbrStopsOutbound),
                    $result->nbrStopsOutbound
                  );
            ?>
        </span>
        <span class=nb-days>
            <?php echo Utils::calculateNbrDays($result->SegmentOutbound->Departs,
                                     $result->SegmentOutbound->Arrives) ?></span>
        <br />
        <span class=airport><?php echo $result->destination ?></span>
        <span class=time><?php echo format_date($result->SegmentInbound->Departs, 't') ?></span>
        <span class=arrow><?php echo image_tag('iphone/arrow.gif') ?></span>
        <span class=airport><?php echo $result->destination ?></span>
        <span class=time><?php echo format_date($result->SegmentInbound->Arrives, 't')?></span>
        <span class=stop>
            <?php echo format_number_choice(
                    '[0]0 stop|[1] 1 stop|(1,+Inf]%count% stops',
                    array('%count%' => $result->nbrStopsInbound),
                    $result->nbrStopsInbound
                  );
            ?>
        </span>
        <span class=nb-days>
            <?php echo Utils::calculateNbrDays($result->SegmentInbound->Departs,
                                     $result->SegmentInbound->Arrives) ?></span>
    </div>
</div>

<div class="flight-details-container">
    <div class="flight-date">
       <?php echo __('Outbound'); ?>
    </div>
    <?php include_partial('segmentOutbound', array('result'=>$result)); ?>
    <div class="flight-date">
       <?php echo __('Inbound'); ?>
    </div>
    <?php include_partial('segmentInbound', array('result'=>$result)); ?>
</div>


<?php

/*
//Outbound
        $datas = $this->Segments['outbound'];

        for ($i = 0; $i < count($datas); $i++) {
            $string .= $this->displayIphoneSegmentDetails($datas[$i], 'Depart');

            //Check if layover to display
            if (count($datas) > 1 && $i < count($datas) - 1) {
                $string .= $this->displayIphoneLayover($datas[$i], $datas[$i + 1]);
            }
            $string .= '<div class=line ></div>';
            $string .= '</div>';
        }

        //$string .= '<div class=line ></div>';
        //Outbound
        $datas = $this->Segments['inbound'];

        for ($i = 0; $i < count($datas); $i++) {
            $string .= $this->displayIphoneSegmentDetails($datas[$i], 'Return');
            if (count($datas) > 1 && $i < count($datas) - 1) {
                $string .= $this->displayIphoneLayover($datas[$i], $datas[$i + 1]);
                //$string .= $this->nbrStopsOutbound;
                //echo "<br />";
                //$string .= $this->nbrStopsInbound;
            }
            $string .= '</div>';
        }

        //$string .= '<div class=line-blue></div>';

        $string .= '</div>';

        return $string;
 *
 *
 */

?>

