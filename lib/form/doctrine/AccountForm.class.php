<?php

class AccountForm extends sfForm {
    
     public function configure() {
         
         /*Telephone*/
        $this->setWidget('telephone', new sfWidgetFormInput(array(), array('class'=>'medium')));

        /*Email*/
        $this->setWidget('email', new sfWidgetFormInput(array(), array('class'=>'medium')));
        $this->setWidget('email_again', new sfWidgetFormInput(array(), array('class'=>'medium')));

        /*Password*/
        $this->setWidget('password', new sfWidgetFormInputPassword(array(), array()));
        $this->setWidget('password_again', new sfWidgetFormInputPassword(array(), array()));
        
        $this->setWidget('address_1', new sfWidgetFormInputText(array(), array()));
        $this->setWidget('address_2', new sfWidgetFormInputText(array(), array()));
        $this->setWidget('city', new sfWidgetFormInputText(array(), array()));
        $this->setWidget('postcode', new sfWidgetFormInputText(array(), array()));

        $this->setWidget('country', new sfWidgetFormInputText(array(), array('id'=>'country')));
        $this->setWidget('state', new sfWidgetFormInputText(array(), array('id'=>'state')));

        $this->setWidget('country_id', new sfWidgetFormInputHidden(array(), array()));
        
        
        $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('contact_form');
        $this->widgetSchema->setNameFormat('account[%s]');
        $this->validatorSchema->setOption('allow_extra_fields', true);
        
        
        
        $this->setValidator('country', new sfValidatorString(array(), array()));
     
        /*Email*/
        $this->setValidator('email', new sfValidatorEmail(array(), array()));

        /*Telephone*/
        $this->setValidator('telephone', new sfValidatorString(array(), array()));

        $this->setValidator('address_1', new sfValidatorString(array(), array()));
        $this->setValidator('address_2', new sfValidatorString(array(), array()));
        $this->setValidator('city', new sfValidatorString(array(), array()));
        $this->setValidator('postcode', new sfValidatorString(array(), array()));
        
        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
          new sfValidatorCallback(array('callback' => array($this, 'checkEmailConfirm'))),
          new sfValidatorCallback(array('callback' => array($this, 'checkPasswordConfirm'))),
          new sfValidatorCallback(array('callback' => array($this, 'checkCreditCard')))
        )), array(), array());

        
     }

    public function checkPasswordConfirm($validator, $value) {
       
       

        $values = $this->getTaintedValues();

        if ($values['password'] != $values['password_again']) {

            $error = new sfValidatorError($validator, 'Invalid password confirm');
            throw new sfValidatorErrorSchema($validator, array('password_again' => $error));
        }

        return $values;
        
       
    
    }

    public function checkEmailConfirm($validator, $value) {
        
       

        $values = $this->getTaintedValues();

        if ($values['email'] != $values['email_again']) {
            
            $error = new sfValidatorError($validator, 'Invalid email confirm');
            throw new sfValidatorErrorSchema($validator, array('email_again' => $error));

            //throw new sfValidatorError($validator, 'Enter the same email as above');
        }

        return $values;
        
        


    }
}
