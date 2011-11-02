<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChildAgeForm
 *
 * @author david
 */
class ChildAgeForm extends sfForm {
    //put your code here

    static $arAges = array();
    //static $arAgesKeys = array();

    public static function generateAges(){
        $arAgesKeys = range(-1,17);
        $values = range(0,17);
        array_unshift($values , '-');
        return array_combine($arAgesKeys, $values);
    }

    public function configure()
    {
        
        //self::$arAges = self::generateAges();  

        $this->setWidget('age', new sfWidgetFormChoice(array('choices'=>self::generateAges()), array()));
        $this->setValidator('age', new sfValidatorChoice(array('choices'=>  range(0, 17)), array()));

        //$this->setWidget('test', new sfWidgetFormInputText(array() , array()));
        //$this->setValidator('test', new sfValidatorString(array(
        //    'required'=>true), array(
        //    'required'=>'You must provide a value to this field'
        //)));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('contact_form');

    }
}
?>
