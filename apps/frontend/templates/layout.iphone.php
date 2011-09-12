<!doctype html>
<html>
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <?php include_stylesheets(); ?>
        <?php include_javascripts(); ?>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    </head>
    <body onorientationchange="updateOrientation();">
        <?php echo $sf_content ?>
    </body>
</html>