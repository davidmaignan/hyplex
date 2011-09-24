<?php

/**
 * BaseArea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property Country $Countries
 * 
 * @method integer getId()        Returns the current record's "id" value
 * @method string  getCode()      Returns the current record's "code" value
 * @method string  getName()      Returns the current record's "name" value
 * @method Country getCountries() Returns the current record's "Countries" value
 * @method Area    setId()        Sets the current record's "id" value
 * @method Area    setCode()      Sets the current record's "code" value
 * @method Area    setName()      Sets the current record's "name" value
 * @method Area    setCountries() Sets the current record's "Countries" value
 * 
 * @package    hyplexdemo
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseArea extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('area');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('code', 'string', 4, array(
             'type' => 'string',
             'unique' => true,
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'INNODB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Country as Countries', array(
             'local' => 'id',
             'foreign' => 'area_id'));

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