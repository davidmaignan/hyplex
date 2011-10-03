<?php

/**
 * Address filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAddressFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'address_1' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'address_2' => new sfWidgetFormFilterInput(),
      'city'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'state'     => new sfWidgetFormFilterInput(),
      'country'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'postcode'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'phone'     => new sfWidgetFormFilterInput(),
      'cellphone' => new sfWidgetFormFilterInput(),
      'email'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'address_1' => new sfValidatorPass(array('required' => false)),
      'address_2' => new sfValidatorPass(array('required' => false)),
      'city'      => new sfValidatorPass(array('required' => false)),
      'state'     => new sfValidatorPass(array('required' => false)),
      'country'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'postcode'  => new sfValidatorPass(array('required' => false)),
      'phone'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cellphone' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('address_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Address';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'address_1' => 'Text',
      'address_2' => 'Text',
      'city'      => 'Text',
      'state'     => 'Text',
      'country'   => 'Number',
      'postcode'  => 'Text',
      'phone'     => 'Number',
      'cellphone' => 'Number',
      'email'     => 'Text',
    );
  }
}
