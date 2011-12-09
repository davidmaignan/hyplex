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
class SearchFlightForm extends sfForm {

    protected $valOneway;
    //put your code here
    public static $arOneWay = array('Round-trip', 'One-way');
    public static $arTime;
    protected static $arCabin= array('Economy'=>'Economy', 'Business'=>'Business class','First'=>'First class');
    protected static $arAdults = array(1 => '1', '2', '3', '4', '5', '6');
    protected static $arChildren = array('0', '1', '2', '3', '4', '5', '6');
    protected static $arChildrenAge = array('0' => 'Select age',
        'Infant (in lap)' => array('0_lap' => '0 year (lap)', '1_lap' => '1 year (lap)'),
        'Child' => array('2_child' => '2 years',
            '3_child' => '3 years', '4_child' => '4 years', '5_child' => '5 years',
            '6_child' => '6 years', '7_child' => '7 years', '8_child' => '8 years',
            '9_child' => '9 years', '10_child' => '10 years', '11_child' => '11 years',
            '12_child' => '12 years'));

    public static function generateTimeArray() {

        $result = array();
        $tmp = range(1, 23);
        $ar_keys = array('a', 'r', 'm', 'n', 'e', 'l');
        $ar_keys = array_merge($ar_keys, $tmp);

        $ar_values = array('Anytime', 'Early (4a-8a)', 'Morning (8a-12p', 'Afternoon (12p-5p)', 'Evening (5p-9p)', 'Night (9p-12p)');
        $tmp = range(1, 11);

        foreach ($tmp as $value) {
            array_push($ar_values, $value . ':00 am');
        }

        array_push($ar_values, 'Noon');
        foreach ($tmp as $value) {
            array_push($ar_values, $value . ':00 pm');
        }

        $result = array_combine($ar_keys, $ar_values);
        return $result;
    }

    public function configure() {

        //use_helper('I18n');

        //sfProjectConfiguration::getActive()->loadHelpers(array('I18n'));

        //self::$arTime = self::generateTimeArray();
        self::$arTime = Utils::generateTimeArray();

        $this->setWidgets(array(
            'oneway' => new sfWidgetFormSelectRadio(array(
                'choices' => self::$arOneWay,
                'default' => 0
                    ), array('class' => 'inline')),
            'origin' => new sfWidgetFormInputText(array(), array(
                'class' => 'span-6 last',
                'autocomplete' => 'off',
                'autocapitalize' => 'off',
                'autocorrect' => 'off'
            )),
            'destination' => new sfWidgetFormInputText(array(), array(
                'class' => 'span-6 last',
                'autocomplete' => 'off',
                'autocapitalize' => 'off',
                'autocorrect' => 'off'
            )),
            'depart_date' => new sfWidgetFormInputText(array(), array('class' => 'span-3')),
            'depart_time' => new sfWidgetFormChoice(array('choices' => self::$arTime,'default'=>8), array('class' => 'span-3 medium')),
            'return_date' => new sfWidgetFormInputText(array(), array('class' => 'span-3')),
            'return_time' => new sfWidgetFormChoice(array('choices' => self::$arTime,'default'=>8), array('class' => 'span-3 medium')),
            'cabin' => new sfWidgetFormSelect(array(
                'choices' => self::$arCabin,
                'default' => 0), array('class' => 'span-4 medium')),
            'number_adults' => new sfWidgetFormChoice(array(
                'choices' => self::$arAdults,
                'default' => 0), array('class' => 'span-2 medium')),
            'number_children' => new sfWidgetFormChoice(array(
                'choices' => self::$arChildren,
                'default' => 0), array('class' => 'span-2 medium child_number')),
            'flexible_date' => new sfWidgetFormSelectCheckbox(array('choices' => array('My dates are flexible')), array()),
            'prefer_nonstop' => new sfWidgetFormSelectCheckbox(array('choices' => array('Non-stops only')), array()),
            'type' => new sfWidgetFormInputHidden(array(), array('value' => 'flightReturn')),
            'airline' => new sfWidgetFormInputText(array(), array())
        ));


         $this->setWidget('number_adults', new sfWidgetFormSelect(array(
            'choices'=>  self::$arAdults
        ), array('class'=>'span-2 medium')));
        $this->setWidget('number_children', new sfWidgetFormSelect(array(
            'choices'=>range(0,6)
        ), array('class'=>'span-2 medium')));
         $this->setWidget('number_infants', new sfWidgetFormSelect(array(
            'choices'=>range(0,6)
        ), array('class'=>'span-2 medium')));


        $this->widgetSchema->setNameFormat('search_flight[%s]');

        /*
        for ($i = 1; $i <= 6; $i++) {
            $this->setWidget('child_' . $i,
                    new sfWidgetFormSelect(array(
                        'choices' => self::$arChildrenAge,
                        'default' => 0), array('class' => 'small-med')));
        }
        */
        

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

        $this->widgetSchema->setLabels(array(
            'number_adults' => 'Adults',
            'number_children' => 'Children (2-12)',
            'number_infants' => 'Infants (0-2)',
        ));


        if (!empty($_POST)) {
            //echo $_POST['search_flight']['oneway'];
            $this->valOneway = ($_POST['search_flight']['oneway'] == 0) ? true : false;
        } else {
            $this->valOneway = true;
        }

        //var_dump($this->valOneway);


        $this->setValidators(array(
            'oneway' => new sfValidatorChoice(array(
                'choices' => array_keys(self::$arOneWay)), array(
                'required' => 'Choose one type of ticket')),
            'origin' => new sfValidatorString(array(
                'required' => true), array(
                'required' => 'Unrecognized From airport, please check and re-enter')),
            'destination' => new sfValidatorString(array(
                'required' => true), array(
                'required' => 'Unrecognized To airport, please check and re-enter')),
            'depart_date' => new sfValidatorAnd(array(
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
            )),
            'depart_time' => new sfValidatorChoice(array(
                'choices' => array_keys(self::$arTime)), array()),
            'return_date' => new sfValidatorAnd(array(
                new sfValidatorDate(array(
                    'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
                    'date_output' => 'Y-m-d',
                    'date_format_range_error' => 'Y-m-d'), array(
                    'required' => 'Please enter a departure date',
                    'bad_format' => 'Return date %value% does not match the format (yyyy-mm-dd)')),
                new sfValidatorCallback(array('callback' => array($this, 'checkReturnDate')))
                    ), array(
                'required' => $this->valOneway,
                    ), array(
                'required' => 'Please enter a return date'
            )),
            'return_time' => new sfValidatorChoice(array(
                'choices' => array_keys(self::$arTime)), array()),
            'cabin' => new sfValidatorChoice(array(
                'choices' => array_keys(self::$arCabin)), array()),
            //'number_adults' => new sfValidatorChoice(array(
            //    'choices' => array_keys(self::$arAdults)), array()),
            //'number_children' => new sfValidatorChoice(array(
            //    'choices' => array_keys(self::$arChildren)), array())
        ));



        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('contact_form');

        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'checkChildInfant'))));
    }


    public function checkChildAge() {
        $validator = $this->getValidatorSchema();
        $values = $this->getTaintedValues();
        $nbChildren = $values['number_children'];

        for ($i = 1; $i <= $nbChildren; $i++) {
            if ($values['child_' . $i] == '0') {
                //$message .= "You must select an age for all the children.";
                throw new sfValidatorError($validator, "You must select an age for all the children");
            }
        }
    }
    /*
    public function checkChildInfant() {

        //echo 'checkChildInfant';

        $validator = $this->getValidatorSchema();
        $values = $this->getTaintedValues();
        //ob_start();
        //var_dump($values);

        $nbChildren = $values['number_children'];

        $message = '';
        $nbrInfantsLap = 0;

        for ($i = 1; $i <= $nbChildren; $i++) {

            if ($values['child_' . $i] == '0') {
                //$message .= "You must select an age for all the children.";
                throw new sfValidatorError($validator, "You must select an age for all the children");
            }

            if ($values['child_' . $i] == '0_lap' || $values['child_' . $i] == '1_lap') {
                $nbrInfantsLap++;
            }
        }

        if ($nbrInfantsLap > $values['number_adults']) {
            throw new sfValidatorError($validator, "The number of infants in lap can't exceed the number of adults");
            $message .= "The number of infants in lap can't exceed the number of adults";
        }

        //break;
    }
    */
    public function checkValidDates($validator, $value) {
        
    }

    public function checkDates() {

        $validator = $this->getValidatorSchema();
        $values = $this->getTaintedValues();

        $oneway = $values['oneway'];
        $departDate = $values['depart_date'];
        $returnDate = $values['return_date'];

        if (strtotime($departDate) > strtotime($returnDate) && $oneway == 0) {
            throw new sfValidatorError($validator, "Departure date must be before the return date");
        }
    }

    public function checkDepartDate($validator, $value) {
        //ob_start();
        //print($value);
        //echo "checkDepartDate";

        $values = $this->getTaintedValues();
        $value = $values['depart_date'];

        //check depart_date is a valid date
        $arDateReturn = explode('-', $value);
        //print_r($arDateReturn);
        //var_dump(checkdate($arDateReturn[0], $arDateReturn[1], $arDateReturn[2]));

        if (!@checkdate($arDateReturn[1], $arDateReturn[2], $arDateReturn[0])) {
            throw new sfValidatorError($validator, 'Departure date is invalid');
        }

        if ($value < date('Y-m-d')) {
            throw new sfValidatorError($validator, 'Departure date is invalid');
        }

        //throw new sfValidatorError($validator, 'Please enter a valid departure date.');
        //print_r($value);
        //break;
    }

    public function checkReturnDate($validator, $value) {


        if ($this->valOneway) {
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
    }

    public function checkChildInfant() {

        //echo 'checkChildInfant';

        $validator = $this->getValidatorSchema();
        $values = $this->getTaintedValues();
        //ob_start();
        //var_dump($values);

        $nbInfants = $values['number_infants'];


        if ($nbInfants > $values['number_adults']) {
            throw new sfValidatorError($validator, __("The number of infants can't exceed the number of adults"));
        }

        //break;
    }

}

?>
