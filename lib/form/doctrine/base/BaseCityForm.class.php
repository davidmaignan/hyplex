<?php

/**
 * City form base class.
 *
 * @method City getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCityForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'code'         => new sfWidgetFormInputText(),
      'airport'      => new sfWidgetFormInputText(),
      'country_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => false)),
      'state_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('State'), 'add_empty' => true)),
      'cache'        => new sfWidgetFormInputCheckbox(),
      'archived'     => new sfWidgetFormInputCheckbox(),
      'metropolitan' => new sfWidgetFormInputCheckbox(),
      'latitude'     => new sfWidgetFormInputText(),
      'longitude'    => new sfWidgetFormInputText(),
      'cities_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'City_metro')),
      'hotels_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Hotel')),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'         => new sfValidatorString(array('max_length' => 3)),
      'airport'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'country_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Country'))),
      'state_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('State'), 'required' => false)),
      'cache'        => new sfValidatorBoolean(array('required' => false)),
      'archived'     => new sfValidatorBoolean(array('required' => false)),
      'metropolitan' => new sfValidatorBoolean(array('required' => false)),
      'latitude'     => new sfValidatorNumber(array('required' => false)),
      'longitude'    => new sfValidatorNumber(array('required' => false)),
      'cities_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'City_metro', 'required' => false)),
      'hotels_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Hotel', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'City', 'column' => array('code'))),
        new sfValidatorDoctrineUnique(array('model' => 'City', 'column' => array('code'))),
      ))
    );

    $this->widgetSchema->setNameFormat('city[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'City';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['cities_list']))
    {
      $this->setDefault('cities_list', $this->object->Cities->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['hotels_list']))
    {
      $this->setDefault('hotels_list', $this->object->Hotels->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveCitiesList($con);
    $this->saveHotelsList($con);

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

  public function saveHotelsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['hotels_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Hotels->getPrimaryKeys();
    $values = $this->getValue('hotels_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Hotels', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Hotels', array_values($link));
    }
  }

}
