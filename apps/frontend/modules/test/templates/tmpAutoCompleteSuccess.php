<?php

$q = $sf_request->getParameter('q');

echo $q1;
echo '<br />';
echo $q2;
echo '<br />';
echo '<br />';
//echo "<pre>";
//print_r($datas);html_entity_decode

//echo htmlspecialchars_decode($result);


?>
<?php

foreach($datas as $data){
    $string = "{$data['name']}, {$data['country']}, ({$data['code']}) {$data['airport']}<br />";
    $string = str_ireplace($q2, "<span style='color: #ed145b;'>".$q2."</span>", $string);
    $string = str_ireplace($q1, "<span style='color: #ed145b;'>".$q1."</span>", $string);
    
    echo $string;
}
