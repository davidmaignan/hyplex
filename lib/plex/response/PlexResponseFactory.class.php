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

    public static function &factory($type, $response, sfWebRequest $request, $paramFactory,  $debug = false)
    {
        if(!is_object(self::$response))
        {

            switch ($type) {
                case 'flightReturn':
                    self::$response = new PlexFlightReturnResponse($type, $response, $request, $paramFactory, $debug);
                    break;

                case 'flightOneway':
                    self::$response = new PlexFlightOnewayResponse($type, $response, $request, $paramFactory, $debug);
                    break;

                case 'hotelSimple':
                    self::$response = new PlexHotelSimpleResponse($type, $response, $request, $paramFactory, $debug);
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
