<?php

/**
 * City_metro form base class.
 *
 * @method City_metro getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCity_metroForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'city_metro_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => false)),
      'cities_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'City')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'city_metro_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'))),
      'cities_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'City', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'City_metro', 'column' => array('city_metro_id')))
    );

    $this->widgetSchema->setNameFormat('city_metro[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'City_metro';
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
