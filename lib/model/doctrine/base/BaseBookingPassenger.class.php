<?php

/**
 * BaseBookingPassenger
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $booking_id
 * @property integer $passenger_id
 * @property Booking $Booking
 * @property Passenger $Passenger
 * 
 * @method integer          getBookingId()    Returns the current record's "booking_id" value
 * @method integer          getPassengerId()  Returns the current record's "passenger_id" value
 * @method Booking          getBooking()      Returns the current record's "Booking" value
 * @method Passenger        getPassenger()    Returns the current record's "Passenger" value
 * @method BookingPassenger setBookingId()    Sets the current record's "booking_id" value
 * @method BookingPassenger setPassengerId()  Sets the current record's "passenger_id" value
 * @method BookingPassenger setBooking()      Sets the current record's "Booking" value
 * @method BookingPassenger setPassenger()    Sets the current record's "Passenger" value
 * 
 * @package    hyplexdemo
 * @subpackage model
 * @author     David Maignan
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBookingPassenger extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('booking_passenger');
        $this->hasColumn('booking_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('passenger_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'INNODB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Booking', array(
             'local' => 'booking_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Passenger', array(
             'local' => 'passenger_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}