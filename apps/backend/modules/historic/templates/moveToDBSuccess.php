<?php use_stylesheet('/sfDoctrinePlugin/css/default.css'); ?>
<?php use_stylesheet('/sfDoctrinePlugin/css/global.css'); ?>

<?php

/*
  $files = PlexStats::getHistoricFiles();

  var_dump($files);

  $entries = file($files[0]);
  echo "<table>";

  foreach ($files as $file) {

  $entries = file($file);

  foreach ($entries as $key => $entry) {
  echo "<tr>";
  echo "<td>$key</td>";

  $datas = explode('|', $entry);
  foreach ($datas as $k => $value) {
  echo "<td>" . ($value) . "</td>";
  }
  echo "</tr>";
  }
  }

  echo "</table>";

 */

PlexStats::saveInDB();


/*
$arAgent = array();

$arAgent[] = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:8.0.1) Gecko/20100101 Firefox/8.0.1';
$arAgent[] = 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.14) Gecko/2009090216 Ubuntu/8.04 (hardy) Firefox/3.0.14';
$arAgent[] = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0)';
$arAgent[] = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0)';
$arAgent[] = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.215 Safari/535.1';
$arAgent[] = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/534.51.22 (KHTML, like Gecko) Version/5.1.1 Safari/534.51.22';
$arAgent[] = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/534.51.22 (KHTML, like Gecko) Version/5.1.1 Safari/534.51.22';
$arAgent[] = 'Opera/9.80 (Windows NT 6.1; U; en) Presto/2.8.131 Version/11.10';
$arAgent[] = 'Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; en) Presto/2.10.229 Version/11.60';



var_dump($arAgent);


$arUri = array();
$arUri[] = 'http://hyplexdemo/frontend_dev.php/en_US/';
$arUri[] = 'http://hyplexdemo/frontend_dev.php/en_US/';
$arUri[] = 'http://hyplexdemo/frontend_dev.php/en_US/';
$arUri[] = 'http://hyplexdemo/frontend_dev.php/en_US/';
$arUri[] = 'http://hyplexdemo/frontend_dev.php/en_US/';
$arUri[] = 'http://hyplexdemo/frontend_dev.php/fr_FR/';
$arUri[] = 'http://hyplexdemo/frontend_dev.php/fr_FR/';
$arUri[] = 'http://hyplexdemo/frontend_dev.php/zh_CN/';



$arIp = array();

$arIp[] = '55.345.234.230';
$arIp[] = '155.345.56.100';
$arIp[] = '215.345.159.100';
$arIp[] = '235.345.234.45';
$arIp[] = '25.345.123.100';
$arIp[] = '165.345.234.120';
$arIp[] = '85.345.23.100';
$arIp[] = '95.345.234.34';

for ($i = 0; $i < 3000; $i++) {
    
    $date = '2011-12-16 '.rand(0,23).':01:01';
    
    $historic = new Historic();
    $historic->setDate(date($date));
    $historic->setIp($arIp[rand(0,count($arIp)-1)]);
    $historic->setFolder('aaaaaa');
    
    $agent = $arAgent[rand(0,count($arAgent)-1)];
    $historic->setAgent($agent);
    
    $tmp = Utils::getUserAgent($agent);
    $historic->setOs($tmp['os']);
    $historic->setBrowser($tmp['browser']);
    $historic->setVersion($tmp['version']);
    
    $uri = $arUri[rand(0,count($arUri)-1)];

    $historic->setLanguage(Utils::getLanguage($uri));

    $historic->setUri($uri);
    $historic->setSTId('');
    $historic->setFilename('');
    $historic->setParameters((array()));
    $historic->save();
}

echo 'done';
 * 
 * 
 */