<?php

/**
 * BasePassenger
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property enum $salutation
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property enum $gender
 * @property string $dob
 * @property enum $p_type
 * @property string $frequent_flyer_number
 * @property string $airline_code
 * @property string $meal_preference
 * @property string $special_assistance
 * 
 * @method integer   getId()                    Returns the current record's "id" value
 * @method enum      getSalutation()            Returns the current record's "salutation" value
 * @method string    getFirstName()             Returns the current record's "first_name" value
 * @method string    getMiddleName()            Returns the current record's "middle_name" value
 * @method string    getLastName()              Returns the current record's "last_name" value
 * @method enum      getGender()                Returns the current record's "gender" value
 * @method string    getDob()                   Returns the current record's "dob" value
 * @method enum      getPType()                 Returns the current record's "p_type" value
 * @method string    getFrequentFlyerNumber()   Returns the current record's "frequent_flyer_number" value
 * @method string    getAirlineCode()           Returns the current record's "airline_code" value
 * @method string    getMealPreference()        Returns the current record's "meal_preference" value
 * @method string    getSpecialAssistance()     Returns the current record's "special_assistance" value
 * @method Passenger setId()                    Sets the current record's "id" value
 * @method Passenger setSalutation()            Sets the current record's "salutation" value
 * @method Passenger setFirstName()             Sets the current record's "first_name" value
 * @method Passenger setMiddleName()            Sets the current record's "middle_name" value
 * @method Passenger setLastName()              Sets the current record's "last_name" value
 * @method Passenger setGender()                Sets the current record's "gender" value
 * @method Passenger setDob()                   Sets the current record's "dob" value
 * @method Passenger setPType()                 Sets the current record's "p_type" value
 * @method Passenger setFrequentFlyerNumber()   Sets the current record's "frequent_flyer_number" value
 * @method Passenger setAirlineCode()           Sets the current record's "airline_code" value
 * @method Passenger setMealPreference()        Sets the current record's "meal_preference" value
 * @method Passenger setSpecialAssistance()     Sets the current record's "special_assistance" value
 * 
 * @package    hyplexdemo
 * @subpackage model
 * @author     David Maignan
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePassenger extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('passenger');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('salutation', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'Mr',
              1 => 'Ms',
              2 => 'Mrs',
              3 => 'Dr',
             ),
             ));
        $this->hasColumn('first_name', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('middle_name', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('last_name', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('gender', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'male',
              1 => 'female',
             ),
             ));
        $this->hasColumn('dob', 'string', 10, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 10,
             ));
        $this->hasColumn('p_type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'ADT',
              1 => 'CHD',
             ),
             ));
        $this->hasColumn('frequent_flyer_number', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             ));
        $this->hasColumn('airline_code', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('meal_preference', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('special_assistance', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'INNODB');
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}