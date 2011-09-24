<?php

/**
 * Hotel form base class.
 *
 * @method Hotel getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHotelForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'hotel_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cities'), 'add_empty' => false)),
      'name'          => new sfWidgetFormInputText(),
      'BaseImageLink' => new sfWidgetFormInputText(),
      'star_rating'   => new sfWidgetFormInputText(),
      'address1'      => new sfWidgetFormInputText(),
      'address2'      => new sfWidgetFormInputText(),
      'postalCode'    => new sfWidgetFormInputText(),
      'city'          => new sfWidgetFormInputText(),
      'state_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('State'), 'add_empty' => false)),
      'country_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => false)),
      'location_id'   => new sfWidgetFormInputText(),
      'parking'       => new sfWidgetFormInputCheckbox(),
      'restaurant'    => new sfWidgetFormInputCheckbox(),
      'internet'      => new sfWidgetFormInputCheckbox(),
      'pool'          => new sfWidgetFormInputCheckbox(),
      'fitness'       => new sfWidgetFormInputCheckbox(),
      'latitude'      => new sfWidgetFormInputText(),
      'longitude'     => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'cities_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'City')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'hotel_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cities'))),
      'name'          => new sfValidatorString(array('max_length' => 255)),
      'BaseImageLink' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'star_rating'   => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'address1'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address2'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'postalCode'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'city'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'state_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('State'))),
      'country_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Country'))),
      'location_id'   => new sfValidatorInteger(),
      'parking'       => new sfValidatorBoolean(array('required' => false)),
      'restaurant'    => new sfValidatorBoolean(array('required' => false)),
      'internet'      => new sfValidatorBoolean(array('required' => false)),
      'pool'          => new sfValidatorBoolean(array('required' => false)),
      'fitness'       => new sfValidatorBoolean(array('required' => false)),
      'latitude'      => new sfValidatorPass(array('required' => false)),
      'longitude'     => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'cities_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'City', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Hotel', 'column' => array('hotel_id'))),
        new sfValidatorDoctrineUnique(array('model' => 'Hotel', 'column' => array('hotel_id'))),
        new sfValidatorDoctrineUnique(array('model' => 'Hotel', 'column' => array('country_id'))),
      ))
    );

    $this->widgetSchema->setNameFormat('hotel[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Hotel';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['cities_list']))
    {
      $this->setDefault('cities_list', $this->object->Cities->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveCitiesList($con);

    parent::doSave($con);
  }

  public function saveCitiesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['cities_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Cities->getPrimaryKeys();
    $values = $this->getValue('cities_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Cities', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Cities', array_values($link));
    }
  }

}
