<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>

<?php //use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('flightResult'); ?>
<?php use_stylesheet('form'); ?>

<style>
    p{
        font-size: 80%;
    }

    p.entourage{
        border: 1px solid #ddd;
        padding: 10px;
        margin:5px 0;
        -moz-border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px; /* future proofing */
        border-radius: 5px; /* future proofing */
    }

    h2{
        margin:10px 0;
        font-size: 110%;
        color: #0c4878;
    }

    .package td{
        border:0px solid red;
        height: 25px;
        vertical-align: middle;
    }

</style>



<div class="span-5">

    <div class="span-5 shadow bg-white append-bottom">
        <div class="box-1">
            Start search over
        </div>
        <div class="padded">

            <form>
                <h3 style="margin-bottom: 8px; font-size: 90%;">Travel dates</h3>
                <table>
                    <tr>
                        <td style="width: 100px;"><label>Departing</label></td>
                        <td><label>Time</label></td>
                    </tr>
                    <tr>
                        <td><input type="text" style="width: 80px;" /></td>
                        <td>
                            <select>
                                <?php $time = range(0, 24); ?>
                                <?php foreach ($time as $value): ?>
                                    <option><?php echo "$value:00" ?></option>
                                <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px;"><label>Arrival</label></td>
                            <td><label>Time</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" style="width: 80px;" /></td>
                            <td>
                                <select>
                                <?php $time = range(0, 24); ?>
                                <?php foreach ($time as $value): ?>
                                        <option><?php echo "$value:00" ?></option>
                                <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;"><input type="submit" value="update" class="update prepend-top"/></td>
                            </tr>
                        </table>

                    </form>
                </div>

                <div class="box-11">Rooms & Travelers</div>
                <div class="box-2">
                    lorem ipsum
                </div>

            </div>

            <div class="span-5 shadow bg-white">
                <div class="box-1">
                    Filter Results
                </div>
                <div class="box-2">
                    <?php echo image_tag('tmp/slider_price.jpg'); ?>
                </div>
                <div class="box-11">
                    Hotel rating
                </div>
                <div class="box-2">
                <ul id="star-rating">
                    <li><input type="checkbox" />
                    <?php echo image_tag('icons/star_2.png'); ?>
                    </li>
                    <li><input type="checkbox" />
                        <?php echo image_tag('icons/star_2.png'); ?>
                        <?php echo image_tag('icons/star_2.png'); ?>
                    </li>
                    <li><input type="checkbox" />
                    <?php echo image_tag('icons/star_2.png'); ?>
                    <?php echo image_tag('icons/star_2.png'); ?>
                    <?php echo image_tag('icons/star_2.png'); ?>
                    </li>
                    <li><input type="checkbox" />
                    <?php echo image_tag('icons/star_2.png'); ?>
                    <?php echo image_tag('icons/star_2.png'); ?>
                    <?php echo image_tag('icons/star_2.png'); ?>
                    <?php echo image_tag('icons/star_2.png'); ?>
                    </li>
                    <li><input type="checkbox" />
                    <?php echo image_tag('icons/star_2.png'); ?>
                    <?php echo image_tag('icons/star_2.png'); ?>
                    <?php echo image_tag('icons/star_2.png'); ?>
                    <?php echo image_tag('icons/star_2.png'); ?>
                    <?php echo image_tag('icons/star_2.png'); ?>
                    </li>

                </ul>
                    </div>
                <div class="box-11">
                    Hotel name
                </div>
                <div class="box-2">
                    <input type="text" />
                </div>
            </div>

        </div>

        <div class="span-16">

            <div class="span-16 shadow bg-white append-bottom">
                <div class="box-1">
                    <h1>Results for packages from Los Angeles to Honolulu</h1>
                </div
                <div class="box-2">
                    <p class="entourage">2 airplanes tickets, 1 hotel room for 15 nights, 2 adults, 1 car</p>

                    <h2>Select or customize a package</h2>
                    <p>Prices doest not include baggages and extra charges applied by the airline. <a>more information</a></p>
                </div>
                <br />
            </div>

            <div class="span-16 shadow bg-white append-bottom">
                <div class="padded">
                    <ul id="sort-list">
                        <li style="margin-right: 10px;"><?php echo __('Sort by'); ?></li>
                        <li><a id="sort_airline" href="#" class="selected"><?php echo __('Our pick'); ?></a></li>
                        <li><a id="sort_takeoff" href="#" class=""><?php echo __('Price'); ?></a></li>
                        <li><a id="sort_landing"  href="#" class=""><?php echo __('Hotel name'); ?></a></li>
                        <li><a id="sort_stops" href="#" class=""><?php echo __('Star rating'); ?></a></li>
                        <li style="float: right;">75 packages found</li>
                    </ul>
                </div>
            </div>
    <?php for ($i = 0; $i < 10; $i++): ?>
                                            <div class="span-16 shadow bg-white append-bottom">
                                                <div class="box-3">
                                                    <table class="package" style="width: 100%;">
                                                        <tr>
                                                            <td style="font-size:80%; padding-right: 50px;">Hotel, flight and car package</td>
                                                            <td style="font-size:80%;text-align: right;">Average per person</td>
                                                            <td style="font-size:100%;text-align: right; padding-right: 10px;">$1,249</td>
                                                            <td>&bull;</td>
                                                            <td style="font-size:80%;text-align: right;">Total</td>
                                                            <td style="font-size:120%; text-align: right;">$2,498</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="padded">
            <?php echo image_tag('tmp/package.jpg'); ?>
                                        </div>

                                    </div>
    <?php endfor; ?>




                                        </div>


                                        <div class="span-4 bg1 last">

                                            <div class="span-4 shadow bg-white">
                                                <div class="padded">
                                                    <a href="#">Back to search result</a>
                                                    <a href="#">Start search over</a>
                                                </div>

        <?php echo image_tag('tmp/hotel_left.jpg'); ?>
    </div>



</div>




<div style="clear: both;"></div>