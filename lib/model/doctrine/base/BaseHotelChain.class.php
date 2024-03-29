<?php

/**
 * BaseHotelChain
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $tag
 * @property string $name
 * 
 * @method string     getTag()  Returns the current record's "tag" value
 * @method string     getName() Returns the current record's "name" value
 * @method HotelChain setTag()  Sets the current record's "tag" value
 * @method HotelChain setName() Sets the current record's "name" value
 * 
 * @package    hyplexdemo
 * @subpackage model
 * @author     David Maignan
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseHotelChain extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hotel_chain');
        $this->hasColumn('tag', 'string', 2, array(
             'type' => 'string',
             'unique' => true,
             'length' => 2,
             ));
        $this->hasColumn('name', 'string', 255, array(
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
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'fields' => 
             array(
              0 => 'name',
             ),
             'unique' => true,
             ));
        $this->actAs($sluggable0);
    }
}