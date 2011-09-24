<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>

<?php use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>

<?php //use_stylesheet('grid'); ?>
<?php //use_stylesheet('typography'); ?>


<?php
echo "<ul>";
foreach ($datas as $data) {
    echo "<li class='data' id='" . $data->getId() . "'>";
    echo $data;
    echo "</li>";
}
echo "</ul>";
?>


<div id="result"></div>

<a href="#" onclick="return false;" class="translation-ready">Good to save</a>

<!--Google Translate Element-->
<div id="google_translate_element" style="display:block"></div><script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: "af"}, "google_translate_element");
    };</script>
<script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>



<script>
    

    $('document').ready(function(){


        $('.translation-ready').click(function(){
            //var elts = $('li.data');
            //alert(elts.length);

            var datas = '';

            $('li.data').each(function(){

                datas += $(this).attr('id');
                datas += '=' + $(this).text() + '&';

            });

            alert(datas);

            var url = '../multidestination/ajaxTranslation';

            $.ajax({
                type: "post",
                url: url,
                data: datas,
                success: function(msg){
                    $('#result').html(msg);
                },
                error: function(){
                    alert('error');
                }
            });
            

        });


        


    });

    
   

</script>