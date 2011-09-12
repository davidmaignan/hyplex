<?php use_helper('Date', 'Number'); ?>

<div id="my-searches">


<ul id="header"  class="bg-light">
    <li><?php echo image_tag('iphone/logo_min.png', array('alt' => 'H', 'id' => 'logo')); ?></li>
    <li class="title">Previous searches</span</li>
    <li><a href="#" id="previousSearch-home" title="history" class="home">Home</a></li>
</ul>

<?php for($i=0;$i<5;$i++): ?>

<div class="search-box">
    <div class="search-box-list first">
        <div class="search-box-float icon">
        <?php echo image_tag('icons/flight.png', array('alt' => 'Flight')); ?>
        </div>
        <div class="search-box-float summary">
            YYZ to TXL - 
            <?php echo format_date(date('Y-m-d', strtotime('+1day')), 'D'); ?>
            - <?php echo format_date(date('Y-m-d', strtotime('+7day')), 'D'); ?>
        </div>
    </div>

    <div class="prev-box-list">
        <div class="search-box-float">
            <?php echo image_tag('airlines/delta.png', array('alt' => 'AA', 'class' => 'airline')); ?>
        </div>
         <div class="search-box-float details">
            <span class="airport">YYZ</span>
            <span class="time">10:30 am</span>
            <span class="arrow"><?php echo image_tag('iphone/arrow.gif'); ?></span>
            <span class="airport">YYZ</span>
            <span class="time">10:30 am</span><br />
            <span class="airport">YYZ</span>
            <span class="time">10:30 am</span>
            <span class="arrow"><?php echo image_tag('iphone/arrow.gif'); ?></span>
            <span class="airport">YYZ</span>
            <span class="time">10:30 am</span>
        </div>
         <div class="search-box-float" style="text-align: center; float: right;">
            <span class="price"><?php echo format_currency('2415', '$'); ?></span><br />
            <span class="stop">1 stop</span>
        </div>
    </div>
</div>

<?php endfor; ?>

</div>