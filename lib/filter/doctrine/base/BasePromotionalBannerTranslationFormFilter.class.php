<?php

/**
 * PromotionalBannerTranslation filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePromotionalBannerTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'message' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'message' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('promotional_banner_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PromotionalBannerTranslation';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'message' => 'Text',
      'lang'    => 'Text',
    );
  }
}
