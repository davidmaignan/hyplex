<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="header">
            <?php echo image_tag('generic/logo_beta.png', array('width' => '220px')); ?>
            <div id="language-container">
                <?php use_helper('I18nUrl') ?>
                <div id="language">
                    <ul id="other-language">
                        <?php foreach (sfConfig::get('app_languages_available') as $language): ?>
                        <?php if ($sf_user->getCulture() != $language): ?>
                                <li>
                                    <a href="<?php echo localized_current_url($language); ?>">
                                <?php echo image_tag('icons/' . $language . '.png'); ?>
                                <?php //echo Utils::$languageBackend[$language]; ?>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                                <li>
                            <?php //echo image_tag('icons/' . $sf_user->getCulture() . '.png'); ?>
                            <?php //echo Utils::$languageBackend[$sf_user->getCulture()]; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php //if ($sf_user->isAuthenticated()): ?>
                <?php include_partial('global/navigation'); ?>
            <?php //endif; ?>
            <div id="content">

            <?php echo $sf_content ?>
        </div>
  </body>
</html>
