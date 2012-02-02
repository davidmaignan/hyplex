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
        
        <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo url_for('@feature_deals_xml',true) ?>" />
        
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <link href='http://fonts.googleapis.com/css?family=Telex' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
        
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
    
    <body>
        <h1 class="body">Hyplexdemo website</h1>
        <?php include_partial('global/topHeader')?>

        <?php include_partial('global/header')?>

        <div style="clear: both"></div>

        <div class="container">
            <?php include_partial('global/navigation')?>
        </div>

        <div class="container prepend-top">
            <?php echo $sf_content; ?>
        </div>
        
        <?php include_partial('global/footer') ?>

    </body>
</html>
