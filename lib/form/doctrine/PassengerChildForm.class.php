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
    protected  static $title = array('','Mstr'=>'Mstr','Miss'=>'Miss');
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
    }


}
