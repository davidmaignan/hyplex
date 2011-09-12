<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexParametersFactory
 *
 * @author david
 */
class PlexParametersFactory {
    //put your code here

    public static $factory;

    public static function &factory($type, $params, $culture)
    {
        if(!is_object(self::$factory))
        {
            switch ($type) {
                case 'flightReturn':

                    self::$factory = new FlightReturnParameters($type, $params, $culture);
                    break;

                case 'flightOneway':
                    self::$factory = new FlightOnewayParameters($type, $params, $culture);
                    break;

                case 'hotelSimple':
                    self::$factory = new HotelSimpleParameters($type, $params, $culture);
                    break;

                default:
                    break;
            }

            

            return self::$factory;

        }
    }

}
?>
