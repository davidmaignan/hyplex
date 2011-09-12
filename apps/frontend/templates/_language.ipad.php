<?php use_helper('I18nUrl') ?>

<ul id="other-language-ipad">
    <?php foreach (sfConfig::get('app_languages_available') as $language): ?>
    <?php if ($sf_user->getCulture() != $language): ?>
            <li>
                <a href="<?php echo localized_current_url($language); ?>">
            <?php echo image_tag('icons/' . $language . '.png'); ?>
            <?php //echo Utils::$language[$language]; ?>
        </a>
    </li>
    <?php endif; ?>
    <?php endforeach; ?>
</ul>