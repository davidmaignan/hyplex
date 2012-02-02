<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <?php //include_stylesheets(); ?>
        <?php //include_javascripts(); ?>

        <?php
        $uri = '';
        $arUri = explode('/', $sf_request->getUri());
        unset($arUri[count($arUri) - 1]);
        unset($arUri[count($arUri) - 1]);
        unset($arUri[count($arUri) - 1]);
        $uri = implode('/', $arUri);
        ?>

        <link rel="stylesheet" media="all" href="<?php echo $uri ?>/css/ipad/ipad.css" />
        <link rel="stylesheet" media="all" href="<?php echo $uri ?>/css/ipad/media.css" />

        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0;">


    </head>
    <body>

        <div id="pagewrap">

            <header id="header">

                <hgroup id="identity">
                    <h1 id="site-logo"><a href="#"><?php echo image_tag('generic/logo_beta.png','Hyplexdemo') ?></a></h1>
                </hgroup>
                
                <div id="language">
                    
                    <select>
                        <option>English</option>
                        <option>Francais</option>
                        <option>Chinese</option>
                    </select>
                </div>
                
                
                <nav>
                    <ul id="main-nav" class="clearfix">
                        <li><?php echo link_to(__('Flight'), 'search_flight') ?></li>
                        <li><?php echo link_to(__('Hotel'), 'search_hotel') ?></li>
                        <li><?php echo link_to(__('Car'), 'search_car') ?></li>
                        <li><?php echo link_to(__('Package'), 'search_package') ?></li>
                        <li><?php echo link_to(__('Basket'), 'basket', array(), array('class'=>'right')) ?></li>
                        <li><?php echo link_to(__('Account'), 'account', array(), array('class'=>'right')) ?></li>
                        
                    </ul>
                    <!-- /#main-nav --> 
                </nav>

            </header>
            <!-- /#header -->
            
            <?php echo $sf_content ?>
            
            

            <footer id="footer">

                <p>Tutorial by <a href="http://webdesignerwall.com">Web Designer Wall</a></p>

            </footer>
            <!-- /#footer --> 

        </div>
        <!-- /#pagewrap -->

    </body>
</html>