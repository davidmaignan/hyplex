<?php


$prevSearches = $sf_user->getAttribute('prevSearch');
$prevSearche = $prevSearches[count($prevSearches) - 1];
$filename = $prevSearche['file'];

$total = new PlexFilterHotelSimple('hotelSimple', $filename, 1, array());

$hotelsTotal = $total->arObjs;

?>


<table>
    <tr>
        <td><h2>Total</h2><?php include_partial('debugTotal', array('hotels'=>$hotelsTotal)); ?></td>
        <td><h2>Filtered</h2><?php include_partial('debugFiltered',array('hotels'=>$results)); ?></td>
        <td><h2>Filtered</h2><?php include_partial('debugAnalysis',array('hotels'=>$results)); ?></td>
    </tr>
</table>