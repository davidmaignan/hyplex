<?php

/**
 * Description of CustomGeoListener
 *
 * Doctrine listener to get lat/lng by requesting googlemap geolocator service
 *
 * @author david
 */

class CustomGeoListener extends Doctrine_Record_Listener{
    

    public function preInsert(Doctrine_Event $event) {

        parent::preInsert($event);

        // Initialize delay in geocode speed
        //define("MAPS_HOST", "maps.google.com");
        //define("KEY", "abcdefg");

        $delay = 0;
        $base_url = "http://maps.google.com/maps/geo?output=xml" . "&key=abcdefg";

        $geocode_pending = true;

        
        

        while ($geocode_pending) {

            $address = $event->getInvoker()->getFullAddress();

            //$address = $this->getCode(). ' '. $this->getAirport(). ' '.$this->getCity(). ' ' . $this->getZipCode(). ' '. $this->getCountry();
            //var_dump($address);

            $request_url = $base_url . "&q=" . urlencode($address);
            $xml = simplexml_load_file($request_url) or die("url not loading");

            $status = $xml->Response->Status->code;

            if (strcmp($status, "200") == 0) {
                // Successful geocode

                $geocode_pending = false;
                $coordinates = $xml->Response->Placemark->Point->coordinates;

                $coordinatesSplit = explode(",", $coordinates);
                // Format: Longitude, Latitude, Altitude
                $lat = $coordinatesSplit[1];
                $lng = $coordinatesSplit[0];

                $event->getInvoker()->setLatitude($lat);
                $event->getInvoker()->setLongitude($lng);

            } else if (strcmp($status, "620") == 0) {
                // sent geocodes too fast
                $delay += 100000;
            } else {
                // failure to geocode
                $geocode_pending = false;
                //echo "Address " . $address . " failed to geocoded. ";
                //echo "Received status " . $status . "\n";
            }
            usleep($delay);
        }
    }
}

