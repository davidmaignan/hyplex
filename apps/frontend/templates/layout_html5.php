<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <title>Hyplexdemo - HTML 5 templates</title>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    </head>
    
    <body>
        <h1 class="body">Hyplexdemo website</h1>
        <div id="top-header">
            <div class="container">
                <nav id="top-nav" class="span-15">
                    <h2>Top navigation</h2>
                    <a href="#" title="#">News</a>
                    <a href="#" title="#">Feature deals</a>
                    <a href="#" title="#">Top destinations</a>
                    <a href="#" title="#">Vacations by interest</a>        
                </nav>
                <?php use_helper('I18nUrl') ?>
                <div id="language" class="span-3">
                    <ul>
                        <li class="selected"><?php echo image_tag('icons/' . $sf_user->getCulture() . '.png', array('width'=> '16px','height'=>'11px')) . ' '. Utils::$language[$sf_user->getCulture()]; ?></li>
                        <?php foreach (sfConfig::get('app_languages_available') as $language): ?>
                            <?php if($sf_user->getCulture() != $language): ?>

                                    <li class="hide"><a href="<?php echo localized_current_url($language); ?>">
                                    <?php echo image_tag('icons/' . $language . '.png',array('width'=> '16px','height'=>'11px')).
                                    ' '. Utils::$language[$language];?> </a></li>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div id="currency" class="span-3">
                    <ul>
                        <li class="selected">USD</li>
                        <li class="hide"><a href="#">CAD</a></li>
                        <li class="hide"><a href="#">EURO</a></li>
                    </ul>
                </div>
                <div class="span-3" id="login">
                    <a href="#" title="#">Login</a>
                    </p>
                </div>
            </div>
        </div>

        <section id="header">
            <div class="span-12">
                <a href="<?php echo url_for('@homepage') ?>" title="#"><h2 id="logo">Logo</h2></a>
            </div>
            
            <div class="span-6 last">
                <?php if(sfConfig::get('sf_web_debug')): ?>
                <ul class="none">
                    <li>sTId: <?php echo truncate_text($sf_user->getAttribute('sTId'),20) ?></li>
                    <li>Renew sTId in:<?php echo ($sf_user->getAttribute('sTId_time')-time()); ?> seconds<li>
                    <li>Folder: <?php $folder = explode('/', sfConfig::get('sf_user_folder')); echo $folder[count($folder)-1] ?></li>
                </ul>
                <?php endif; ?>

            </div>
            <div class="span-4 last right" id="phoneInfo">
                <p class="right" id="phoneBox">1 800 123 1234</p>
            </div>
        </section>

        <div style="clear: both"></div>

        <div class="container">
            <nav id="main-nav">
                <h2>Main navigation</h2>
                <?php echo link_to(__('Flight'), 'search_flight') ?>
                <?php echo link_to(__('Hotel'), 'search_hotel') ?>
                <?php echo link_to(__('Car'), 'search_car') ?>
                <?php echo link_to(__('Package'), 'search_package') ?>
                <?php echo link_to(__('Basket'), 'basket', array(), array('class'=>'right')) ?>
                <?php echo link_to(__('Account'), 'search_package', array(), array('class'=>'right')) ?>
            </nav>
        </div>

        <div class="container prepend-top">
            <?php echo $sf_content; ?>
        </div>
        
        <footer id="main-footer">
            <div class="container" style="height: 327px;">
                <section id="footer-deals" class="span-8">
                    
                    <h2 class="section">Latest deals</h2>
                    <article class="foot-deal">
                        <div class="img">
                            <?php echo image_tag('tmp/hawaii.png') ?>
                        </div>
                        <div class="desc">
                            <h2>Mexico</h2>
                            <p>4 nights in 4 stars for 2 adults, lorem ipsum etc</p>
                        </div>
                        <div class="price"><?php echo Utils::getPrice(199) ?></div>
                    </article>
                    <article class="foot-deal">
                        <div class="img">
                            <?php echo image_tag('tmp/hawaii.png') ?>
                        </div>
                        <div class="desc">
                            <h2>Mexico</h2>
                            <p>4 nights in 4 stars for 2 adults, lorem ipsum etc</p>
                        </div>
                        <div class="price"><?php echo Utils::getPrice(199) ?></div>
                    </article>
                    <article class="foot-deal">
                        <div class="img">
                            <?php echo image_tag('tmp/hawaii.png') ?>
                        </div>
                        <div class="desc">
                            <h2>Mexico</h2>
                            <p>4 nights in 4 stars for 2 adults, lorem ipsum etc</p>
                        </div>
                        <div class="price"><?php echo Utils::getPrice(199) ?></div>
                    </article>
                    <article class="foot-deal">
                        <div class="img">
                            <?php echo image_tag('tmp/hawaii.png') ?>
                        </div>
                        <div class="desc">
                            <h2>Mexico</h2>
                            <p>4 nights in 4 stars for 2 adults, lorem ipsum etc</p>
                        </div>
                        <div class="price"><?php echo Utils::getPrice(199) ?></div>
                    </article>
                </section>
                <section id="latest-news" class="span-8 hidden">
                    <h2 class="section">Latest News</h2>
                    <article>
                        <h2>Lorem ipsum lactoseum</h2>
                        <p>Instant package savings! Save $400 when you book a 6+ night package to Nassau by 11/21!</p>
                    </article>
                    <article>
                        <h2>Autumn Sales</h2>
                        <p>Fall in love with New York City! Save up to 30% on packages through November 16!</p>
                    </article>
                    <article>
                        <h2>Lorem ipsum lactoseum</h2>
                        <p>Instant package savings! Save $400 when you book a 6+ night package to Nassau by 11/21!</p>
                    </article>
                    <article>
                        <h2>Autumn Sales</h2>
                        <p>Fall in love with New York City! Save up to 30% on packages through November 16!</p>
                    </article>
                </section>
                <section class="span-4">
                    <h2 class="section">More sections</h2>
                    <ul class="prepend-top1">
                        <li><a href="#" title="#">All inclusive</a></li>
                        <li><a href="#" title="#">Collections</a></li>
                        <li><a href="#" title="#">Discovery</a></li>
                        <li><a href="#" title="#">Romance</a></li>
                        <li><a href="#" title="#">Pursuits</a></li>
                    </ul>
                    <hr class="space" />
                    <h2 class="section prepend-top">Updates</h2>
                    <ul class="prepend-top1">
                        <li class="rss"><a href="#">RSS feeds</a></li>
                        <li class="twitter"><a href="#">Hypertech on Twitter</a></li>
                        <li class="facebook"><a href="#">Hypertech on Facebook</a></li>
                        <li class="newsletter"><a href="#">E-newsletters</a></li>
                    </ul>
                </section>
                <section class="span-4 last">
                    <h2 class="section">About us</h2>
                    <ul class="prepend-top1">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">My bookings</a></li>
                        <li><a href="#">Advertise</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Feedback</a></li>
                        <li><a href="#">Mobile version</a></li>
                    </ul>
                </section>
            </div>
            <div class="container text-right">
                &copy; Hypertech Solutions
            </div>
        </footer>

    </body>
</html>
