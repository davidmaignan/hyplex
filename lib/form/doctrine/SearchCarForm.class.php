<?php

/**
 * Description of SearchCarForm
 *
 * @author david
 */
class SearchCarForm extends sfForm{

    protected $valDropOff;
    public static $arDropOff = array('Same Location', 'Different Location ');
    public static $arTime = array();
    
    public function  configure() {

        self::$arTime = Utils::generateTimeArray();

        $this->setWidget('drop_off', new sfWidgetFormSelectRadio(array(
                'choices' => self::$arDropOff,
                'default' => 0), array(
                'class' => 'inline')
        ));

        $this->setWidget('location1', new sfWidgetFormInputText(array(), array()));
        $this->setWidget('location2', new sfWidgetFormInputText(array(), array()));

        $this->setWidget('pickup_date', new sfWidgetFormInputText(array(), array('class'=>'span-3')));
        $this->setWidget('dropoff_date', new sfWidgetFormInputText(array(), array('class'=>'span-3')));

        $this->setWidget('pickup_hour', new sfWidgetFormChoice(array('choices' => self::$arTime,'default'=>12), array('class' => 'span-3 medium')));
        $this->setWidget('dropoff_hour', new sfWidgetFormChoice(array('choices' => self::$arTime,'default'=>12), array('class' => 'span-3 medium')));

        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => 'car')));
        
        $this->widgetSchema->setLabels(array(
            'location1' => 'From',
            'location2' => 'To',
            'pickup_date' => 'Pick up',
            'dropoff_date' => 'Drop off',
            'pickup_hour'=>'Time',
            'dropoff_hour'=>'Time'
        ));


        $this->setValidator('location1', new sfValidatorString(array(), array()));
        

        if (!empty($_POST)) {
            //echo $_POST['search_flight']['oneway'];
            $this->valDropOff = ($_POST['search_car']['drop_off'] == 0) ? false : true;
        } else {
            $this->valDropOff = false;
        }

        $this->setValidator('location2', new sfValidatorString(array('required'=>$this->valDropOff), array()));

        $this->setValidator('pickup_date', new sfValidatorAnd(array(
                new sfValidatorDate(array(
                    'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
                    'date_output' => 'Y-m-d',
                    'date_format_range_error' => 'Y-m-d'), array(
                    'bad_format' => 'Departure date %value% does not match the format (yyyy-mm-dd)')),
                new sfValidatorCallback(array('callback' => array($this, 'checkPickUpDate')))
                    ), array(
                'required' => true,
                    ), array(
                'required' => 'Please enter a pick up date',
        )));

         $this->setValidator('dropoff_date', new sfValidatorAnd(array(
                new sfValidatorDate(array(
                    'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
                    'date_output' => 'Y-m-d',
                    'date_format_range_error' => 'Y-m-d'), array(
                    'bad_format' => 'Departure date %value% does not match the format (yyyy-mm-dd)')),
                new sfValidatorCallback(array('callback' => array($this, 'checkDropOffDate')))
                    ), array(
                'required' => true,
                    ), array(
                'required' => 'Please enter a drop off date',
        )));

        $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('contact_form');
        $this->widgetSchema->setNameFormat('search_car[%s]');
        $this->validatorSchema->setOption('allow_extra_fields', true);




    }

     public function checkPickUpDate($validator, $value) {
        //ob_start();
        //print($value);
        //echo "checkDepartDate";

        $values = $this->getTaintedValues();
        $value = $values['pickup_date'];

        //check depart_date is a valid date
        $arDateReturn = explode('-', $value);
        //print_r($arDateReturn);
        //var_dump(checkdate($arDateReturn[0], $arDateReturn[1], $arDateReturn[2]));

        if (!@checkdate($arDateReturn[1], $arDateReturn[2], $arDateReturn[0])) {
            $error = new sfValidatorError($validator, 'Pick up date is invalid');
            throw new sfValidatorErrorSchema($validator, array('invalid' => $error));
        }

        if ($value < date('Y-m-d')) {
            $error = new sfValidatorError($validator, 'Pick up date is invalid');
            throw new sfValidatorErrorSchema($validator, array('invalid' => $error));
        }

        //throw new sfValidatorError($validator, 'Please enter a valid departure date.');
        //print_r($value);
        //break;
    }

    public function checkDropOffDate($validator, $value) {


        $values = $this->getTaintedValues();
        $value = $values['dropoff_date'];
        $departValue = $values['pickup_date'];

        //check depart_date is a valid date
        $arDateReturn = explode('-', $value);

        if (!@checkdate($arDateReturn[1], $arDateReturn[2], $arDateReturn[0])) {
            $error = new sfValidatorError($validator, 'Drop off date is invalid');
            throw new sfValidatorErrorSchema($validator, array('invalid' => $error));
            
        }

        if ($value < date('Y-m-d')) {
            $error = new sfValidatorError($validator, 'Drop off date is invalid');
            throw new sfValidatorErrorSchema($validator, array('invalid' => $error));
        }

        if ($departValue > $value) {
            $error = new sfValidatorError($validator, 'Drop off date must be after the pick up date');
            throw new sfValidatorErrorSchema($validator, array('invalid' => $error));
        }
        
    }



}

