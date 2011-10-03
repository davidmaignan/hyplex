<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BookingPassengersForm
 *
 * @author david
 */
class BookingPassengersForm extends sfForm {
    //put your code here

    public function  configure() {

        $subForm = new sfForm();
        $this->embedForm('passengers', $subForm);

        $this->widgetSchema->setNameFormat('booking_passengers[%s]');
        $this->validatorSchema->setOption('allow_extra_fields', true);

    }

    public function addPassenger($num) {
        //$pic = new Picture();
        //$pic->setCard($this->getObject());
        $newPassenger = new PassengerForm();

        //Embedding the new picture in the container
        $this->embeddedForms['passengers']->embedForm($num, $newPassenger);
        //Re-embedding the container
        $this->embedForm('passengers', $this->embeddedForms['passengers']);
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {

        foreach ($taintedValues['passengers'] as $key => $newPic) {
            if (!isset($this['passengers'][$key])) {
                $this->addPassenger($key);
            }
        }

        parent::bind($taintedValues, $taintedFiles);
    }

}

