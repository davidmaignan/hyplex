<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SearchPackageForm
 *
 * @author david
 */
class SearchPackageForm extends sfForm {


    protected static $arTime;
    protected static $arCabin= array('Economy'=>'Economy', 'Business'=>'Business class','First'=>'First class');
    protected static $arAdults = array(1 => '1', '2', '3', '4', '5', '6');
    protected static $arChildren = array('0', '1', '2', '3', '4', '5', '6');

    public function  configure() {

        self::$arTime = Utils::generateTimeArray();

        $this->setWidget('origin', new sfWidgetFormInputText(array(), array('class' => 'span-6')));
        $this->setWidget('destination', new sfWidgetFormInputText(array(), array('class' => 'span-6')));
        $this->setWidget('depart_date', new sfWidgetFormInputText(array(), array('class' => 'span-3')));
        $this->setWidget('return_date', new sfWidgetFormInputText(array(), array('class' => 'span-3')));
        $this->setWidget('depart_time', new sfWidgetFormChoice(array(
            'choices' => self::$arTime,'default'=>8), array(
                'class' => 'span-3 medium')
        ));
        $this->setWidget('return_time', new sfWidgetFormChoice(array(
            'choices' => self::$arTime,'default'=>8), array(
                'class' => 'span-3 medium')
        ));
        $this->setWidget('cabin', new sfWidgetFormSelect(array(
                'choices' => self::$arCabin,
                'default' => 0), array('class' => 'span-4 medium')
        ));
        $this->setWidget('prefer_nonstop',new sfWidgetFormSelectCheckbox(array('choices' => array('Non-stops only')), array()));
        $this->setWidget('type',new sfWidgetFormInputHidden(array(), array('value' => 'package')));

        $this->widgetSchema->setLabels(array(
            'origin' => 'Leaving from',
            'destination' => 'Going to',
            'depart_date' => 'Departing',
            'return_date' => 'Returning',
            'prefer_nonstop' => 'Nonstops only',
            'number_adults' => 'Adults',
            'number_children' => 'Children',
            'depart_time' => 'Time (depart)',
            'return_time' => 'Time (return)',
            'airline'=>'Prefered airlines'
        ));

        //Embed forms
        $subForm = new sfForm();
        for ($i = 1; $i < 2; $i++) {
            $form = new HotelRoomForm();
            $subForm->embedForm($i, $form);
        }

        $this->embedForm('newRooms', $subForm);

        $newSubForm = new sfForm();
        $this->embedForm('childrenAge', $newSubForm);


        //Validator

        $this->setValidator('origin', new sfValidatorString(array(), array()));
        $this->setValidator('destination', new sfValidatorString(array(), array()));

        $this->setValidator('depart_date', new sfValidatorAnd(array(
                new sfValidatorDate(array(
                    'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
                    'date_output' => 'Y-m-d',
                    'date_format_range_error' => 'Y-m-d'), array(
                    'bad_format' => 'Departure date %value% does not match the format (yyyy-mm-dd)')),
                new sfValidatorCallback(array('callback' => array($this, 'checkDepartDate')))
                    ), array(
                'required' => true,
                    ), array(
                'required' => 'Please enter a departure date',
        )));

        $this->setValidator('return_date', new sfValidatorAnd(array(
                new sfValidatorDate(array(
                    'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
                    'date_output' => 'Y-m-d',
                    'date_format_range_error' => 'Y-m-d'), array(
                    'required' => 'Please enter a departure date',
                    'bad_format' => 'Return date %value% does not match the format (yyyy-mm-dd)')),
                new sfValidatorCallback(array('callback' => array($this, 'checkReturnDate')))
                    ), array(
                'required' => true,
                    ), array(
                'required' => 'Please enter a return date'
        )));

        $this->setValidator('depart_time', new sfValidatorChoice(array(
                'choices' => array_keys(self::$arTime)), array()));

        $this->setValidator('return_time', new sfValidatorChoice(array(
                'choices' => array_keys(self::$arTime)), array()));

        $this->setValidator('cabin', new sfValidatorChoice(array(
                'choices' => array_keys(self::$arCabin)), array()));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('contact_form');
        $this->widgetSchema->setNameFormat('search_package[%s]');

    }


    public function checkDepartDate($validator, $value) {

        $values = $this->getTaintedValues();
        $value = $values['depart_date'];

        //check depart_date is a valid date
        $arDateReturn = explode('-', $value);
        
        if (!@checkdate($arDateReturn[1], $arDateReturn[2], $arDateReturn[0])) {
            throw new sfValidatorError($validator, 'Departure date is invalid');
        }

        if ($value < date('Y-m-d')) {
            throw new sfValidatorError($validator, 'Departure date is invalid');
        }

    }

     public function checkReturnDate($validator, $value) {

        $values = $this->getTaintedValues();
        $value = $values['return_date'];
        $departValue = $values['depart_date'];

        //check depart_date is a valid date
        $arDateReturn = explode('-', $value);

        if (!@checkdate($arDateReturn[1], $arDateReturn[2], $arDateReturn[0])) {
            throw new sfValidatorError($validator, 'Return date is invalid');
        }

        if ($value < date('Y-m-d')) {
            throw new sfValidatorError($validator, 'Return date is invalid');
        }

        if ($departValue > $value) {
            throw new sfValidatorError($validator, 'Departure date must be before than Return date');
        }
    }


    
    public function bind(array $taintedValues = null, array $taintedFiles = null) {

        foreach ($taintedValues['newRooms'] as $key => $newPic) {
            if (!isset($this['newRooms'][$key])) {
                $this->addRoom($key);
            }
        }

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
