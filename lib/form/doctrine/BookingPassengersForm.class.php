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
        $this->embedForm('adults', $subForm);

        $subForm = new sfForm();
        $this->embedForm('children', $subForm);

        $this->widgetSchema->setNameFormat('booking_passengers[%s]');
        $this->validatorSchema->setOption('allow_extra_fields', true);

    }

    public function addAdult($num) {
        //$pic = new Picture();
        //$pic->setCard($this->getObject());
        $newPassenger = new PassengerAdultForm();

        //Embedding the new picture in the container
        $this->embeddedForms['adults']->embedForm($num, $newPassenger);
        //Re-embedding the container
        $this->embedForm('adults', $this->embeddedForms['adults']);
    }

    public function addChild($num) {
        //$pic = new Picture();
        //$pic->setCard($this->getObject());
        $newPassenger = new PassengerChildForm();

        //Embedding the new picture in the container
        $this->embeddedForms['children']->embedForm($num, $newPassenger);
        //Re-embedding the container
        $this->embedForm('children', $this->embeddedForms['children']);
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {

        if(isset($taintedValues['adults'])){
            foreach ($taintedValues['adults'] as $key => $newPic) {
                if (!isset($this['adults'][$key])) {
                    $this->addAdult($key);
                }
            }
        }

        if(isset($taintedValues['children'])){
            foreach ($taintedValues['children'] as $key => $newPic) {
                if (!isset($this['children'][$key])) {
                    $this->addChild($key);
                }
            }
        }

        parent::bind($taintedValues, $taintedFiles);
    }

}

