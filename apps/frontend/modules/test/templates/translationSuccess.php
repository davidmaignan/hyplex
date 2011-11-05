<style>
    ul{
        list-style: disc;
        list-style-position: inside;
}
</style>

<?php

$directory = sfConfig::get('sf_app_i18n_dir').DIRECTORY_SEPARATOR.'zh'.DIRECTORY_SEPARATOR;
$file = 'contact_form.xml';
echo "<hr />";

$plexTranslation = new PlexTranslation($directory, $file);





?>

<!--
<div id="google_translate_element"></div><script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en'
  }, 'google_translate_element');
}
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
-->