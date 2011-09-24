<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testForm
 *
 * @author david
 */
class MultiFlightForm extends sfForm {
    //put your code here

    public function configure()
    {
        //$this->setWidget('name', new sfWidgetFormInputText(array(), array()));

        $this->setWidgets(array(
            'origin' => new sfWidgetFormInputText(array(), array(
                'class' => 'span-5 last autocomplete',
                'autocomplete' => 'off',
                'autocapitalize' => 'off',
                'autocorrect' => 'off'
            )),
            'destination' => new sfWidgetFormInputText(array(), array(
                'class' => 'span-5 last autocomplete',
                'autocomplete' => 'off',
                'autocapitalize' => 'off',
                'autocorrect' => 'off',
            )),
            'depart_date' => new sfWidgetFormInputText(array(), array('class' => 'span-3 datepicker')),
        ));

        $this->widgetSchema->setLabels(array(
            'origin' => 'Leaving from',
            'destination' => 'Going to',
            'depart_date' => 'Departing',
            'return_date' => 'Returning',
            'prefer_nonstop' => 'Nonstops only',
            'number_adults' => 'Adults',
            'number_children' => 'Children',
            'depart_time' => 'Time (depart)',
            'return_time' => 'Time (return)'
        ));

        $this->setValidators(array(
            'origin' => new sfValidatorString(array(
                'required' => true), array(
                'required' => 'Unrecognized From airport, please check and re-enter')),
            'destination' => new sfValidatorString(array(
                'required' => true), array(
                'required' => 'Unrecognized To airport, please check and re-enter')),
            'depart_date' => new sfValidatorDate(array(
                    'date_format' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
                    'date_output' => 'Y-m-d',
                    'date_format_range_error' => 'Y-m-d'), array(
                    'bad_format' => 'Departure date %value% does not match the format (yyyy-mm-dd)'))
        ));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('contact_form');
    }

}
?>
