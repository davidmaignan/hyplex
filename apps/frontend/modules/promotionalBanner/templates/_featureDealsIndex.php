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
                <?php echo image_tag('tmp/feature_deals_1.jpg', array('class' => 'left')); ?>
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