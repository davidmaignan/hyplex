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

        $this->validatorSchema->setPostValidator( new sfValidatorCallback(array('callback'=>
            array($this,'checkChildrenAges')), array()));

    }

    public function checkChildrenAges(){

        sfProjectConfiguration::getActive()->loadHelpers(array('Number', 'I18N', 'Url', 'Asset', 'Tag'));

        //Values submitted
        $values = $this->getTaintedValues();
        $validator = $this->getValidatorSchema();

        if(!isset($values['children'])){
            return true;
        }

        //Retreive all info from Basket
        $plexBasket = PlexBasket::getInstance();
        $childrenAges = $plexBasket->getChildrenAges();

        //Calculate age of the kids
        $childrenAgesForm = array('flight'=>array('children'=>0,'infants'=>0),'hotel'=>array(),'ages'=>array());

        foreach($values['children'] as $child){

            if($child['dob'] == ''){
                return true;
            }

            if(!empty($childrenAges['flight'])){

               $returnDate = $childrenAges['flight']['returnDate'];
               $childAge = Utils::getAge($child['dob'],$returnDate);

               array_push($childrenAgesForm['ages'],$childAge);
               
               if($childAge <2){
                   $childrenAgesForm['flight']['infants'] += 1;
               }else if($childAge >=2 && $childAge <12){
                   $childrenAgesForm['flight']['children'] += 1;
               }   
            }

            if(!empty($childrenAges['hotel'])){
                $returnDate = $childrenAges['hotel']['checkin'];
                $childAge = Utils::getAge($child['dob'],$returnDate);
                array_push($childrenAgesForm['hotel'], $childAge);
            }

        }
       
        if($childrenAges['flight']['age'] != $childrenAgesForm['flight'] && !empty($childrenAges['flight'])){

            //Expected
            $expected = '';

            $expected .=  format_number_choice(
                    '[0]|[1]child between 2 and 12|(1,+Inf]%1% children between 2 and 12',
                    array('%1%' =>$childrenAges['flight']['age']['children']),
                    $childrenAges['flight']['age']['children']
            );

            $expected .=  format_number_choice(
                    '[0]|[1]infant under 2|(1,+Inf]%1% infants under 2',
                    array('%1%' =>$childrenAges['flight']['age']['infants']),
                    $childrenAges['flight']['age']['infants']
            );

            $given = '';
            foreach($childrenAgesForm['ages'] as $key=>$age){
                $given .= $age;
                if($key < count($childrenAgesForm['ages'])-2){
                    $given .= ', ';
                }else if($key < count($childrenAgesForm['ages'])-1){
                    $given .= ' and ';
                }
            }

            $given2 = format_number_choice(
                    '[0]|[1]child aged %2%|(1,+Inf]%1% children aged %2%',
                    array('%1%' =>count($childrenAgesForm['ages']), '%2%' => $given),
                    count($childrenAgesForm['ages'])
            );
            


            throw new sfValidatorError($validator, "Error with children date of birth.<br/> 
                    This flight is priced for $expected at the time of travel but you entered $given2");
        }

        //$childrenAgesValues = $childrenAges['hotel']['age'];
        //sort($childrenAgesValues);
        //sort($childrenAgesForm['hotel']);

        //var_dump($childrenAges['hotel']['age']);
        //var_dump($childrenAgesForm['hotel']);
        //print_r($childrenAges);

        sort($childrenAges['hotel']['age']);
        sort($childrenAgesForm['hotel']);

        if($childrenAges['hotel']['age'] != $childrenAgesForm['hotel'] && !empty($childrenAges['hotel']['age'])){
             $hotelGiven = '';
            foreach($childrenAgesForm['hotel'] as $key=>$v){
                $hotelGiven .= $v;
                if($key < count($childrenAgesForm['hotel'])-2){
                    $hotelGiven .= ', ';
                }else if($key < count($childrenAgesForm['hotel'])-1){
                    $hotelGiven .= ' and ';
                }
            }

            $hotelExpected = '';
            foreach($childrenAges['hotel']['age'] as $key=>$w){
                $hotelExpected .= $w;
                if($key < count($childrenAges['hotel']['age'])-2){
                    $hotelExpected .= ', ';
                }else if($key < count($childrenAges['hotel']['age'])-1){
                    $hotelExpected .= ' and ';
                }
            }

            

            throw new sfValidatorError($validator, "Error with children date of birth.<br/> Hotel was priced for
                children ages $hotelExpected at the time of travel but you entered ages $hotelGiven");
        }
        

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

