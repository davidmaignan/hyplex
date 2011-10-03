<?php

/**
 * BookingPassenger form base class.
 *
 * @method BookingPassenger getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBookingPassengerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'booking_id'   => new sfWidgetFormInputHidden(),
      'passenger_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'booking_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('booking_id')), 'empty_value' => $this->getObject()->get('booking_id'), 'required' => false)),
      'passenger_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('passenger_id')), 'empty_value' => $this->getObject()->get('passenger_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('booking_passenger[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BookingPassenger';
  }

}
