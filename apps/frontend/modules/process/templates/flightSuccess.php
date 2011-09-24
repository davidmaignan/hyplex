<div id="column-left">
   <?php include_component_slot('columnLeft', array('results'=>$results)); ?>
</div>




<div id="column-middle">

<?php include_partial('searchFlight/editform',array('form'=>$form)) ?>

<style>
    h1{
        margin:10px 0 5px 0;
    }

    #sorting{
        border:1px solid #aaa;
        background-color: white;
        padding:5px;
    }

    #sorting li{
        display: inline;
        margin-bottom: 3px;
        font-size: 95%;
    }

    #sorting li a{
        font-weight: bold;
        padding:0 10px;
    }
    
</style>

<h1 style="font-size:130%;">Flights result</h1>




<ul id="sorting">
    <li>Sort by: </li>
    <li><a href="#"> - Price</a></li>
    <li><a href="#"> - Airline</a></li>
    <li><a href="#"> - Takeoff</li>
    <li><a href="#"> - Price</a></li>
    <li><a href="#"> - Time</a></li>
</ul>
<div style="clear: both;"></div>
<br />

<?php
//echo "<pre>";
//print_r($results[0]);
?>

<?php foreach($results as $result): ?>

<?php include_partial('flightReturn', array('result'=>$result)); ?>

<?php endforeach; ?>


</div>