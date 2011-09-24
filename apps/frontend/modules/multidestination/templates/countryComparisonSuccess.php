<?php

$filename = sfConfig::get('sf_cache_dir').'/country/countries_iello.csv';

$arCountries = array();
var_dump(file_exists($filename));

$arCountriesFull = array();


$handle = fopen($filename, 'r');

while(!feof($handle)){
    $ar = fgetcsv($handle);
    array_push($arCountries, $ar[0]);
    $arCountriesFull[$ar[0]] = $ar;
}

sort($arCountries);

fclose($handle);

echo "<pre>";
$arDatas = $datas;

//print_r($arCountries);
//print_r($datas);

foreach ($arDatas as $key => $value) {
    if(in_array($value , $arCountries)){
        unset($arDatas[$key]);
    }
}

//print_r($arDatas);

foreach ($arCountries as $key => $value) {
    if(in_array($value , $datas)){
        unset($arCountries[$key]);
    }
}

print_r($arDatas);
print_r($arCountries);


echo "<hr />";
echo "<h3>List of countries in iello only</h3>";

foreach ($arCountries as $value) {
    echo $value.': '.$arCountriesFull[$value][1];
    echo "<br />";
}

echo "<hr />";
echo "<h3>List of countries in mine only</h3>";

$list = Doctrine_Query::create()
            ->from('country a')
            ->leftJoin('a.Translation t')
            ->where('t.lang = ?','en_US')
            ->whereIn('a.code',$arDatas)
            ->execute()
            ->toArray();

print_r($list);