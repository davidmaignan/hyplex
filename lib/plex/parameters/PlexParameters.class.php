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
    

}
?>
