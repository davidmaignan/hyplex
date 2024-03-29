<?php use_helper('I18nUrl') ?>

<div id="language">
    <ul>
        <li class="selected"><?php echo image_tag('icons/' . $sf_user->getCulture() . '.png', array('width'=> '16px','height'=>'11px')) . ' '. Utils::$language[$sf_user->getCulture()]; ?></li>
        <?php foreach (sfConfig::get('app_languages_available') as $language): ?>
            <?php if($sf_user->getCulture() != $language): ?>
                
                    <li class="other-language"><a href="<?php echo localized_current_url($language); ?>">
                    <?php echo image_tag('icons/' . $language . '.png',array('width'=> '16px','height'=>'11px')).
                    ' '. Utils::$language[$language];?> </a></li>
               
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>

&emsp;

<script>

    $('#language').hover(function(){
        $('#language li.selected').addClass('hover');
        $('.other-language').show();
    }, function(){
        $('#language li.selected').removeClass('hover');
        $('.other-language').hide();
    });


</script>