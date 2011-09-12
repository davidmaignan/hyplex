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
        
        <div class="container">
            <?php include_partial('global/header'); ?>
            <div style="clear:both; "></div>
            <?php //if($sf_user->isAuthenticated()): ?>
            <?php include_partial('global/navigation'); ?>
                <hr class="space3" />
                <?php //endif; ?>
            <?php echo $sf_content ?>
        </div>
        <?php //include_partial('global/socialBookmark'); ?>
    </body>
</html>