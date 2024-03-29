<?php

/**
 * BaseBooking
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $booking_id
 * @property object $object
 * @property integer $user_id
 * @property sfGuardUser $sfGuardUser
 * 
 * @method string      getBookingId()   Returns the current record's "booking_id" value
 * @method object      getObject()      Returns the current record's "object" value
 * @method integer     getUserId()      Returns the current record's "user_id" value
 * @method sfGuardUser getSfGuardUser() Returns the current record's "sfGuardUser" value
 * @method Booking     setBookingId()   Sets the current record's "booking_id" value
 * @method Booking     setObject()      Sets the current record's "object" value
 * @method Booking     setUserId()      Sets the current record's "user_id" value
 * @method Booking     setSfGuardUser() Sets the current record's "sfGuardUser" value
 * 
 * @package    hyplexdemo
 * @subpackage model
 * @author     David Maignan
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBooking extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('booking');
        $this->hasColumn('booking_id', 'string', 255, array(
             'type' => 'string',
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('object', 'object', null, array(
             'type' => 'object',
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'INNODB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}