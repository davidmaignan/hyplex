<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HotelRoomForm
 *
 * @author david
 */
class HotelRoomForm extends sfForm {

    //put your code here

    protected static $arAdults = array();
    protected static $arChildren = array('0', '1', '2', '3', '4', '5', '6');

    public function configure() {

        self::$arAdults = array_combine(range(1, sfConfig::get('app_hotel_numberAdults')), range(1, sfConfig::get('app_hotel_numberAdults')));

        $this->setWidgets(array(
            'number_adults'=> new sfWidgetFormChoice(array(
                'choices'=> self::$arAdults), array('class'=>'medium ')),
            'number_children'=> new sfWidgetFormChoice(array(
                'choices'=>range(0,sfConfig::get('app_hotel_numberChildren'))), array('class'=>'medium'))
        ));


        $this->widgetSchema->setLabels(array(
            'number_adults' => 'Adults',
            'number_children' => 'Children (0-17)',
        ));


        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('contact_form');

        $this->validatorSchema->setOption('allow_extra_fields', true);

        $this->disableLocalCSRFProtection();
        

    }

}

?>
