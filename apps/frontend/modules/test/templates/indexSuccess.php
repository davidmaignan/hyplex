<hr />


<style>
    table td{
        border: 1px solid #aaaaaa;
        padding: 8px;
    }
</style>

<?php

$filename = sfConfig::get('sf_data_dir') . DIRECTORY_SEPARATOR . 'rawplexresponse' . DIRECTORY_SEPARATOR . 'hotel_1.xml';


$simpleXML = true;



if($simpleXML){
    
    $arObjs = array();

    $timer = sfTimerManager::getTimer('simpleXML');
    $xml = simplexml_load_file($filename);

    $timer->addTime();

    //echo $timer->getElapsedTime().'<br />';

    foreach ($xml->HotelInfos->children() as $key => $value) {

        $hotelSimple = new HotelSimpleObj($value, $filename);
        //$hotelSimple->latitude = $arMarkers['hotels'][$hotelSimple->id]['latitude'];
        //$hotelSimple->longitude = $arMarkers['hotels'][$hotelSimple->id]['longitude'];
        array_push($arObjs, $hotelSimple);
    }

    $timer->addTime();
}

//echo $timer->getElapsedTime();


$xmlReader = true;

if($xmlReader){

    $arObjs2 = array();

    $timer = sfTimerManager::getTimer('XMLReader');


    $xr = new XMLReader();
    $xr->open($filename);

    $timer->addTime();

    /*
    //echo $timer->getElapsedTime().'<br />';
    while ($xr->read() && $xr->name !== 'HotelInfos');

    while ($xr->read()) {

        if (XMLReader::ELEMENT == $xr->nodeType) {

            switch ($xr->localName) {
                case 'HotelInfo':
                $node = new SimpleXMLElement($xr->readOuterXML());
                $hotelSimple = new HotelSimpleObj($node, $filename);
                //$hotelSimple->latitude = $arMarkers['hotels'][$hotelSimple->id]['latitude'];
                //$hotelSimple->longitude = $arMarkers['hotels'][$hotelSimple->id]['longitude'];
                array_push($arObjs2, $hotelSimple);
                
                break;
            }
        }
    }

    $timer->addTime();
     */

    $doc = new DOMDocument;

    while ($xr->read() && $xr->name !== 'HotelInfo');


    while ($xr->name === 'HotelInfo')
    {
        //echo 'here';
        //$node = new SimpleXMLElement($z->readOuterXML());
        //$node = simplexml_import_dom($doc->importNode($xr->expand(), true));
        //$hotelSimple = new HotelSimpleObj($node, $filename);
        //array_push($arObjs2, $hotelSimple);
        //var_dump($node);

        $hotel = new HotelSimpleObj();

        while($xr->read() && $xr->depth > 2){

            //echo $xr->localName.'<br />';

            if (XMLReader::ELEMENT == $xr->nodeType) {

                switch ($xr->localName) {

                    case 'HotelId':
                        $xr->read();
                        //echo $xr->value. ' - ';
                        $hotel->id = $xr->value;
                        break;

                    case 'HotelName':
                        $xr->read();
                        //echo $xr->value. ' - ';
                        $hotel->name = $xr->value;
                        break;

                    case 'HotelChain':
                        $xr->read();
                        //echo $xr->value. ' - ';
                        $hotel->hotelChain = $xr->value;
                        break;

                    case 'StarRating':
                        $xr->read();
                        //echo $xr->value. ' - ';
                        $hotel->setStarRating(HotelSimpleObj::renameStarRating($xr->value));
                        break;

                    case 'Location':
                        $xr->read();
                        //echo $xr->value. ' - ';
                        $hotel->location = $xr->value;
                        break;

                    case 'DisplayPriority':
                        $xr->read();
                        //echo $xr->value. ' - ';
                        $hotel->displayPriority = $xr->value;
                        break;

                    case 'IsOurPick':
                        $xr->read();
                        //echo $xr->value. ' - ';
                        $hotel->isOurPick = $xr->value;
                        break;
                    
                    case 'BaseImageLink':
                        $xr->read();
                        //echo $xr->value. ' - ';
                        $hotel->baseImageLink = $xr->value;
                        break;

                    case 'PropertyType':
                        $xr->read();
                        //echo $xr->value. ' - ';
                        $hotel->propertyType = $xr->value;
                        break;

                    case 'HotelDescription':
                        $xr->read();
                        //echo $xr->value. ' - ';
                        $hotel->hotelDescription = $xr->value;
                        break;

                    case 'HotelAddress':
                        $hotel->hotelAddress = setAddress($xr);
                        break;

                    case 'HotelFacilities':
                        $hotel->hotelFacilities = setFacilities($xr);
                        break;

                    case 'RoomResponses':
                        $hotel->arRooms = setRooms($xr);
                        break;
                }

            }

            
        }

        array_push($arObjs2, $hotel);
        // now you can use $node without going insane about parsing
        //var_dump($node);

        // go to next <product />
        $xr->next('HotelInfo');
    }

     
    $timer->addTime();

}



//echo $timer->getElapsedTime();

$times = sfTimerManager::getTimers();

//var_dump($times);


echo "<table border=1 >";
if($simpleXML){
    echo "<tr>";
    echo "<td>SimpleXML</td>";
    echo "<td>" . $times['simpleXML']->getElapsedTime(). "</td>";
    echo "<td>" .count($arObjs) . "</td>";
    echo "<td>". $arObjs[10]->getInfos() . "</td>";
    echo "</tr>";
}
if($xmlReader){
    echo "<tr>";
    echo "<td>XMLReader</td>";
    echo "<td>" . $times['XMLReader']->getElapsedTime(). "</td>";
    echo "<td>" .count($arObjs2) . "</td>";
    echo "<td>". $arObjs2[10]->getInfos() . "</td>";
    echo "</tr>";
}
echo "</table>";

//echo "<pre>";
//print_r($arObjs2[0]);


function setAddress($xr){

    $arAddress = array();

    while($xr->read() && $xr->localName != 'HotelAddress'){


        if (XMLReader::ELEMENT == $xr->nodeType) {

            switch ($xr->localName) {
                case 'Street1':
                    $xr->read();
                    $arAddress['Street1'] = $xr->value;
                    break;

                case 'Street2':
                    $xr->read();
                    $arAddress['Street2'] = $xr->value;
                    break;

                case 'City':
                    $xr->read();
                    $arAddress['City'] = $xr->value;
                    break;

                case 'StateProvince':
                    $xr->read();
                    $arAddress['StateProvince'] = $xr->value;
                    break;

                case 'Country':
                    $xr->read();
                    $arAddress['Country'] = $xr->value;
                    break;

                case 'PostalCode':
                    $xr->read();
                    $arAddress['PostalCode'] = $xr->value;
                    break;

                default:
                    break;
            }
            
        }

    }

    return $arAddress;

}


function setFacilities($xr){

    $arValues = array();
    $arKeys = array();
   
    while($xr->read() && $xr->localName != 'HotelFacilities'){

        if($xr->localName == 'FacilityName'){
            $xr->read();
            array_push($arKeys, $xr->value);
        }

        if($xr->localName == 'FacilityAvailable'){
            $xr->read();
            array_push($arValues, $xr->value);
        }

    }

    return array_combine($arKeys, $arValues);
    
}

function setRooms($xr){

    $arRooms = array();
    $arKeys = array();

    while($xr->read() && $xr->localName != 'RoomResponses'){

        if (XMLReader::ELEMENT == $xr->nodeType) {

            switch ($xr->localName) {
                case 'UniqueRoomRequestId':
                    $xr->read();
                    array_push($arKeys, $xr->value);
                    break;

                case 'RoomTypeInfos':
                    array_push($arRooms, setRoomsType($xr));


                default:
                    break;
            }


            //echo $xr->localName.' | '.$xr->depth;
            //echo ' | ';
            //$xr->read();
            //echo $xr->value;
            //echo "<br />";
        }

    }
    //var_dump($arKeys);
    //var_dump($arRooms);

    return array_combine($arKeys, $arRooms);

    
}

function setRoomsType($xr){

    $doc = new DOMDocument;


    $ar = array();


    while($xr->read() && $xr->localName != 'RoomResponse'){

        if (XMLReader::ELEMENT == $xr->nodeType) {


            switch ($xr->localName) {
                case 'RoomTypeInfo':

                    $node = simplexml_import_dom($doc->importNode($xr->expand(), true));
                    $hotelRoomObj = new HotelRoomObj($node);
                    //var_dump($hotelRoomObj);
                    array_push($ar , $hotelRoomObj);
                    //echo $xr->localName. ' | '.$xr->depth . ' | ';
                    //$xr->read();
                    //echo $xr->value;
                    //echo "<br />";
                    break;
            }

        }
    }

    
    return $ar;
    
}