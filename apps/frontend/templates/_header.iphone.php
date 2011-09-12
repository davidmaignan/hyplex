<?php use_helper('I18nUrl') ?>

<ul>
    <li><?php echo image_tag('generic/logo.gif', array('alt' => 'Hypertech Solutions', 'id' => 'logo')); ?></li>
    <li class="second"><a href=""><?php echo __('About Hypertech') ?></a></li>
    <li class="second"><a href=""><?php echo __('Agent login') ?></a></li>
    <li class="second"><a href=""><?php echo __('Your previous searches') ?></a></li>
    <li class="second"><a href=""><?php echo __('Booking infos') ?></a></li>
    <li class="second"><a href="<?php echo url_for1('search_flight') ?>"><?php echo __('Search Flight') ?></a></li>
</ul>

<div id="changeLanguage">
    <?php include_component('language', 'language') ?>
</div>

<div>
  <?php foreach(sfConfig::get('app_languages_available') as $language): ?>
    <a href="<?php echo localized_current_url($language); ?>"><?php echo $language; ?></a>
    <?php endforeach; ?>
</div>

