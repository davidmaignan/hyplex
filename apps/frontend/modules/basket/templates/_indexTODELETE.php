<div id="basket">
    <div class="container">
        <div class="span-25 prepend-top">

            <div class="span-25">

                <div class="span-7">
                    <h2 class="basket"><?php echo __('Your basket'); ?></h2>
                </div>

                <div class="span-13">
                    <ul id="list-icon">
                        <li><?php echo image_tag('icons/flight.png', array('class' => 'list-icon')) ?></li>
                        <li><?php echo image_tag('icons/24-em-plus.png', array('class' => 'list-icon')) ?></li>
                        <li><?php echo image_tag('icons/hotel.png', array('class' => 'list-icon')) ?></li>
                        <li><?php echo image_tag('icons/24-em-plus.png', array('class' => 'list-icon')) ?></li>
                    </ul>
                </div>

                <div class="span-5 last bg1" style="height: 25px;">
                    Your total: $0.00
                </div>
            </div>

            <div clas="span-25">

                <div class="span-7">
                    <ul>
                        <li class="basket-list link-flight selected">
                            <a href="#" onclick="return false;">Flight</a>
                            <span class="sub-total"><?php echo format_currency(1289.35,  sfConfig::get('app_currency')); ?></span>
                        </li>
                        <li class="basket-list link-hotel active">
                            <a href="#" onclick="return false;">Hotel</a>
                            <span class="sub-total"><?php echo format_currency(3299.00,  sfConfig::get('app_currency')); ?></span>
                        </li>
                        <li class="basket-list link-car active">
                            <a href="#" onclick="return false;">Car</a>
                            <span class="sub-total"><?php echo format_currency(590.0,  sfConfig::get('app_currency')); ?></span>
                        </li>
                        <li class="basket-list link-excursion">
                            <a href="#" onclick="return false;">Excursions</a>
                        </li>
                    </ul>
                </div>

                <div class="span-18 bg1 last" id="data-container">

                    <?php //$lorem = new FlightReturnParameters($type, $params, $culture); ?>
                    

                    <div class="padded" style="padding: 10px;">

                        <h3>Fligth information</h3>

                        <table>
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Destination</th>
                                    <th>Date</th>
                                    <th>Passengers</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>
                                        <?php echo $flightDatas['origin']; ?><br />
                                        <?php echo $flightDatas['destination']; ?><br />
                                    </td>
                                    <td>
                                        <?php echo format_date($flightDatas['depart_date'], 'D'); ?><br />
                                        <?php echo format_date($flightDatas['return_date'],'D'); ?><br />
                                    </td>
                                    <td>
                                        <?php echo $flightDatas['number_adults']; ?> adults<br />
                                        <?php echo $flightDatas['number_children']; ?> children<br />
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        

                    </div>

                </div>

            </div>

        </div>
    </div>
    <?php //var_dump($flightDatas); ?>
</div>

<script type="text/javascript">

    $('document').ready(function(){

        $('h2.basket').click(function(){
            $('#basket').animate({
                bottom: '0',
            }, 300, function() {
                // Animation complete.
            });

        });

    });


</script>