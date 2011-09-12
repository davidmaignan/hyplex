<?php

foreach($datas as $data){
    $string = "{$data['name']}, {$data['country']}, ({$data['code']}) {$data['airport']}\n";
    $string = str_ireplace($q2, "<span style='color: #ed145b;'>".$q2."</span>", $string);
    $string = str_ireplace($q1, "<span style='color: #ed145b;'>".$q1."</span>", $string);

    echo $string;
}