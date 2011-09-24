<?php

/**
 * AirportTranslation filter form base class.
 *
 * @package    hypertech_booking
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAirportTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'      => new sfWidgetFormFilterInput(),
      'city_name' => new sfWidgetFormFilterInput(),
      'country'   => new sfWidgetFormFilterInput(),
      'region'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'      => new sfValidatorPass(array('required' => false)),
      'city_name' => new sfValidatorPass(array('required' => false)),
      'country'   => new sfValidatorPass(array('required' => false)),
      'region'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('airport_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AirportTranslation';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'name'      => 'Text',
      'city_name' => 'Text',
      'country'   => 'Text',
      'region'    => 'Text',
      'lang'      => 'Text',
    );
  }
}
