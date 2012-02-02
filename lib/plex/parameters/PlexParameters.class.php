<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Parameters
 *
 *
 * @author david
 */
abstract class PlexParameters {
    //put your code here

    protected $culture;
    protected $type;

    public $problemWithCode = false;

    public function  __construct($type, $params, $culture) {
        if($type === NULL || $params === NULL){
            throw new Exception('You must provide a type and the parameters from the request');
        }

        $this->type = $type;
        $this->culture = $culture;

        foreach ($params as $key => $value) {
            $this->$key = $value;
        }
        
        

    }

    public function getParameters(){
        return get_object_vars($this);
    }

    public function  __toString() {
        //return serialize($this->getParameters());
    }

    public function getDepartDate() {
        return $this->depart_date;
    }

    public function getReturnDate() {
        return $this->return_date;
    }

    public function getCodes(){

        $ar = array();

        switch($this->type){

            case 'hotelSimple':
            array_push($ar, $this->wherebox);
            break;

            case 'flightReturn' || 'flightOneway':
            array_push($ar, $this->originCode);
            array_push($ar, $this->destinationCode);
            break;

        }

        return $ar;

    }

    public function getIcon(){

        $string = '';
        //echo $this->type;

        switch($this->type){
            case 'flightReturn':
                $string = 'flight';
                break;
            case 'flightOneway':
                $string = 'flight';
                break;

            case 'hotelSimple':
                $string = 'hotel';
                break;
            case 'car':
                $string = 'car';
                break;
            case 'package':
                $string = 'package';
                break;
            default:
                $string = $this->type;
                break;
        }

        //echo $string;

        return image_tag('mobico'.DIRECTORY_SEPARATOR.$string.'.gif', array('alt'=>$this->getTypeRenamed()));

    }

}

