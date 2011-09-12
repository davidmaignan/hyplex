<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>
<?php use_javascript('functions.js'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>

<!-- Carousel -->
<?php use_javascript('carousel.js'); ?>
<?php use_stylesheet('carousel'); ?>

<?php use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php use_javascript('debugger/myLogger.js'); ?>

<hr />

<?php

$culture = $sf_user->getCulture();

echo $culture;

$filename = sfConfig::get('sf_cache_dir').'/city/city_'.$culture.'.txt';

var_dump(file_exists($filename));

$handle = fopen($filename, 'r');

$cities = array();




while(!feof($handle)){

    $data = explode(':', fgets($handle));

    $cities[$data[0]] = $data[1];


}

fclose($handle);

$start = 000;
$end = 2000+$start;

$ar_cities_issues = array();

//print_r($cities);

for($i=$start;$i<$end;$i++){

    if(array_key_exists($i, $cities)){

        $q = Doctrine::getTable('city')->findOneBy('id', $i);

        if(!empty($q)){
             echo $q->getName();
            echo ': ';
            echo $cities[$i];
            echo "<br />";
            $q->setName($cities[$i],$culture);
            //$q->save();
        }

    }else{
        array_push($ar_cities_issues, $i);
    }
    
}
echo "<hr />";
echo "Issues: ";
print_r($ar_cities_issues);