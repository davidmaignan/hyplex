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
    
  private $user;

  public static $arCards = array('Mastercard', 'Visa', 'American Express');
  //public static $arCards = array('Mastercard', 'Visa', 'American Express');

  static public function getCreditCardsArray(){

     $cardsFile = sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'misc'.DIRECTORY_SEPARATOR.'creditCard.yml';
     $arCards = sfYaml::load($cardsFile);
     return $arCards;

  }

  public function configure()
  {
     
     $this->user = sfContext::getInstance()->getUser();
     
     
      
     unset($this['id']);

     $arCards = self::getCreditCardsArray();

     $keys = range(date('Y'), date('Y',strtotime(date('Y') . " +15 years")));
     $yearValues = range(date('Y'), date('Y',strtotime(date('Y') . " +15 years")));
     $years = array_combine($keys , $yearValues);

     /*Credit card number*/
     $this->setWidget('credit_card_number', new sfWidgetFormInputText(array(
         'default'=>'5500 0000 0000 0004'
     ), array('class'=>'span-6')));

     /*Telephone*/
     $this->setWidget('telephone', new sfWidgetFormInput(array(), array('class'=>'medium')));
     
     /*Email*/
     $this->setWidget('email', new sfWidgetFormInput(array(
         'default'=>'test@hypertech.com'
     ), array('class'=>'medium')));
     $this->setWidget('email_again', new sfWidgetFormInput(array(
         'default'=>'test@hypertech.com'
     ), array('class'=>'medium')));

     /*Password*/
     $this->setWidget('password', new sfWidgetFormInputPassword(array(), array()));
     $this->setWidget('password_again', new sfWidgetFormInputPassword(array(), array()));

     /*Credit card type*/
     $this->setWidget('credit_card_type', new sfWidgetFormSelectRadio(array(
                'choices' => $arCards,
                'default'=>0), array(
                'class' => 'inline')));

     $this->setWidget('address_1', new sfWidgetFormInputText(array(), array()));
     $this->setWidget('address_2', new sfWidgetFormInputText(array(), array()));
     $this->setWidget('city', new sfWidgetFormInputText(array(), array()));
     $this->setWidget('postcode', new sfWidgetFormInputText(array(), array()));

     $this->setWidget('country', new sfWidgetFormInputText(array(), array('id'=>'country')));
     $this->setWidget('state', new sfWidgetFormInputText(array(), array('id'=>'state')));

     $this->setWidget('country_id', new sfWidgetFormInputHidden(array(), array()));

     $this->setWidget('expiration_date',new sfWidgetFormDate(
             array( 'format' => '%month% / %year%',
                    'years' => $years)
     ));
     
     
     $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('contact_form');
     $this->widgetSchema->setNameFormat('address[%s]');

     /* VALIDATORS ------------------------------------------------------- */

     /*Credit card type*/
     $this->setValidator('credit_card_type', new sfValidatorChoice(array(
                'choices' => array_keys($arCards)), array(
                'required' => 'Choose one type of card')));

     
     /*credit card number*/
     $this->setValidator('credit_card_number', new sfValidatorString(array(), array()));
     
     /*Email*/
     $this->setValidator('email', new sfValidatorEmail(array(), array()));

     /*Telephone*/
     $this->setValidator('telephone', new sfValidatorString(array(), array()));
     
     $this->setValidator('password', new sfValidatorString(array(), array()));


     $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
          new sfValidatorCallback(array('callback' => array($this, 'checkEmailConfirm'))),
          new sfValidatorCallback(array('callback' => array($this, 'checkPasswordConfirm'))),
          new sfValidatorCallback(array('callback' => array($this, 'checkCreditCard')))
        )), array(), array());

     
     $this->setValidator('expiration_date', new creditCardValidator(array(
         'month'=> range(1,12),
         'year'=>$years
     ), array(
         'required'=> 'You must provide the expiration date for your credit card',
         'invalid' => '%value% is not valid or incomplete'
     )));

     
     $this->setValidator('country', new sfValidatorString(array(), array()));
     
     $this->validatorSchema->setOption('allow_extra_fields', true);
     
     if($this->user->isAuthenticated()){
         unset($this['email'], $this['email_again'], $this['telephone'], $this['password'], $this['password_confirm']);
     }
  }


   public function checkPasswordConfirm($validator, $value) {
       
       if(!$this->user->isAuthenticated()){

        $values = $this->getTaintedValues();

        if ($values['password'] != $values['password_again']) {

            $error = new sfValidatorError($validator, 'Invalid password confirm');
            throw new sfValidatorErrorSchema($validator, array('password_again' => $error));
        }

        return $values;
        
       }
    
    }

    public function checkEmailConfirm($validator, $value) {
        
        if(!$this->user->isAuthenticated()){

        $values = $this->getTaintedValues();

        if ($values['email'] != $values['email_again']) {
            
            $error = new sfValidatorError($validator, 'Invalid email confirm');
            throw new sfValidatorErrorSchema($validator, array('email_again' => $error));

            //throw new sfValidatorError($validator, 'Enter the same email as above');
        }

        return $values;
        
        }


    }

    public function checkCreditCard($validator, $value){

        $values = $this->getTaintedValues();

        if(isset($values['credit_card_type']) && isset($values['credit_card_number'])){

            $arCards = self::getCreditCardsArray();

            $credit_card_type = $arCards[$values['credit_card_type']];
            $credit_card_number = $values['credit_card_number'];
            $check = Utils::checkCreditCard($credit_card_number, $credit_card_type, $errornumber, $errortext);
            if(!$check){
                $error = new sfValidatorError($validator, 'Invalid credit card number');
                throw new sfValidatorErrorSchema($validator, array('credit_card_number' => $error));
            }
        }
    }


}
