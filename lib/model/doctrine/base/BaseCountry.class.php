<?php

/**
 * BaseCountry
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $area_id
 * @property boolean $state
 * @property Area $Area
 * @property State $States
 * @property City $Cities
 * 
 * @method integer getId()      Returns the current record's "id" value
 * @method string  getCode()    Returns the current record's "code" value
 * @method string  getName()    Returns the current record's "name" value
 * @method integer getAreaId()  Returns the current record's "area_id" value
 * @method boolean getState()   Returns the current record's "state" value
 * @method Area    getArea()    Returns the current record's "Area" value
 * @method State   getStates()  Returns the current record's "States" value
 * @method City    getCities()  Returns the current record's "Cities" value
 * @method Country setId()      Sets the current record's "id" value
 * @method Country setCode()    Sets the current record's "code" value
 * @method Country setName()    Sets the current record's "name" value
 * @method Country setAreaId()  Sets the current record's "area_id" value
 * @method Country setState()   Sets the current record's "state" value
 * @method Country setArea()    Sets the current record's "Area" value
 * @method Country setStates()  Sets the current record's "States" value
 * @method Country setCities()  Sets the current record's "Cities" value
 * 
 * @package    hyplexdemo
 * @subpackage model
 * @author     David Maignan
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCountry extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('country');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('code', 'string', 2, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 2,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('area_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('state', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));


        $this->index('area_id_index', array(
             'fields' => 
             array(
              0 => 'area_id',
             ),
             ));
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'INNODB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Area', array(
             'local' => 'area_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('State as States', array(
             'local' => 'id',
             'foreign' => 'country_id'));

        $this->hasOne('City as Cities', array(
             'local' => 'id',
             'foreign' => 'country_id'));

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
        $this->actAs($i18n0);
    }
}