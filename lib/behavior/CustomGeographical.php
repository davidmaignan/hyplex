<?php

/**
 * Description of CustomGeographicalTemplate
 *
 * Extension of Geographical Doctrine Template
 * modify latitude and longitude type and scaling value
 * Adds a listener to get lat/lng from google geolocator api
 *
 * @author david
 */


class Doctrine_Template_CustomGeographical extends Doctrine_Template_Geographical {
    //put your code here

    protected $_options = array('latitude' =>  array('name'     =>  'latitude',
                                                     'type'     =>  'decimal',
                                                     'size'     =>  null,
                                                     'options'  =>  array('scale'=>15)),
                                'longitude' => array('name'     =>  'longitude',
                                                     'type'     =>  'decimal',
                                                     'size'     =>  null,
                                                     'options'  =>  array('scale'=>15)));

    public function  setTableDefinition() {
        parent::setTableDefinition();
        $this->addListener(new CustomGeoListener());
    }


}
