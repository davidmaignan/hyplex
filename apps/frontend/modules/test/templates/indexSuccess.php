<div class="span-20">
<?php

$file = sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.'chains.csv';

$handle = fopen($file , 'r');


while(!feof($handle)){
    
    $content = fgetcsv($handle);
    var_dump($content);
    
    $hotelChain = new HotelChain();
    $hotelChain->setTag($content[0]);
    $hotelChain->setName($content[1]);
    $hotelChain->save();
    
}

fclose($handle);

?>

</div>
