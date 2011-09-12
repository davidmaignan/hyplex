<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SearchFlightForm
 *
 * @author david
 */
class SearchFlightIphoneForm extends SearchFlightForm {

    public function  configure() {

        parent::configure();


        $this->setWidget('depart_date', new sfWidgetFormInputHidden());
        $this->setWidget('return_date', new sfWidgetFormInputHidden());
        
        $this->setWidget('number_adults', new sfWidgetFormSelect(array(
            'choices'=>  self::$arAdults
        ), array()));
        $this->setWidget('number_children', new sfWidgetFormSelect(array(
            'choices'=>range(0,6)
        ), array()));
         $this->setWidget('number_infants', new sfWidgetFormSelect(array(
            'choices'=>range(0,6)
        ), array()));


        $this->widgetSchema->setLabels(array(
            'origin' => 'From',
            'destination' => 'To',
            'number_adults' => 'Adults',
            'number_children' => 'Children (2-12)',
            'number_infants' => 'Infants (0-2)',
        ));

        

        $this->validatorSchema->setOption('allow_extra_fields', true);
    }


     public function checkChildInfant() {

        //echo 'checkChildInfant';

        $validator = $this->getValidatorSchema();
        $values = $this->getTaintedValues();
        //ob_start();
        //var_dump($values);

        $nbInfants = $values['number_infants'];


        if ($nbInfants > $values['number_adults']) {
            throw new sfValidatorError($validator, "The number of infants can't exceed the number of adults");
        }

        //break;
    }

}

?>
