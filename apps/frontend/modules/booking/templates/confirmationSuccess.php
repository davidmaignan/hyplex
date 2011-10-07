<?php use_helper('Date','Number','I18n','Text'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>
<?php use_stylesheet('custom-theme/jquery-ui-1.8.16.custom.css'); ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>

<?php use_javascript('jquery-1.6.2.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.16.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>


<style>
    .confirmation{
        color: #454545;
        font-size: 80%;
    }

    .confirmation td{
        padding:7px 0 7px;
    }

    .confirmation td.icon{
        width: 40px;
        vertical-align: middle;
    }

    .confirmation tr.title td{
        font-weight: bold;
        padding: 15px 0 7px;
        font-size: 110%;
    }

    #confirmation li{
        padding-bottom: 6px;
    }

    .border-bottom{
        border-bottom: 1px solid #dedecf;
    }

    .big{
        font-size: 110%;
    }

    .bigger{
        font-size: 130%;
    }

    #confirmation td.dotted{
        background: url('/images/dot.gif') repeat-x left 14px;
    }

    #confirmation td.price{
        width: 200px;
        text-align: right;
        background: url('/images/dot.gif') repeat-x left 14px;
    }

    #confirmation td.dotted span{
        background-color: white;
        padding-right: 14px;
    }

    #confirmation td.price span{
        background-color: white;
        padding-left: 14px;
    }

    .total{
        font-size: 140%;
        width: 220px;
        text-align: right;
    }

    dl {
        
    }

    dl dt {
        float:left;
        font-weight:bold;
        margin-right:10px;
        padding:5px;
        width:150px;
    }

    dl dd {
        margin:2px 0;
        padding:5px 0;
    }


</style>
<hr class="space3" />
<div class="span-7">

   <?php include_component('basket', 'checkOut'); ?>

</div>

<div class="span-18 last">

    

    <h2 class="title"><?php echo ucfirst(__('Details of your trip')) ?></h2>

    <table id="confirmation" class="confirmation">
        <tr>
            <td class="icon">
                <?php echo image_tag('icons/flight.png'); ?>
            </td>
            <td>
                <ul>
                    <li class="blue big">Flight from New York to Honolulu</li>
                    <li class="">4 round trip tickets for 3 adults, 1 child and 1 infant</li>
                </ul>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td class="icon">
                <?php echo image_tag('icons/hotel.png'); ?>
            </td>
            <td>
                <ul>
                    <li class="blue big">Hotel Hyatt regency Waikiki resort & Spa in honolulu</li>
                    <li class="">2 rooms for 7 nights</li>
                </ul>
            </td>
            <td>

            </td>
        </tr>
        <tr class="border-bottom">
            <td class="icon">
                <?php echo image_tag('icons/car.png'); ?>
            </td>
            <td>
                <ul>
                    <li class="blue big">Economy car - Hertz</li>
                    <li class="">2 cars for 7 nights</li>
                </ul>


            </td>
            <td>

            </td>
        </tr>
        <tr class="title">
            <td colspan="3">Travel protection plan</td>
        </tr>
        <tr>
            <td colspan="2" class="dotted">
                <span>Hypertech protection plan plus</span>
            </td>
            <td class="price"><span>$ 599.99</span></td>
        </tr>
        <tr class="title">
            <td colspan="3">Ground transportation to and From your hotel</td>
        </tr>
        <tr>
            <td colspan="2" class="dotted">
                <span> Airport shuffle transfert (roundtrip)</span>
            </td>
            <td class="price"><span>$ 199.99</span></td>
        </tr>
        <tr class="title">
            <td colspan="3">Hotel extra and dining plans</td>
        </tr>
        <tr>
            <td colspan="2" class="dotted">
                <span>internet access - 1 room (7 days)</span>
            </td>
            <td class="price"><span>$ 199.99</span></td>
        </tr>
        <tr>
            <td colspan="2" class="dotted">
                <span>Champagne bottle (1 room on Sunday, Feb 14, 2011)</span>
            </td>
            <td class="price"><span>$ 49.99</span></td>
        </tr>
        <tr>
            <td colspan="2" class="dotted">
                <span>Continental breakfast (4 travelers for 7 days)</span>
            </td>
            <td class="price"><span>$ 1299.99</span></td>
        </tr>
        <tr class="title">
            <td colspan="2">Activities</td>
        </tr>
        <tr>
            <td colspan="2" class="dotted">
                <span>Champagne bottle (2 travelers on Sunday, Feb 14, 2011)</span>
            </td>
            <td class="price"><span>$ 99.99</span></td>
        </tr>
        <tr>
            <td colspan="2" class="dotted">
                <span>3 days City power pass (3 adults, 1 child)</span>
            </td>
            <td class="price"><span>$ 330.00</span></td>
        </tr>
        <tr>
            <td colspan="2" class="dotted">
                <span>City circus (3 adults, 1 child on Feb, 18 2010)</span>
            </td>
            <td class="price"><span>$ 135.50</span></td>
        </tr>
   </table>
   <table class="confirmation prepend-top" style="border-top: 1px solid #dedecf;">
        <tr>
            <td>
                <ul>
                    <li style="padding-bottom: 5px;">
                        <span class="bold">Prices include:</span> Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                        accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                        inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                    </li>
                    <li>
                        <span class="bold">Prices doest not include:</span> Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                        accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                        inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                    </li>
                </ul>
            </td>
            <td class="price total">
                 <dl>
                        <dt class="smaller">Total: </dt>
                        <dd style="width: 300px;" class="bigger">$9.999,00</dd>
                        <dt class="smaller"  style="font-weight: normal;">per person: </dt>
                        <dd class="smaller">$9.999,00</dd>
                 </dl>

            </td>
        </tr>

    </table>

    <hr class="space3" />

    <h2 class="title">Travelers</h4>

        <table class="confirmation">
            <?php for($i=0;$i<4;$i++): ?>
            <tr class="border-bottom">
                <td style="width: 200px;">Mr David Maignan</td>
                <td style="width: 250px;">Birth date: 10/07/1973</td>
                <td style="text-align: right;">
                    <dl>
                        <dt>Frequent Flyer Number: </dt>
                        <dd>123456789</dd>

                        <dt>Airline: </dt>
                        <dd>Air canada</dd>
                    </dl>
                </td>
            </tr>
            <?php endfor; ?>
        </table>


</div>





<hr class="space3" />