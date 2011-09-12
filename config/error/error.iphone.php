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

        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/iphone.css" />

    </head>
    <body>

        <div id="page_wrapper">
            <div id="header-index">
                <img src="/images/generic/logo.gif" alt="Hypertech Solutions" style="width: 120px; margin: 5px 0 0 10px;"/>
                <a href="<?php url_for('homepage'); ?>" title="history" id="btn-history" class="btn">Home</a>
            </div>

            <div class="box-3" style="color: #555;">
                <h2 class="blue2" style="margin-bottom: 6px;"><?php echo __('An error has occured'); ?></h2>
                <p><?php echo __('Something is broken'); ?></p>
                <p><?php echo __('Please e-mail us at issues@hypertech.com and let us know what you were doing when this error occurred. We will fix it as soon as possible. Sorry for any inconvenience caused.'); ?></p>
            </div>

        </div>
    </body>
</html>
