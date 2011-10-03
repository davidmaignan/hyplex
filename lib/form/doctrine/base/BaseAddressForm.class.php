<?php

/**
 * Address form base class.
 *
 * @method Address getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAddressForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'address_1' => new sfWidgetFormInputText(),
      'address_2' => new sfWidgetFormInputText(),
      'city'      => new sfWidgetFormInputText(),
      'state'     => new sfWidgetFormInputText(),
      'country'   => new sfWidgetFormInputText(),
      'postcode'  => new sfWidgetFormInputText(),
      'phone'     => new sfWidgetFormInputText(),
      'cellphone' => new sfWidgetFormInputText(),
      'email'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'address_1' => new sfValidatorString(array('max_length' => 255)),
      'address_2' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'      => new sfValidatorString(array('max_length' => 255)),
      'state'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'country'   => new sfValidatorInteger(),
      'postcode'  => new sfValidatorString(array('max_length' => 10)),
      'phone'     => new sfValidatorInteger(array('required' => false)),
      'cellphone' => new sfValidatorInteger(array('required' => false)),
      'email'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('address[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Address';
  }

}
