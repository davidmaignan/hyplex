<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test2Form
 *
 * @author david
 */
class MultiFlightCollectionForm extends sfForm {

    //put your code here
     protected static $arAdults = array(1 => '1', '2', '3', '4', '5', '6');
     protected static $arCabin= array('Economy'=>'Economy', 'Business'=>'Business class','First'=>'First class');
     public static $arOneWay = array('Round-trip', 'One-way','Open-Jaw');


    public function configure() {

        $subForm = new sfForm();
        for ($i = 0; $i < 2; $i++) {
            //$productPhoto = new ProductPhoto();
            //$productPhoto->Product = $this->getObject();

            $form = new MultiFlightForm();

            $subForm->embedForm($i, $form);
        }
        $this->embedForm('newSegments', $subForm);

        $this->setWidget('oneway' , new sfWidgetFormSelectRadio(array(
                'choices' => self::$arOneWay,
                'default' => 0
                    ), array('class' => 'inline')));

        $this->setWidget('number_adults', new sfWidgetFormSelect(array(
            'choices'=>  self::$arAdults
        ), array('class'=>'span-2 medium')));
        $this->setWidget('number_children', new sfWidgetFormSelect(array(
            'choices'=>range(0,6)
        ), array('class'=>'span-2 medium')));
         $this->setWidget('number_infants', new sfWidgetFormSelect(array(
            'choices'=>range(0,6)
        ), array('class'=>'span-2 medium')));

         $this->setWidget('cabin' , new sfWidgetFormSelect(array(
                'choices' => self::$arCabin,
                'default' => 0), array('class' => 'span-3 medium')));
        $this->setWidget('prefer_nonstop' , new sfWidgetFormSelectCheckbox(
                array('choices' => array('Non-stops only')), array()));
        $this->setWidget('type' , new sfWidgetFormInputHidden(array(), array('value' => 'flightMultiDestination')));

        $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('contact_form');
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->setNameFormat('search_flight[%s]');


        $this->widgetSchema->setLabels(array(
            'number_adults' => 'Adults',
            'number_children' => 'Children (2-12)',
            'number_infants' => 'Infants (0-2)',
        ));


    }

    public function saveEmbeddedForms($con = null, $forms = null) {

        if (null === $forms) {
            //$photos = $this->getValue('newPhotos');
            $forms = $this->embeddedForms;
            foreach ($this->embeddedForms['newSegments'] as $name => $form) {
                if (!isset($photos[$name])) {
                    unset($forms['newSegments'][$name]);
                }
            }
        }

        return parent::saveEmbeddedForms($con, $forms);
    }

    public function addPicture($num) {
        //$pic = new Picture();
        //$pic->setCard($this->getObject());
        $test_form = new MultiFlightForm();

        //Embedding the new picture in the container
        $this->embeddedForms['newSegments']->embedForm($num, $test_form);
        //Re-embedding the container
        $this->embedForm('newSegments', $this->embeddedForms['newSegments']);
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {

       
        foreach ($taintedValues['newSegments'] as $key => $newPic) {
            if (!isset($this['newSegments'][$key])) {
                $this->addPicture($key);
            }
        }
        parent::bind($taintedValues, $taintedFiles);
    }

}

?>
