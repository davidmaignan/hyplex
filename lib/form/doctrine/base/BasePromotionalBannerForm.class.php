<?php

/**
 * PromotionalBanner form base class.
 *
 * @method PromotionalBanner getObject() Returns the current form's model object
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePromotionalBannerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'filename'   => new sfWidgetFormInputText(),
      'color_bg'   => new sfWidgetFormInputText(),
      'position'   => new sfWidgetFormChoice(array('choices' => array('left' => 'left', 'right' => 'right'))),
      'rank'       => new sfWidgetFormInputText(),
      'start_at'   => new sfWidgetFormDateTime(),
      'expires_at' => new sfWidgetFormDateTime(),
      'published'  => new sfWidgetFormInputCheckbox(),
      'archived'   => new sfWidgetFormInputCheckbox(),
      'link'       => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'filename'   => new sfValidatorString(array('max_length' => 255)),
      'color_bg'   => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'position'   => new sfValidatorChoice(array('choices' => array(0 => 'left', 1 => 'right'), 'required' => false)),
      'rank'       => new sfValidatorInteger(),
      'start_at'   => new sfValidatorDateTime(array('required' => false)),
      'expires_at' => new sfValidatorDateTime(array('required' => false)),
      'published'  => new sfValidatorBoolean(array('required' => false)),
      'archived'   => new sfValidatorBoolean(array('required' => false)),
      'link'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('promotional_banner[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PromotionalBanner';
  }

}
