<div id="top-header">
            <div class="container">
                <nav id="top-nav" class="span-15">
                    <h2 class="hide"><?php echo __('Top navigation') ?></h2>
                    <a href="#" title="#"><?php echo __('News') ?></a>
                    <a href="<?php echo url_for('@feature_deals') ?>" title="Feature deals"><?php echo __('Feature deals') ?></a>
                    <a href="#" title="#"><?php echo __('Top destinations') ?></a>
                    <a href="#" title="#"><?php echo __('Vacations by interest') ?></a>        
                </nav>
                <?php use_helper('I18nUrl') ?>
                <div id="language" class="span-3">
                    <ul>
                        <li class="selected"><?php echo image_tag('icons/' . $sf_user->getCulture() . '.png', array('width'=> '16px','height'=>'11px')) . ' '. Utils::$language[$sf_user->getCulture()]; ?></li>
                        <?php foreach (sfConfig::get('app_languages_available') as $language): ?>
                            <?php if($sf_user->getCulture() != $language): ?>

                                    <li class="hide"><a href="<?php echo localized_current_url($language); ?>">
                                    <?php echo image_tag('icons/' . $language . '.png',array('width'=> '16px','height'=>'11px')).
                                    ' '. Utils::$language[$language];?> </a></li>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div id="currency" class="span-3">
                    <ul>
                        <li class="selected">USD</li>
                        <li class="hide"><a href="#">CAD</a></li>
                        <li class="hide"><a href="#">EURO</a></li>
                    </ul>
                </div>
                <div class="span-3" id="login">
                    <a href="<?php echo url_for('signin') ?>" title="login"><?php echo __('Login') ?></a>
                    </p>
                </div>
            </div>
</div>