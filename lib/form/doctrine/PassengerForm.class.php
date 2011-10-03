<?php

/**
 * Passenger form.
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PassengerForm extends BasePassengerForm
{

  public function configure()
  {
     unset($this['bookings_list'], $this['gender'], $this['p_type']);
     $this->setWidget('p_type', new sfWidgetFormInputHidden(array(),array()));
     $this->setWidget('gender', new sfWidgetFormInputHidden(array(),array()));

     $this->setWidget('dob', new sfWidgetFormInputText(array(),array('class'=>'dob')));
     $this->setWidget('airline_code', new sfWidgetFormInputText(array(),array('class'=>'airline_code')));

     $this->setValidator('dob', new sfValidatorDate(array(
                    'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
                    'date_output' => 'Y-m-d'), array(
                    'required' => 'Please enter a date of birth',
                    'bad_format' => 'Return date %value% does not match the format (yyyy-mm-dd)')
             ));

     $this->setWidget('meal_preference', new sfWidgetFormSelect(array(
         'choices'=> sfConfig::get('app_meals_available')
     ), array()));

     $this->setWidget('special_assistance', new sfWidgetFormSelect(array(
         'choices'=> sfConfig::get('app_special_assistance')
     ), array()));

     $this->widgetSchema->setLabels(array(
            'salutation' => 'Title',
            'dob'=>'Date of birth <span class="grey2"> (yyyy-mm-dd)</span>',
            'airline_code'=>'Airline'
     ));

     $this->validatorSchema->setOption('allow_extra_fields', true);

  }

  public function checkDepartDate($validator, $value){
      ob_start();
      echo 'here';

      var_dump($this->getTaintedValues());

  }

  
}
