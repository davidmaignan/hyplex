<?php use_helper('I18nUrl') ?>
<div id="header-left">
   <?php echo link_to(image_tag('generic/logo.gif', array('alt' => 'Hypertech Solutions')), 'homepage'); ?>
</div>

<div id="header-right">

<ul  id="top-nav">
    <li class="second"><a href="<?php echo url_for('homepage'); ?>"><?php echo __('Home') ?></a></li>
    <li class="second"><a href=""><?php echo __('About us') ?></a></li>
    <li class="second"><a href=""><?php echo __('Booking infos') ?></a></li>
    <li class="second"><a href="<?php echo url_for1('search_flight') ?>"><?php echo __('Search Flight') ?></a></li>
    <li class="second"><a href="#"><?php echo __('Log in') ?></a></li>
</ul>

<div id="language">
    <p id="culture">
        <a class="btn-end">
        <?php echo image_tag('icons/'.$sf_user->getCulture().'.png'); ?>
        <?php echo Utils::$language[$sf_user->getCulture()]; ?></a>
    </p>
    
    <ul id="other-language">
        <?php foreach (sfConfig::get('app_languages_available') as $language): ?>
        <?php if($sf_user->getCulture() != $language):?>
            <li>
                <a href="<?php echo localized_current_url($language); ?>">
                <?php echo image_tag('icons/'.$language.'.png'); ?> 
                <?php echo Utils::$language[$language]; ?>
                </a>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    
</div>


</div>