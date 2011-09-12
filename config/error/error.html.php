<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php $path = sfConfig::get('sf_relative_url_root', preg_replace('#/[^/]+\.php5?$#', '', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : ''))) ?>

<?php include '../lib/vendor/symfony/lib/helper/I18NHelper.php' ?>
<?php include '../lib/vendor/symfony/lib/helper/UrlHelper.php' ?>
<?php include '../lib/vendor/symfony/lib/helper/PartialHelper.php' ?>
<?php include '../lib/vendor/symfony/lib/helper/AssetHelper.php' ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="title" content="symfony project" />
        <meta name="robots" content="index, follow" />
        <meta name="description" content="symfony project" />
        <meta name="keywords" content="symfony, project" />
        <meta name="language" content="en" />
        <title>symfony project</title>

        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/sf/sf_default/css/screen.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/grid.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/typography.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/admin.css" />
        <script type="text/javascript" src="<?php echo $path ?>/js/jquery-1.5.1.min.js"></script>
        <script type="text/javascript" src="<?php echo $path ?>/js/myScript.js"></script>

        <!--[if lt IE 7.]>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/sf/sf_default/css/ie.css" />
        <![endif]-->

    </head>
    <body>

        <div id="top-header">
            <div class="container">
                <div class="span-13">
                <ul>
                    <li><a href="#"><?php echo ucfirst(__('news')) ?></a></li>
                    <li><a href="#"><?php echo ucfirst(__('feature deals')) ?></a></li>
                    <li><a href="#"><?php echo ucfirst(__('top destinations')) ?></a></li>
                    <li><a href="#"><?php echo ucfirst(__('vacations by interest')) ?></a></li>
                </ul>
                </div>
                <div class="span-2">
                    <?php include_partial('global/language'); ?>
                </div>
                <div class="span-3">
                    <?php include_partial('global/currency'); ?>
                </div>
                <div class="span-5 right">
                <ul>
                    <li class="right login"><a href="#"><?php echo ucfirst(__('login')) ?></a></li>
                    <li class="right"><a href="#"><?php echo ucfirst(__('register')) ?></a></li>
                </ul>
                </div>
            </div>
            <?php //echo image_tag('generic/top-header.jpg'); ?>
        </div>

        <div class="container">
            <div class="span-10 prepend-top" id="logo">
                <?php echo link_to(image_tag('generic/logo_beta.png', array('alt' => 'Hypertech Solutions')), 'homepage'); ?>
            </div>

            <div class="span-6 bg1 last">

            </div>

            <div class="span-9 last right prepend-top">
                <p class="left">Speak to one of <br />our expert travel advisors</p>
                <?php echo image_tag('generic/telephone.png',array('class'=>'left')); ?>
            </div>

           
            <div style="clear:both; "></div>
            <?php include_partial('global/navigation'); ?>
                <hr class="space3" />
                <div class="span-20" style="text-align: left;">
                    <h1><?php echo __('An error has occured'); ?></h1>
                    <p><?php echo __('Something is broken'); ?></p>
                    <p><?php echo __('Please e-mail us at issues@hypertech.com and let us know what you were doing when this error occurred. We will fix it as soon as possible. Sorry for any inconvenience caused.'); ?></p>
                </div>

        </div>
    </body>
</html>
