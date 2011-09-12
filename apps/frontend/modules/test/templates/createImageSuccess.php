<?php
$url = 'http://images.americantours.com/adirect_htl/laxhix-fitmd.jpg';
echo image_tag($url, array('absolute'=>true));
$hotelThumb = new PlexImage($url);
echo image_tag('../uploads/hotels/baseImage/'.$hotelThumb->getFileName($url), array('alt'=>'no pic'));
echo "<hr />";

$url = 'http://images.travelnow.com/hotelimages/s/056000/056580A.jpg';
echo image_tag($url, array('absolute'=>true));
$hotelThumb = new PlexImage($url);
echo image_tag('../uploads/hotels/baseImage/'.$hotelThumb->getFileName($url), array('alt'=>'no pic'));
echo "<br />";

echo "<hr />";

$url = 'http://images.americantours.com/adirect_htl/snacit-fitmd.jpg';
echo image_tag($url, array('absolute'=>true));
$hotelThumb = new PlexImage($url);
echo image_tag('../uploads/hotels/baseImage/'.$hotelThumb->getFileName($url), array('alt'=>'no pic'));
echo "<br />";

echo "<hr />";

$url = 'http://images.travelnow.com/hotelimages/s/041000/041084A.jpg';
echo image_tag($url, array('absolute'=>true));
$hotelThumb = new PlexImage($url);
echo image_tag('../uploads/hotels/baseImage/'.$hotelThumb->getFileName($url), array('alt'=>'no pic'));
echo "<br />";
