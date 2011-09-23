<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SearchHotelForm
 *
 * @author david
 */
class SearchHotelFormEdit extends sfForm {

    //put your code here

    protected static $arRooms = array('1_room' => '1 room', '2_room' => '2 rooms', '3_room' => '3+ rooms');
    protected static $arAdults = array(1 => '1', '2', '3', '4', '5', '6');
    protected static $arChildren = array('0', '1', '2', '3', '4', '5', '6');

    public function configure() {

        $subForm = new sfForm();
        for ($i = 1; $i < 2; $i++) {


            $form = new HotelRoomForm();

            $subForm->embedForm($i, $form);
        }

        $this->embedForm('newRooms', $subForm);

        $newSubForm = new sfForm();
        $this->embedForm('childrenAge', $newSubForm);

        $this->setWidget('wherebox',new sfWidgetFormInputText(array(), array(
                'class' => 'span-7 last',
                'autocomplete' => 'off',
                'autocapitalize' => 'off',
                'autocorrect' => 'off'
        )));

        $this->setWidget('checkin_date',new sfWidgetFormInputText(array(), array('class' => 'span-3')));
        $this->setWidget('checkout_date',new sfWidgetFormInputText(array(), array('class' => 'span-3')));
        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => 'hotelSimple')));


        $this->setValidator('wherebox', new sfValidatorString(array(
                'required' => true), array(
                'required' => 'Unrecognized destination, please check and re-enter')));


        $this->setValidator('checkin_date', new sfValidatorAnd(array(
                new sfValidatorDate(array(
                    'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
                    'date_output' => 'Y-m-d',
                    'date_format_range_error' => 'Y-m-d'), array(
                    'bad_format' => 'Checkin date %value% does not match the format (yyyy-mm-dd)')),
                new sfValidatorCallback(array('callback' => array($this, 'checkDepartDate')))
                    ), array(
                'required' => true,
                    ), array(
                'required' => 'Please enter a checkin date',
            )));



        $this->setValidator('checkout_date', new sfValidatorAnd(array(
                new sfValidatorDate(array(
                    'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
                    'date_output' => 'Y-m-d',
                    'date_format_range_error' => 'Y-m-d'), array(
                    'required' => 'Please enter a checkout date',
                    'bad_format' => 'Return date %value% does not match the format (yyyy-mm-dd)')),
                new sfValidatorCallback(array('callback' => array($this, 'checkReturnDate')))
                    ), array(
                'required' => true,
                    ), array(
                'required' => 'Please enter a return date'
            )));



        /*
        $this->setValidators(array(
            'wherebox' => new sfValidatorString(array(
                'required' => true), array(
                'required' => 'Unrecognized destination, please check and re-enter')),
            'checkin_date' => new sfValidatorAnd(array(
                new sfValidatorDate(array(
                    'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
                    'date_output' => 'Y-m-d',
                    'date_format_range_error' => 'Y-m-d'), array(
                    'bad_format' => 'Checkin date %value% does not match the format (yyyy-mm-dd)')),
                new sfValidatorCallback(array('callback' => array($this, 'checkDepartDate')))
                    ), array(
                'required' => true,
                    ), array(
                'required' => 'Please enter a checkin date',
            )),
            'checkout_date' => new sfValidatorAnd(array(
                new sfValidatorDate(array(
                    'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
                    'date_output' => 'Y-m-d',
                    'date_format_range_error' => 'Y-m-d'), array(
                    'required' => 'Please enter a checkout date',
                    'bad_format' => 'Return date %value% does not match the format (yyyy-mm-dd)')),
                new sfValidatorCallback(array('callback' => array($this, 'checkReturnDate')))
                    ), array(
                'required' => true,
                    ), array(
                'required' => 'Please enter a return date'
            )),
        ));
         *
         */

        $this->widgetSchema->setLabels(array(
            'number_adults' => 'Adults',
            'number_children' => 'Children (0-17)',
        ));


        $this->widgetSchema->setNameFormat('search_hotel[%s]');
        $this->validatorSchema->setOption('allow_extra_fields', true);
    }

    public function checkDepartDate($validator, $value) {
        //ob_start();
        //print($value);
        //echo "checkDepartDate";

        $values = $this->getTaintedValues();
        $value = $values['checkin_date'];

        //check depart_date is a valid date
        $arDateReturn = explode('-', $value);
        //print_r($arDateReturn);
        //var_dump(checkdate($arDateReturn[0], $arDateReturn[1], $arDateReturn[2]));

        if (!@checkdate($arDateReturn[1], $arDateReturn[2], $arDateReturn[0])) {
            throw new sfValidatorError($validator, 'Checkin date is invalid');
        }

        if ($value < date('Y-m-d')) {
            throw new sfValidatorError($validator, 'Checkin date is invalid');
        }

        //throw new sfValidatorError($validator, 'Please enter a valid departure date.');
        //print_r($value);
        //break;
    }

    public function checkReturnDate($validator, $value) {


        $values = $this->getTaintedValues();
        $value = $values['checkout_date'];
        $arDateReturn = explode('-', $value);
        $departValue = $values['checkin_date'];

        //var_dump($departValue < $value);
        //var_dump($value);
        //break;

        if (!@checkdate($arDateReturn[1], $arDateReturn[2], $arDateReturn[0])) {
            throw new sfValidatorError($validator, 'Checkout date is invalid');
        }

        if ($value < date('Y-m-d')) {
            throw new sfValidatorError($validator, 'Checkout date is invalid');
        }

        if ($departValue > $value) {
            throw new sfValidatorError($validator, 'Checkout must be after Checkin');
        }

        /*




        //check depart_date is a valid date
        $arDateReturn = explode('-', $value);

        if (!@checkdate($arDateReturn[1], $arDateReturn[2], $arDateReturn[0])) {
            throw new sfValidatorError($validator, 'Checkout date is invalid');
        }

        if ($value < date('Y-m-d')) {
            throw new sfValidatorError($validator, 'Checkout date is invalid');
        }

        if ($departValue > $value) {
            throw new sfValidatorError($validator, 'Checkin date must be before than Checkout date');
        }
         *
         */
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {

        foreach ($taintedValues['newRooms'] as $key => $newPic) {
            if (!isset($this['newRooms'][$key])) {
                $this->addRoom($key);
            }
        }

        //var_dump($taintedValues);
        //break;

        if(array_key_exists('childrenAge', $taintedValues)){
            foreach ($taintedValues['childrenAge'] as $key => $newPic) {
                if (!isset($this['childrenAge'][$key])) {
                    $this->addChildrenAgeBindding($key);
                }
            }
        }



        parent::bind($taintedValues, $taintedFiles);
    }

    public function addRoom($num) {
        //$pic = new Picture();
        //$pic->setCard($this->getObject());
        $newRoom = new HotelRoomForm();

        //Embedding the new picture in the container
        $this->embeddedForms['newRooms']->embedForm($num, $newRoom);
        //Re-embedding the container
        $this->embedForm('newRooms', $this->embeddedForms['newRooms']);
    }

    public function addChildrenAgeBindding($num){
        $childAge = new ChildAgeForm();
        $this->embeddedForms['childrenAge']->embedForm($num,$childAge);
        $this->embedForm('childrenAge', $this->embeddedForms['childrenAge']);
    }

    public function addChildrenAge($roomNumber, $number){

        for($i=1;$i<=$number;$i++){
            $childAge = new ChildAgeForm();
            $this->embeddedForms['childrenAge']->embedForm($roomNumber.'_'.$i, $childAge);
        }
        $this->embedForm('childrenAge', $this->embeddedForms['childrenAge']);
    }

}

?>
