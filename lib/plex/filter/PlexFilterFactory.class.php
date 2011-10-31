<?php

/**
 * Description of PlexResponseFactory
 *
 * Class to analyse the plex soap response
 * Factory pattern to ease the creation of
 * the file to save the response and create the
 * adequates objects (flight, hotel, packages ....)
 *
 * @author david
 */



class PlexResponseFactory {
    //put your code here


    /*
     *  variable response to return
     */

    private static $response;

    /*
     * Create the object response to be returned
     *
     * @param string $type the type of search (flightReturn, flightOneway, Hotel...)
     * @param string $resp the response provided by Plex
     *
     * @return PlexResponse accordingly to the type provided
     */

    public static function &factory($type, $filename, $page, $filters)
    {

        echo 'here';
        exit;

        if(!is_object(self::$response))
        {

            switch ($type) {
                case 'flightReturn':
                    self::$response = new PlexFilterFlightReturn($type, $filename, $page, $filters);
                    break;

                case 'flightOneway':
                    self::$response = new PlexFilterFlightOneway($type, $filename, $page, $filters);
                    break;

                case 'hotelSimple':
                    self::$response = new PlexFilterHotelSimple($type, $filename, $page, $filters);
                    break;
                
                default:
                    self::$response = null;
                    break;
            }
            
            return self::$response;

        }
    }

}
?>
