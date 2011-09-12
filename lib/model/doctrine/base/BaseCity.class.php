<?php

/**
 * BaseCity
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $airport
 * @property integer $country_id
 * @property integer $state_id
 * @property boolean $cache
 * @property boolean $archived
 * @property boolean $metropolitan
 * @property Country $Country
 * @property State $State
 * @property City_metro $City_metro
 * @property Doctrine_Collection $Cities
 * @property Doctrine_Collection $CityMultipleAirport
 * @property Doctrine_Collection $Hotels
 * @property Doctrine_Collection $HotelCities
 * 
 * @method integer             getId()                  Returns the current record's "id" value
 * @method string              getCode()                Returns the current record's "code" value
 * @method string              getName()                Returns the current record's "name" value
 * @method string              getAirport()             Returns the current record's "airport" value
 * @method integer             getCountryId()           Returns the current record's "country_id" value
 * @method integer             getStateId()             Returns the current record's "state_id" value
 * @method boolean             getCache()               Returns the current record's "cache" value
 * @method boolean             getArchived()            Returns the current record's "archived" value
 * @method boolean             getMetropolitan()        Returns the current record's "metropolitan" value
 * @method Country             getCountry()             Returns the current record's "Country" value
 * @method State               getState()               Returns the current record's "State" value
 * @method City_metro          getCityMetro()           Returns the current record's "City_metro" value
 * @method Doctrine_Collection getCities()              Returns the current record's "Cities" collection
 * @method Doctrine_Collection getCityMultipleAirport() Returns the current record's "CityMultipleAirport" collection
 * @method Doctrine_Collection getHotels()              Returns the current record's "Hotels" collection
 * @method Doctrine_Collection getHotelCities()         Returns the current record's "HotelCities" collection
 * @method City                setId()                  Sets the current record's "id" value
 * @method City                setCode()                Sets the current record's "code" value
 * @method City                setName()                Sets the current record's "name" value
 * @method City                setAirport()             Sets the current record's "airport" value
 * @method City                setCountryId()           Sets the current record's "country_id" value
 * @method City                setStateId()             Sets the current record's "state_id" value
 * @method City                setCache()               Sets the current record's "cache" value
 * @method City                setArchived()            Sets the current record's "archived" value
 * @method City                setMetropolitan()        Sets the current record's "metropolitan" value
 * @method City                setCountry()             Sets the current record's "Country" value
 * @method City                setState()               Sets the current record's "State" value
 * @method City                setCityMetro()           Sets the current record's "City_metro" value
 * @method City                setCities()              Sets the current record's "Cities" collection
 * @method City                setCityMultipleAirport() Sets the current record's "CityMultipleAirport" collection
 * @method City                setHotels()              Sets the current record's "Hotels" collection
 * @method City                setHotelCities()         Sets the current record's "HotelCities" collection
 * 
 * @package    hyplexdemo
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCity extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('city');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('code', 'string', 3, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 3,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('airport', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('country_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('state_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('cache', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('archived', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('metropolitan', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));


        $this->index('code_index', array(
             'fields' => 
             array(
              0 => 'code',
             ),
             'type' => 'unique',
             ));
        $this->index('airport_index', array(
             'fields' => 
             array(
              0 => 'airport',
             ),
             ));
        $this->index('country_id_index', array(
             'fields' => 
             array(
              0 => 'country_id',
             ),
             ));
        $this->index('state_id_index', array(
             'fields' => 
             array(
              0 => 'state_id',
             ),
             ));
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'INNODB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Country', array(
             'local' => 'country_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('State', array(
             'local' => 'state_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('City_metro', array(
             'local' => 'id',
             'foreign' => 'city_metro_id'));

        $this->hasMany('City_metro as Cities', array(
             'refClass' => 'CityMultipleAirport',
             'local' => 'city_id',
             'foreign' => 'city_metro_id'));

        $this->hasMany('CityMultipleAirport', array(
             'local' => 'id',
             'foreign' => 'city_id'));

        $this->hasMany('Hotel as Hotels', array(
             'refClass' => 'HotelCities',
             'local' => 'city_id',
             'foreign' => 'hotel_id'));

        $this->hasMany('HotelCities', array(
             'local' => 'id',
             'foreign' => 'city_id'));

        $customgeographical0 = new Doctrine_Template_CustomGeographical();
        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'name',
             ),
             ));
        $sluggable1 = new Doctrine_Template_Sluggable(array(
             'fields' => 
             array(
              0 => 'name',
             ),
             'unique' => false,
             ));
        $i18n0->addChild($sluggable1);
        $this->actAs($customgeographical0);
        $this->actAs($i18n0);
    }
}