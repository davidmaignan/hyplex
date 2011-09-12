<?php

/**
 * HotelTranslation filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHotelTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'short_description' => new sfWidgetFormFilterInput(),
      'long_description'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'short_description' => new sfValidatorPass(array('required' => false)),
      'long_description'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hotel_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HotelTranslation';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'short_description' => 'Text',
      'long_description'  => 'Text',
      'lang'              => 'Text',
    );
  }
}
