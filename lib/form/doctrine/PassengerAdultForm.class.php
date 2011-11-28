<?php

/**
 * Passenger form.
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PassengerAdultForm extends BasePassengerForm
{

  protected static $gender = array('male','female');
  protected static $title = array('Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms','Dr'=>'Dr');
  protected static $titleValidation = array('Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms','Dr'=>'Dr');
  

  public function configure()
  {

     $culture = sfContext::getInstance()->getUser()->getCulture();
     $mealPreference = Utils::createMealPreferenceArray($culture);
     $specialServices = Utils::createSpecialServicesArray($culture);

     unset($this['bookings_list']);
     //$this->setWidget('p_type', new sfWidgetFormInputHidden(array(),array()));
     //$this->setWidget('gender', new sfWidgetFormSelectRadio(array(), array()));

     $this->setWidget('salutation', new sfWidgetFormSelect(array(
                'choices' => self::$title), array(
                'invalid' =>'required',
                'class' => 'inline')));

     $this->setValidator('salutation', new sfValidatorChoice(array(
                'choices' => array_keys(self::$titleValidation)), array(
                'required' => 'Choose a gender')));


     $this->setWidget('gender', new sfWidgetFormSelectRadio(array(
                'choices' => self::$gender), array(
                'class' => 'inline')));

     $this->setValidator('gender', new sfValidatorChoice(array(
                'choices' => array_keys(self::$gender)), array(
                'required' => 'Choose a gender')));


     $this->setWidget('dob', new sfWidgetFormInputText(array(),array('class'=>'dob span-3','value'=>'1970-10-10')));
     $this->setWidget('airline_code', new sfWidgetFormInputText(array(),array('class'=>'airline_code')));     

     $this->setWidget('meal_preference', new sfWidgetFormSelect(array(
         'choices'=> $mealPreference
     ), array()));

     $this->setWidget('special_assistance', new sfWidgetFormSelect(array(
         'choices'=> $specialServices
     ), array()));

     $this->widgetSchema->setLabels(array(
            'salutation' => 'Title',
            'dob'=>'Date of birth',
            'airline_code'=>'Airline'
     ));


     $this->setValidator('dob', new sfValidatorAnd(array(
         new sfValidatorCallback(array('callback' => array($this, 'checkDOB'))),
         new sfValidatorDate(array(
             'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
             'date_output' => 'Y-m-d',
         ), array('bad_format' => 'Return date %value% does not match the format (yyyy-mm-dd)'))
         ), array(),array()));

     $this->validatorSchema->setOption('allow_extra_fields', true);
     $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('contact_form');
     $this->setWidget('first_name', new sfWidgetFormInput(array(), array('value'=>'Tomi')));
     $this->setWidget('last_name', new sfWidgetFormInput(array(), array('value'=>'Klemm')));

  }

  public function checkDOB($validator, $values)
  {
    ob_start();
    
    $dob = explode('-', $values);

    if($values == ''){
        $error = new sfValidatorError($validator, 'dob invalid');
        throw new sfValidatorErrorSchema($validator, array('invalid' => $error));
    }

    if(!@checkdate( $dob[1], $dob[2], $dob[0])){
        $error = new sfValidatorError($validator, 'dob invalid');
        throw new sfValidatorErrorSchema($validator, array($error));
    }

    $currentDate = date("Y-m-d");// current date
    $less18  = strtotime(date("Y-m-d", strtotime($currentDate)) . " -18 year");    

    if($values > date('Y-m-d',$less18)){
        $error = new sfValidatorError($validator, 'You must be at least 18 years old');
        throw new sfValidatorErrorSchema($validator, array($error));
    }
    
    // password is correct, return the clean values
    return $values;
  }



  
}
