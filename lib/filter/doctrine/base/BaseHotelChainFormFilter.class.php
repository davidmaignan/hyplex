<?php

/**
 * HotelChain filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHotelChainFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tag'  => new sfWidgetFormFilterInput(),
      'name' => new sfWidgetFormFilterInput(),
      'slug' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'tag'  => new sfValidatorPass(array('required' => false)),
      'name' => new sfValidatorPass(array('required' => false)),
      'slug' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hotel_chain_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HotelChain';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'tag'  => 'Text',
      'name' => 'Text',
      'slug' => 'Text',
    );
  }
}
