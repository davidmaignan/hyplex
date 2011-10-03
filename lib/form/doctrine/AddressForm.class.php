<?php

/**
 * Address form.
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AddressForm extends BaseAddressForm
{
  public function configure()
  {

     unset($this['id']);

     $this->setWidget('card_number', new sfWidgetFormInputText(array(), array()));
     $this->setWidget('credit_card_type', new sfWidgetFormChoice(array(
         'expanded' => false,
         'choices'=> sfConfig::get('app_creditcard_accepted')
     ), array(
         
     )));

     $this->setWidget('expiration_date',new sfWidgetFormDate(
          array('format' => '%month% - %year%',
                'years' => range(date('Y'), date('Y',strtotime(date('Y') . " +15 years"))))
                //'culture'=>  sfContext::getInstance()->getUser()->getCulture())
     ));


      $this->validatorSchema->setOption('allow_extra_fields', true);
  }
}
