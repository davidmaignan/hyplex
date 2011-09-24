<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    </head>
    <body>
        <?php include_partial('global/topHeader'); ?>
        <div class="container">
            <?php include_partial('global/header'); ?>
            <div style="clear:both; "></div>
            <?php //if($sf_user->isAuthenticated()): ?>
            <?php include_partial('global/navigation'); ?>
                <hr class="space3" />
            <?php //endif; ?>
            <?php echo $sf_content ?>
        </div>
        <div id="footer">
            <?php include_partial('global/footer'); ?>
            
        </div>
    </body>
</html>
