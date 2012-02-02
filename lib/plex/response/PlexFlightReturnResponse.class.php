<?php

/**
 * Description of PlexFlightReturnResponse
 * Object to analyse the plex response, create some files to save xml and the
 * appropriate objects.
 *
 * @author david
 */
class PlexFlightReturnResponse extends PlexResponse implements PlexResponseInterface {
    /*
     * Parse the response and create the xml file used to creates the objects
     *
     * @return PlexResponse accordingly to the type provided
     */

    
    public $listAirlines = array();
    public $listKeysAirports = array();



    public function parseResponse() {

        $responseData = $this->responseData;

        $timer = sfTimerManager::getTimer('ParseResponse');

        $xml = simplexml_load_file($this->getFilename('xml'));

        //This case should not happened - it's already checked during the PlexHotelRequest response
        if ($xml === false) {

        }

        $timer->addTime();

        /*
        //Parse the response if Success
        $start = strpos($responseData, '<AirInfos>');
        $end = strrpos($responseData, '</AirInfos>');

        //exit;

        //If can't find tags AirInfos. xml empty or badly formatted
        if($start === false || $end === false)
        {
            $infos = array();
            $infos['message'] = 'Error XML: can\'t find tags AirInfos';
            $infos['filename'] = $this->getFilename().'plexResponse.raw';
            $infos['parameters'] = $this->request->getPostParameters();

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            sfContext::getInstance()->getController()->forward('error', 'plexError');
            exit;
            
        }else{

            $body = trim(substr($responseData, $start, $end - $start + 11));

            $data = '<?xml version="1.0" encoding="utf-8"?>' . $body;
            $filename = $this->getFilename('xml');
            file_put_contents($filename, $data);
            chmod($filename, 0777);

            //Delete the raw response.
            //unlink($this->getFilename());

            $timer->addTime();
        }
         * 
         */

    }

    public function analyseResponse() {

        $timer = sfTimerManager::getTimer('AnalyseResponse');

        //Create the file to save search parameters and the list of serialize flightReturnObjects.
        $file = $this->getFilename('xml');
        $content = file_get_contents($file);

        //Retreive the xml file from the plex request
        $xml = simplexml_load_file($file);

        if (!$xml) {
            $infos = array();
            $infos['message'] = 'Error while building xml';
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename('xml'));
            $infos['parameters'] = $this->request->getPostParameters();

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            sfContext::getInstance()->getController()->forward('error', 'plexError');
            
        }

        //Loop through the xml for each flight
        foreach ($xml->AirInfos->children() as $value) {

            //Create the flightReturnObject
            $flightReturn = new FlightReturnObj();

            //Define the origin and destination: array of one or multiple codes
            $flightReturn->origin = $this->paramFactory->getOrigin();
            $flightReturn->destination = $this->paramFactory->getDestination();
            $flightReturn->arDestinationCode = $this->paramFactory->getArrayDestinationCode();

            //Loop throught every value
            foreach ($value->children() as $key => $val) {

                // 2 cases - SegmentInfo -> need to loop through it.
                switch ($key) {
                    case 'SegmentInfos':

                        foreach ($val->children() as $k => $v) {

                            //Create a segment and save them in the array (Segment) of the PlexResponse object
                            $segment = new FlightSegmentObj();

                            foreach ($v as $info => $data) {
                                $segment->$info = (string) $data;

                            }

                            //Create array to hold list of airline code and airline name
                            if(!array_key_exists($segment->AirlineCode, $this->listAirlines)){
                                $this->listAirlines[$segment->AirlineCode] = $segment->Airline;
                            }

                            // Create array to hold list of airport code: add departureFrom
                            // use line 265 to add info for airport in FlightReturn object
                            if(!in_array($segment->DepartureFrom, $this->listKeysAirports)){
                                array_push($this->listKeysAirports, $segment->DepartureFrom);
                            }
                            //Create array to hold list of airport code: add arrivalTo
                            if(!in_array($segment->ArrivalTo, $this->listKeysAirports)){
                                array_push($this->listKeysAirports, $segment->ArrivalTo);
                            }
                            
                            array_push($flightReturn->$key, $segment);
                        }

                        break;

                    default:
                        $flightReturn->$key = (string) $val;
                        break;
                }

                //Function to reorganise the segmentInfos array in the Segment
                //array with 2 level: one outbound and  one inbound -> used to display details flights
                $flightReturn->analyseSegmentInfos();
            }
            

            //Create two new arrays outbound and inbound with summurazise segments. -> used to display summurize flight
            $flightReturn->summurizeSegmentsInfos();

            //$flightReturn->SegmentInfos = array();

            //unset($flightReturn->SegmentInfos);
            //Save the each flightReturn objects in a file

            //Save in Response the flights objects in array
            array_push($this->arObjs, $flightReturn);
        }

        //echo "<pre>";
        //print_r($this->arObjs);
        //exit;

        //Airport list and infos to save in flighReturnObject
        $listAirports = Doctrine::getTable('City')->getListAirportByCode($this->listKeysAirports);

        // Save the FlightReturnObjects in plex file
        $handle = fopen($this->getFilename('plex'), 'wb');
        foreach($this->arObjs as $flightReturn){
            $flightReturn->setAirportInfo($listAirports);
            fwrite($handle, serialize($flightReturn) . "\r\n --- " . "\r\n");
        }
        fclose($handle);
        chmod($this->getFilename('plex'), 0777);


        //Add new request to request file 
        PlexParsing::addNewRequest($this->filename, $this->type, $this->paramFactory);

        //Delete the xml file
        //unlink($this->getFilename('xml'));

        //Save info in db
        $event = new sfEvent($this, 'plex.response_success', array('this' => $this));
        sfContext::getInstance()->getEventDispatcher()->notify($event);

		//Create filter file
		$arStops = array();
		$arAirlines = array();
		$arPrice = array();
		
		$arFilterTmp = array();
		$arFilterTmp['minPrice'] = $this->arObjs[0]->TotalPrice;
        $arFilterTmp['maxPrice'] = $this->arObjs[0]->TotalPrice;
        $arFilterTmp['takeoffDepMin'] = Utils::getArrayTimeFromSegments($this->arObjs[0]->SegmentOutbound->Departs);
        $arFilterTmp['takeoffDepMax'] = Utils::getArrayTimeFromSegments($this->arObjs[0]->SegmentOutbound->Departs);
        $arFilterTmp['takeoffRetMin'] = Utils::getArrayTimeFromSegments($this->arObjs[0]->SegmentInbound->Departs);
        $arFilterTmp['takeoffRetMax'] = Utils::getArrayTimeFromSegments($this->arObjs[0]->SegmentInbound->Departs);
        $arFilterTmp['minDuration'] = ($this->arObjs[0]->SegmentOutbound->FlightDuration + $this->arObjs[0]->SegmentInbound->FlightDuration);
        $arFilterTmp['maxDuration'] = ($this->arObjs[0]->SegmentOutbound->FlightDuration + $this->arObjs[0]->SegmentInbound->FlightDuration);
        
        //var_dump($arFilterTmp);

        foreach ($this->arObjs as $value) {
        	 
        	$arFilterTmp['minPrice'] = min($value->TotalPrice, $arFilterTmp['minPrice']);
        	$arFilterTmp['maxPrice'] = max($value->TotalPrice, $arFilterTmp['maxPrice']);
        	$arFilterTmp['takeoffDepMin'] = min(Utils::getArrayTimeFromSegments($value->SegmentOutbound->Departs), $arFilterTmp['takeoffDepMin']);
        	$arFilterTmp['takeoffDepMax'] = max(Utils::getArrayTimeFromSegments($value->SegmentOutbound->Departs), $arFilterTmp['takeoffDepMax']);
        	$arFilterTmp['takeoffRetMin'] = min(Utils::getArrayTimeFromSegments($value->SegmentInbound->Departs), $arFilterTmp['takeoffRetMin']);
        	$arFilterTmp['takeoffRetMax'] = max(Utils::getArrayTimeFromSegments($value->SegmentInbound->Departs), $arFilterTmp['takeoffRetMax']);
        	$arFilterTmp['minDuration'] = min($value->SegmentOutbound->FlightDuration + $value->SegmentInbound->FlightDuration, $arFilterTmp['minDuration']);
        	$arFilterTmp['maxDuration'] = max($value->SegmentOutbound->FlightDuration + $value->SegmentInbound->FlightDuration, $arFilterTmp['maxDuration']);
        	
        	
        	//Stops
        	 $nbrStops = max($value->nbrStopsOutbound, $value->nbrStopsInbound);
        	 if (!array_key_exists($nbrStops, $arStops)) {
        	 	$arStops[$nbrStops] = $value->TotalPrice;
        	 	
        	 }else{
        	 	$arStops[$nbrStops] = min($arStops[$nbrStops], $value->TotalPrice);
        	 }
        	
        	 
        	 //Airline
	        switch (count($value->arAirlines)) {
	                case 1:
	                    $tmp = array();
	                    $tmp['stops'] = $nbrStops;
	                    $tmp['price'] = $value->TotalPrice;
	                    $tmp['UniqueReferenceId'] = $value->UniqueReferenceId;
	                    //$tmp['']
	                    //If not in array add it as a new entry
	                    if (!array_key_exists($value->arAirlines[0], $arAirlines)) {
	                        $arAirlines[$value->arAirlines[0]][0] = $tmp;
	                    } else {
	                    	//$arAirlines[$value->arAirlines[0]][0] = Utils::compareArrays( $arAirlines[$value->arAirlines[0]][0], $tmp, 'price');
	                       //array_push($arAirlines[$value->arAirlines[0]], $tmp);
	                    }
	
	                    break;
	
	                default:
	                    $tmp = array();
	                    $tmp['airlines'] = $value->arAirlines;
	                    $tmp['stops'] = $nbrStops;
	                    $tmp['price'] = $value->TotalPrice;
	                    $tmp['UniqueReferenceId'] = $value->UniqueReferenceId;
	                    if (!array_key_exists('multi', $arAirlines)) {
	                        $arAirlines['multi'][] = $tmp;
	                    } else {
	                    	$arAirlines['multi'][0] = Utils::compareArrays($arAirlines['multi'][0], $tmp, 'price');
	                    	
	                    	
	                    	//array_push($arAirlines['multi'], $tmp);
	                    }

	                    break;
	        }

        }
        
        echo "<pre>";
        ksort($arStops);
       	//var_dump(($arStops));
        //print_r($arAirlines);
        
        //print_r($arFilterTmp);
        
        $arFilters = array();
        $arFilters['total'] = count($this->arObjs);
        $arFilters['stop'] = $arStops;
        $arFilters['airlines'] = $arAirlines;
        $arFilters['price'] = array('min'=>$arFilterTmp['minPrice'],'max'=>$arFilterTmp['maxPrice']);
        $arFilters['takeoffDep'] = array('min'=>$arFilterTmp['takeoffDepMin'], 'max'=>$arFilterTmp['takeoffDepMax']);
        $arFilters['takeoffRet'] = array('min'=>$arFilterTmp['takeoffRetMin'], 'max'=>$arFilterTmp['takeoffRetMax']);
        $arFilters['duration'] = array('min'=>$arFilterTmp['minDuration'], 'max'=>$arFilterTmp['maxDuration']);
        
        //Save filters in file
        file_put_contents($this->getFilename('filters'), serialize($arFilters));
        chmod($this->getFilename('filters'), 0777);

    }

    public function sendResponse() {
        
    }

    protected function saveResponse() {
        
    }

}
