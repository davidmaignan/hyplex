<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of creditCardValidator
 *
 * @author david
 */
class creditCardValidator extends sfValidatorDate {
    //put your code here


    protected function  configure($options = array(), $messages = array()) {

        parent::configure($options, $messages);

        $this->addOption('month');
        $this->addOption('year');

        $this->addMessage('month', 'Select a month for the expiration date.');
        $this->addMessage('year', 'Select a year for the expiration date.');

    }

    public function  doClean($value) {

        if ($value['year'] == '' &&  $value['month'] == '')
        {
          throw new sfValidatorError($this, 'required ', array('value' => $value));
        }

        if ($value['year'] == '' ||  $value['month'] == '')
        {
          throw new sfValidatorError($this, 'invalid ', array('value' => $value));
        }


        if(!in_array((int)$value['month'], $this->getOption('month')))
        {
            throw new sfValidatorError($this, 'month', array('value' => $value));
            
        }
        
        if(!in_array((int)$value['year'], $this->getOption('year')))
        {
            throw new sfValidatorError($this, 'year', array('value' => $value));
        }

        

    }
}
?>
