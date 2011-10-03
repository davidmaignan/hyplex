<?php

/**
 * Booking form base class.
 *
 * @method Booking getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBookingForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'title'      => new sfWidgetFormInputText(),
      'cover'      => new sfWidgetFormInputText(),
      'director'   => new sfWidgetFormInputText(),
      'address_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Address'), 'add_empty' => true)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'actor_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Passenger')),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'cover'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'director'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Address'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'actor_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Passenger', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('booking[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Booking';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['actor_list']))
    {
      $this->setDefault('actor_list', $this->object->Actor->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveActorList($con);

    parent::doSave($con);
  }

  public function saveActorList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['actor_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Actor->getPrimaryKeys();
    $values = $this->getValue('actor_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Actor', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Actor', array_values($link));
    }
  }

}
