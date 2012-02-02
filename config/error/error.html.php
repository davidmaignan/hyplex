<?php include '../lib/vendor/symfony/lib/helper/I18NHelper.php' ?>
<?php include '../lib/vendor/symfony/lib/helper/UrlHelper.php' ?>
<?php include '../lib/vendor/symfony/lib/helper/PartialHelper.php' ?>
<?php include '../lib/vendor/symfony/lib/helper/AssetHelper.php' ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="title" content="Hypertech Solutions - Demo site" />
        <meta name="description" content="This is a demo site for Plex travel API" />
        <title>Hypertech Solutions - Demo site</title>
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="stylesheet" type="text/css" media="screen" href="/css/screen.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/css/custom.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/css/header.css" />

    </head>

    <body>

        <div id="top-header">
            <div class="container">
                <nav id="top-nav" class="span-15">
                    <h2 class="hide">Top navigation</h2>
                    <a href="#" title="#">News</a>
                    <a href="/en_US/feature-deals" title="Feature deals">Feature deals</a>
                    <a href="#" title="#">Top destinations</a>

                    <a href="#" title="#">Vacations by interest</a>        
                </nav>
                <div id="language" class="span-3">
                    <ul>
                        <li class="selected"><img width="16px" height="11px" src="/images/icons/en_US.png" /> english</li>

                        <li class="hide"><a href="/zh_CN/">
                                <img width="16px" height="11px" src="/images/icons/zh_CN.png" /> 中文 </a></li>


                        <li class="hide"><a href="/fr_FR/">
                                <img width="16px" height="11px" src="/images/icons/fr_FR.png" /> francais </a></li>

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
                    <a href="/en_US/signin" title="login">Login</a>
                    </p>

                </div>
            </div>
        </div>

        <section id="header">
            <div class="span-12"><a href="/en_US/" title="#">
                    <h2 id="logo">Logo</h2>
                </a></div>

            <div class="span-6 last">
            </div>

            <div class="span-4 last right" id="phoneInfo"><p class="right" id="phoneBox">1 800 123 1234</p></div>
        </section>

        <div style="clear: both"></div>

        <div class="container">
            <nav id="main-nav">
                <h2>Main navigation</h2>
                <a href="/en_US/search/flight/">Flight</a>	<a href="/en_US/search/hotel/">Hotel</a>	<a href="/en_US/search/car/">Car</a>	<a href="/en_US/search/package/">Package</a>	<a class="right" href="/en_US/basket">Basket</a>	<a class="right" href="/en_US/my-account/">Account</a></nav>

        </div>

        <div class="container prepend-top">

            <h1><?php echo __('An error has occured'); ?></h1>
            <p><?php echo __('Something is broken'); ?></p>
            <p><?php echo __('Please e-mail us at issues@hypertech.com and let us know what you were doing when this error occurred. We will fix it as soon as possible. Sorry for any inconvenience caused.'); ?></p>


        </div>



    </body>

</html>