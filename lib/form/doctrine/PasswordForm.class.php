<?php

class PasswordForm extends sfForm {

    public function configure() {

        $this->setWidget('password', new sfWidgetFormInputPassword(array(
                        ), array(
                    'class' => 'text span-7'))
        );
        $this->setWidget('password_confirm', new sfWidgetFormInputPassword(array(
                        ), array(
                    'class' => 'text span-7'))
        );

        $this->setValidator('password', new sfValidatorString(array(
                    'required' => true),
                        array(
                )));

        $this->setValidator('password_confirm', new sfValidatorString(array(
                    'required' => true),
                        array(
                )));

        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'checkPassword'))));

        $this->widgetSchema->setNameFormat('change_password[%s]');
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('contact_form');
    }

    public function checkPassword() {
        $validator = $this->getValidatorSchema();
        $values = $this->getTaintedValues();

        if ($values['password'] != $values['password_confirm']) {
            throw new sfValidatorError($validator, 'You must confirm your new password');
        }
    }

}