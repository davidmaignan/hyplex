<?php

/**
 * Passenger form.
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PassengerChildForm extends PassengerAdultForm
{
    protected  static $title = array('Mstr'=>'Mstr','Miss'=>'Miss');
    protected static $titleValidation = array('Mstr'=>'Mstr','Miss'=>'Miss');

    public function  configure() {

        parent::configure();

        $this->setWidget('salutation', new sfWidgetFormSelect(array(
                'choices' => self::$title), array(
                'invalid' =>'required',
                'class' => 'inline')));

        $this->setValidator('salutation', new sfValidatorChoice(array(
                'choices' => array_keys(self::$titleValidation)), array(
                'required' => 'Choose a gender')));

        $this->setWidget('dob', new sfWidgetFormInputText(array(),array('class'=>'dob span-3')));


        $this->setValidator('dob', new sfValidatorAnd(array(
             new sfValidatorDate(array(
                 'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
                 'date_output' => 'Y-m-d',
             ), array(
                 'bad_format' => 'Return date %value% does not match the format (yyyy-mm-dd)'
             ))
             ),array(),array(
         )));

        $this->widgetSchema->setLabels(array(
            'salutation' => 'Title',
            'dob'=>'Date of birth',
            'airline_code'=>'Airline'
     ));

        $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('contact_form');
    }


}
