<?php

/**
 * HotelTranslation form base class.
 *
 * @method HotelTranslation getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHotelTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'short_description' => new sfWidgetFormTextarea(),
      'long_description'  => new sfWidgetFormTextarea(),
      'lang'              => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'short_description' => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'long_description'  => new sfValidatorString(array('required' => false)),
      'lang'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hotel_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HotelTranslation';
  }

}
