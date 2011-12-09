<?php //use_stylesheet('html5/promotionalBanner') ?>
<?php use_stylesheet('jquery.ad-gallery.css') ?>
<?php use_javascript('jquery.ad-gallery.js') ?>

<div id="gallery" class="ad-gallery span-15" style="margin-left: 10px;">
    <div class="ad-image-wrapper box2" style="border: 1px solid white;">
    </div>
    <div class="ad-controls hide">
    </div>
    <div class="ad-nav">
        <div class="ad-thumbs">
            <ul class="ad-thumb-list">
                <li>
                    <a href="/uploads/promotionalBanner/1.jpg">
                        <img src="#" class="image0" title="Las Vegas" alt="" >
                    </a>
                </li>
                <li>
                    <a href="/uploads/promotionalBanner/2.jpg">
                        <img src="#" title="Paris" alt="" class="image1">
                    </a>
                </li>
                <li>
                    <a href="/uploads/promotionalBanner/3.jpg">
                        <img src="#" title="A title for 11.jpg" longdesc="http://coffeescripter.com" alt="This is a nice, and incredibly descriptive, description of the image 11.jpg" class="image2">
                    </a>
                </li>
                <li>
                    <a href="/uploads/promotionalBanner/4.jpg">
                        <img src="#" title="A title for 12.jpg" alt="This is a nice, and incredibly descriptive, description of the image 12.jpg" class="image3">
                    </a>
                </li>
                <li>
                    <a href="/uploads/promotionalBanner/5.jpg">
                        <img src="#" title="A title for 13.jpg" alt="This is a nice, and incredibly descriptive, description of the image 13.jpg" class="image4">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>



<script>
    $('document').ready(function(){

        var galleries = $('#gallery').adGallery({
            'display_back_and_forward': false,
            'width': 608,
            'height': 260,
            'enable_keyboard_move': true,
            effect: 'fade',
            slideshow: {
                enable: false
            }
        });
        
    });

</script>