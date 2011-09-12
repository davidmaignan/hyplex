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



<style>
    #basket{
        position: absolute;
        bottom: -310px;
        abottom: 0px;
        background-color: white;
        z-index: auto;
        width: 100%;
        height: 350px;
        display: block;
        -moz-box-shadow: -2px 0px 0px #000;
        -webkit-box-shadow: 0px 0px 0px #333;
        box-shadow: 0px 0px 0px #333;
        position: fixed;
        border-top: 2px solid #aaa;
        padding:0;
        display: none;
    }

    #basket h2{
        color:#0c4878;
    }

    #basket h3{
        color: #0c4878;
        margin-bottom: 5px;
        padding-bottom: 7px;
        
        background: url('/images/generic/bg_line.gif') repeat-x left bottom;
    }

    #basket li.basket-list{
        height: 32px;
        display: block;
        background-color: #f8f8f6;
        padding: 5px;
        padding-left: 35px;
        line-height: 30px;
        border-bottom: 1px solid white;
    }

    li.link-flight{
        background: url('/images/icons/flight.png') no-repeat 10px 10px;
    }

    li.link-hotel{
        background: url('/images/icons/hotel.png') no-repeat 10px 10px;
    }

    li.link-car{
        background: url('/images/icons/car.png') no-repeat 10px 10px;
    }

    li.link-excursion{
        background: url('/images/icons/excursion.png') no-repeat 10px 10px;
    }

    #basket li.selected{
        background-color: #beddf8;
    }

    #basket li.active{
        background-color: #deded0;
    }


    #list-icon{
        margin:0;
        margin-left: 30px;
        padding:0;
    }

    #list-icon li{
        display: block;
        float: left;
        margin-right: 40px;
    }

    #data-container{
        background-color: #e0edf8;
        display: block;
        
    }

    .sub-total{
        float: right;
        color: #0c4878;
        font-weight: bold;
        font-size: 80%;
        letter-spacing: .02em;
    }

    #data-container table{
        width: 100%;
        line-height: 20px;
        font-size: 90%;
    }

    #data-container  th, #data-container td{
        text-align: left;
        
        padding: 3px 0px;
        font-size: 90%;
        font-weight: bold;
    }

    #data-container td{
        background: none;
        font-weight: normal;
    }


</style>

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