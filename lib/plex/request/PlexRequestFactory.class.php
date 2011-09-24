<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexRequestFactory
 *
 * @author david
 */
class PlexRequestFactory {
    //put your code here

    public static $request;

    public static function &factory($type, $request, $paramFactory)
    {
        if(!is_object(self::$request))
        {
            switch ($type) {
                case 'flightReturn':
                    self::$request = new PlexFlightReturnRequest($type, $request, $paramFactory);
                    break;

                case 'flightOneway':
                    self::$request = new PlexFlightOnewayRequest($type, $request, $paramFactory);
                    break;

                case 'hotelSimple':
                    self::$request = new PlexHotelSimpleRequest($type, $request, $paramFactory);
                    break;

                default:
                    self::$request = null;
                    break;
            }

            return self::$request;
        }
    }
}
?>
