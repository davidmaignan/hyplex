<!doctype html>

<?php $path = sfConfig::get('sf_relative_url_root', preg_replace('#/[^/]+\.php5?$#', '', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : ''))) ?>

<?php include '../lib/vendor/symfony/lib/helper/I18NHelper.php' ?>
<?php include '../lib/vendor/symfony/lib/helper/UrlHelper.php' ?>
<?php include '../lib/vendor/symfony/lib/helper/PartialHelper.php' ?>
<?php include '../lib/vendor/symfony/lib/helper/AssetHelper.php' ?>

<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="title" content="Hypertech - Plex booking site" />
        <meta name="robots" content="index, follow" />
        <meta name="description" content="Hypertech booking site" />
        <meta name="keywords" content="Hypertech, Plex, booking, vacations" />
        <meta name="language" content="en" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
        <title>Hypertech - Plex demo</title>

        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/sf/sf_default/css/screen.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/grid.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/typography.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/ipad.css" />

    </head>
    <body>

        <div class="container">

            <div class="span-4" id="logo">
                <img src="../images/generic/logo.gif" alt="Hypertech Solutions"/>
            </div>
            <div class="span-12">
                <ul  id="top-nav">
                    <li class="second"><a href="<?php echo url_for('homepage'); ?>"><?php echo __('Home') ?></a></li>
                    <li class="second"><a href=""><?php echo __('About us') ?></a></li>
                    <li class="second"><a href=""><?php echo __('Booking infos') ?></a></li>
                    <li class="second"><a href="<?php echo url_for1('search_flight') ?>"><?php echo __('Search Flight') ?></a></li>
                    <li class="second"><a href="#"><?php echo __('Log in') ?></a></li>
                </ul>
            </div>
            <div class="span-3 last">
                <?php include_partial('global/language'); ?>

            </div>
            <div style="clear:both; "></div>
            <?php include_partial('global/navigation'); ?>
                <hr class="space3" />

                <div class="span-18" style="text-align: left;">
                    <h1><?php echo __('An error has occured'); ?></h1>
                    <p><?php echo __('Something is broken'); ?></p>
                    <p><?php echo __('Please e-mail us at issues@hypertech.com and let us know what you were doing when this error occurred. We will fix it as soon as possible. Sorry for any inconvenience caused.'); ?></p>
            </div>

        </div>
    </body>
</html>
