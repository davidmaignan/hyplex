<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexFilterResponseFactory
 *
 * @author david
 */
class PlexFilterResponseFactory {
    //put your code here

    private static $filter;

    public static function &factory($type, $filename, $page, $filters)
    {
        if(!is_object(self::$filter))
        {
            switch ($type) {
                case 'flightReturn':
                    self::$filter = new PlexFilterFlightReturn($type, $filename, $page, $filters);
                    break;

                case 'flightOneway':
                    self::$filter = new PlexFilterFlightOneway($type, $filename, $page, $filters);
                    break;

                case 'hotelSimple':
                    self::$filter = new PlexFilterHotelSimple($type, $filename, $page, $filters);
                    break;

                default:
                    break;
            }

            return self::$filter;

        }

    }
    
   
}

