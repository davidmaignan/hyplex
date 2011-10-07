<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of passwordConfirmValidator
 *
 * @author david
 */
class passwordConfirmValidator extends sfValidatorString{
    //put your code here


    public function  doClean($value) {

        

        ob_start();
        var_dump($value);
        parent::doClean($value);
    }


}

