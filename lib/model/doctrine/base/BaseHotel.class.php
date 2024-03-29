<?php

/**
 * BaseHotel
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $hotel_id
 * @property string $name
 * @property string $BaseImageLink
 * @property string $star_rating
 * @property string $address1
 * @property string $address2
 * @property string $postalCode
 * @property string $city
 * @property integer $state_id
 * @property integer $country_id
 * @property integer $location_id
 * @property string $short_description
 * @property clob $long_description
 * @property boolean $parking
 * @property boolean $restaurant
 * @property boolean $internet
 * @property boolean $pool
 * @property boolean $fitness
 * @property Doctrine_Collection $Cities
 * @property Country $Country
 * @property State $State
 * @property Doctrine_Collection $HotelCities
 * 
 * @method string              getHotelId()           Returns the current record's "hotel_id" value
 * @method string              getName()              Returns the current record's "name" value
 * @method string              getBaseImageLink()     Returns the current record's "BaseImageLink" value
 * @method string              getStarRating()        Returns the current record's "star_rating" value
 * @method string              getAddress1()          Returns the current record's "address1" value
 * @method string              getAddress2()          Returns the current record's "address2" value
 * @method string              getPostalCode()        Returns the current record's "postalCode" value
 * @method string              getCity()              Returns the current record's "city" value
 * @method integer             getStateId()           Returns the current record's "state_id" value
 * @method integer             getCountryId()         Returns the current record's "country_id" value
 * @method integer             getLocationId()        Returns the current record's "location_id" value
 * @method string              getShortDescription()  Returns the current record's "short_description" value
 * @method clob                getLongDescription()   Returns the current record's "long_description" value
 * @method boolean             getParking()           Returns the current record's "parking" value
 * @method boolean             getRestaurant()        Returns the current record's "restaurant" value
 * @method boolean             getInternet()          Returns the current record's "internet" value
 * @method boolean             getPool()              Returns the current record's "pool" value
 * @method boolean             getFitness()           Returns the current record's "fitness" value
 * @method Doctrine_Collection getCities()            Returns the current record's "Cities" collection
 * @method Country             getCountry()           Returns the current record's "Country" value
 * @method State               getState()             Returns the current record's "State" value
 * @method Doctrine_Collection getHotelCities()       Returns the current record's "HotelCities" collection
 * @method Hotel               setHotelId()           Sets the current record's "hotel_id" value
 * @method Hotel               setName()              Sets the current record's "name" value
 * @method Hotel               setBaseImageLink()     Sets the current record's "BaseImageLink" value
 * @method Hotel               setStarRating()        Sets the current record's "star_rating" value
 * @method Hotel               setAddress1()          Sets the current record's "address1" value
 * @method Hotel               setAddress2()          Sets the current record's "address2" value
 * @method Hotel               setPostalCode()        Sets the current record's "postalCode" value
 * @method Hotel               setCity()              Sets the current record's "city" value
 * @method Hotel               setStateId()           Sets the current record's "state_id" value
 * @method Hotel               setCountryId()         Sets the current record's "country_id" value
 * @method Hotel               setLocationId()        Sets the current record's "location_id" value
 * @method Hotel               setShortDescription()  Sets the current record's "short_description" value
 * @method Hotel               setLongDescription()   Sets the current record's "long_description" value
 * @method Hotel               setParking()           Sets the current record's "parking" value
 * @method Hotel               setRestaurant()        Sets the current record's "restaurant" value
 * @method Hotel               setInternet()          Sets the current record's "internet" value
 * @method Hotel               setPool()              Sets the current record's "pool" value
 * @method Hotel               setFitness()           Sets the current record's "fitness" value
 * @method Hotel               setCities()            Sets the current record's "Cities" collection
 * @method Hotel               setCountry()           Sets the current record's "Country" value
 * @method Hotel               setState()             Sets the current record's "State" value
 * @method Hotel               setHotelCities()       Sets the current record's "HotelCities" collection
 * 
 * @package    hyplexdemo
 * @subpackage model
 * @author     David Maignan
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseHotel extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hotel');
        $this->hasColumn('hotel_id', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('BaseImageLink', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('star_rating', 'string', 10, array(
             'type' => 'string',
             'length' => 10,
             ));
        $this->hasColumn('address1', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('address2', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('postalCode', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             ));
        $this->hasColumn('city', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('state_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('country_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('location_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('short_description', 'string', 4000, array(
             'type' => 'string',
             'length' => 4000,
             ));
        $this->hasColumn('long_description', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('parking', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('restaurant', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('internet', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('pool', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('fitness', 'boolean', null, array(
             'type' => 'boolean',
             ));


        $this->index('hotel_id_index', array(
             'fields' => 
             array(
              0 => 'hotel_id',
             ),
             'type' => 'unique',
             ));
        $this->index('hotel_index', array(
             'fields' => 
             array(
              0 => 'name',
              1 => 'city',
             ),
             ));
        $this->index('country_id_index', array(
             'fields' => 
             array(
              0 => 'country_id',
             ),
             'type' => 'unique',
             ));
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'INNODB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('City as Cities', array(
             'refClass' => 'HotelCities',
             'local' => 'hotel_id',
             'foreign' => 'city_id'));

        $this->hasOne('Country', array(
             'local' => 'country_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('State', array(
             'local' => 'state_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('HotelCities', array(
             'local' => 'id',
             'foreign' => 'hotel_id'));

        $geographical0 = new Doctrine_Template_Geographical();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'short_description',
              1 => 'long_description',
             ),
             ));
        $this->actAs($geographical0);
        $this->actAs($timestampable0);
        $this->actAs($i18n0);
    }
}