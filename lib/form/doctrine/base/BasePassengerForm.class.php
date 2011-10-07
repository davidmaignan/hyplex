<?php

/**
 * Passenger form base class.
 *
 * @method Passenger getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePassengerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'salutation'            => new sfWidgetFormChoice(array('choices' => array('Mr' => 'Mr', 'Ms' => 'Ms', 'Mrs' => 'Mrs', 'Dr' => 'Dr'))),
      'first_name'            => new sfWidgetFormInputText(),
      'middle_name'           => new sfWidgetFormInputText(),
      'last_name'             => new sfWidgetFormInputText(),
      'gender'                => new sfWidgetFormChoice(array('choices' => array('male' => 'male', 'female' => 'female'))),
      'dob'                   => new sfWidgetFormInputText(),
      'p_type'                => new sfWidgetFormChoice(array('choices' => array('ADT' => 'ADT', 'CHD' => 'CHD'))),
      'frequent_flyer_number' => new sfWidgetFormInputText(),
      'airline_code'          => new sfWidgetFormInputText(),
      'meal_preference'       => new sfWidgetFormInputText(),
      'special_assistance'    => new sfWidgetFormInputText(),
      'bookings_list'         => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Booking')),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'salutation'            => new sfValidatorChoice(array('choices' => array(0 => 'Mr', 1 => 'Ms', 2 => 'Mrs', 3 => 'Dr'), 'required' => false)),
      'first_name'            => new sfValidatorString(array('max_length' => 100)),
      'middle_name'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'last_name'             => new sfValidatorString(array('max_length' => 100)),
      'gender'                => new sfValidatorChoice(array('choices' => array(0 => 'male', 1 => 'female'), 'required' => false)),
      'dob'                   => new sfValidatorString(array('max_length' => 10)),
      'p_type'                => new sfValidatorChoice(array('choices' => array(0 => 'ADT', 1 => 'CHD'), 'required' => false)),
      'frequent_flyer_number' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'airline_code'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'meal_preference'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'special_assistance'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'bookings_list'         => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Booking', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('passenger[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Passenger';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['bookings_list']))
    {
      $this->setDefault('bookings_list', $this->object->Bookings->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveBookingsList($con);

    parent::doSave($con);
  }

  public function saveBookingsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['bookings_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Bookings->getPrimaryKeys();
    $values = $this->getValue('bookings_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Bookings', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Bookings', array_values($link));
    }
  }

}
