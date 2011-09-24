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
class SearchFlightEditForm extends SearchFlightForm {
    //put your code here

 

  

  public function configure()
  {

      self::$arTime = self::generateTimeArray();

      $this->setWidgets(array(
          'oneway'=> new sfWidgetFormSelectRadio(array(
              'choices'=>  self::$arOneWay,
              'default'=>0
          ), array('class'=>'inline')),
          'origin' => new sfWidgetFormInputHidden(array(), array(
              'class'=>'',
              'autocomplete'=>'off',
              'autocapitalize'=>'off',
              'autocorrect'=>'off'
              )),
          'destination'=> new sfWidgetFormInputHidden(array(), array(
              'class'=>'',
              'autocomplete'=>'off',
              'autocapitalize'=>'off',
              'autocorrect'=>'off'
              )),
          'depart_date'=> new sfWidgetFormInputText(array(), array('class'=>'medium')),
          'depart_time'=> new sfWidgetFormChoice(array('choices' => self::$arTime),array('class'=>'medium')),
          'return_date'=> new sfWidgetFormInputText(array(), array('class'=>'medium')),
          'return_time'=> new sfWidgetFormChoice(array('choices' => self::$arTime),array('class'=>'medium')),
          'cabin'=> new sfWidgetFormSelect(array(
                                        'choices'=>self::$arCabin,
                                        'default'=>0), array('class'=>'medium')),
          'number_adults'=> new sfWidgetFormChoice(array(
                                        'choices'=>  self::$arAdults,
                                        'default'=>0), array('class'=>'medium hidden')),
          'number_children' => new sfWidgetFormChoice(array(
                                        'choices'=> self::$arChildren,
                                        'default'=> 0),array('class'=>'medium hidden')),
          'flexible_date'=>new sfWidgetFormSelectCheckbox(array('choices'=>array('My dates are flexible')), array()),
          'prefer_nonstop'=> new sfWidgetFormSelectCheckbox(array('choices'=>array('Non-stops only')), array()),
          'type'=> new sfWidgetFormInputHidden(array(), array('value'=>'flightReturn'))
      ));

      $this->widgetSchema->setNameFormat('search_flight[%s]');

      $this->widgetSchema->setLabels(array(
          'origin'=>'From',
          'destination' =>'To',
          'depart_date'=>'Depart',
          'return_date'=>'Return',
          'prefer_nonstop'=>'Nonstops only',
          'number_adults'=>'Adults',
          'number_children'=>'Children',
          'depart_time'=>'Time',
          'return_time'=>'Time'
      ));

      $this->validatorSchema->setOption('allow_extra_fields', true);
      
      $this->setValidators(array(
          'oneway'=> new sfValidatorChoice(array(
                    'choices'=> array_keys(self::$arOneWay)), array(
                    'required'=>'Choose one type of ticket')),
          'origin'=> new sfValidatorString(array(
                    'required'=> true), array(
                    'required'=>'Unrecognized From airport, please check and re-enter. ')),
          'destination' => new sfValidatorString(array(
                    'required'=> true), array(
                    'required'=>'Unrecognized To airport, please check and re-enter. ')),
          //'depart_date' => new sfValidatorDate(array(
          //          'date_format'=>'/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',
          //          'date_output'=>'m/d/Y'), array(
          //          'required'=>'Please enter a departure date',
          //         'bad_format'=>'Departure date %value% does not match the format (mm/dd/yyyy).')),
          'depart_time' => new sfValidatorChoice(array(
                    'choices' => array_keys(self::$arTime)), array()),
          //'return_date' => new sfValidatorDate(array(
          //          'date_format'=>'/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',
          //          'date_output'=>'m/d/Y'), array(
          //          'required'=>'Please enter a return date',
          //          'bad_format'=>'Return date %value% does not match the format (mm/dd/yyyy).')),
          'return_time' => new sfValidatorChoice(array(
                    'choices' => array_keys(self::$arTime)), array()),
          'cabin' => new sfValidatorChoice(array(
                    'choices'=>array_keys(self::$arCabin)), array()),
          'number_adults' => new sfValidatorChoice(array(
                    'choices'=>array_keys(self::$arAdults)), array()),
          'number_children' => new sfValidatorChoice(array(
                    'choices'=>array_keys(self::$arChildren)), array())
      ));

      
      $this->validatorSchema['depart_date'] = new sfValidatorAnd(array(
        new sfValidatorString(array('required' => true)),
        new sfValidatorCallback(array(
                    'callback'=>array(
                        $this, 'checkDepartDate')
                )),
      ),array(),array(
          'required'=>'Please enter a departure date'
      ));

      $this->validatorSchema['return_date'] = new sfValidatorAnd(array(
        new sfValidatorString(array('required' => true)),
        new sfValidatorCallback(array(
                    'callback'=>array(
                        $this, 'checkReturnDate')
                )),
      ),array(),array(
          'required'=>'Please enter a return date'
      ));
      
      $this->validatorSchema->setOption('allow_extra_fields', true);

      $this->disableCSRFProtection();
      //$this->disableLocalCSRFProtection();

  }

}
?>
