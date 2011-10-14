
<table class="basket-flight">
    <tr>
        <td style="vertical-align: middle;"><img src="/images/mobico/flight.png" /></td>
        <td>
            LAX Los Angeles [CA], USA <br />
            DFW Dallas [TX], USA
        </td>
        <td class="smaller">
            Depart:<br />
            Return:
        </td>
        <td>
            Tuesday, November 1, 2011 <br />
            Tuesday, November 8, 2011 
        </td>
        <td style="text-align: right">
            8:00 AM<br />
            12:30 PM
        </td>
        <td style="text-align: right" class="bold"><?php echo format_currency(rand(1999,12999),  sfConfig::get('app_currency')) ?></td>
    </tr>
    <tr>
        <td style="vertical-align: middle;"><img src="/images/mobico/hotel.png" /></td>
        <td>
            La Quinta Inn Dallas Grand Prairie<br />
            4 nights, 2 rooms
        </td>
        <td class="smaller">
            Checkin:<br />
            Checkout:
        </td>
        <td colspan="2">
            Tuesday, November 1, 2011  <br />
            Tuesday, November 8, 2011
        </td>
        <td style="text-align: right" class="bold"><?php echo format_currency(rand(1999,12999),  sfConfig::get('app_currency')) ?></td>
    </tr>
    <tr>
        <td style="vertical-align: middle;"><img src="/images/mobico/car.png" /></td>
        <td>
            1 economy car  <br />
            GPS, child seat, 2nd driver
        </td>
        <td class="smaller">
            Pick up:<br />
            Drop off:
        </td>
        <td colspan="2">
            Tuesday, November 1, 2011  <br />
            Tuesday, November 8, 2011
        </td>
        <td style="text-align: right" class="bold"><?php echo format_currency(rand(1999,12999),  sfConfig::get('app_currency')) ?></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td  colspan="2" class="bold"  style="text-align: right">Total</td>
        <td class="total bigger" style="width: 100px;"><?php echo format_currency(rand(1999,12999),  sfConfig::get('app_currency')) ?></td>
    </tr>
</table>
