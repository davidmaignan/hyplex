<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AttachementsValidatorSchema
 *
 * @author david
 */
class AttachementsValidatorSchema extends sfValidatorSchema {
    //put your code here

  protected function configure($options = array(), $messages = array())
  {
    $this->addMessage('caption', 'The caption is required.');
    $this->addMessage('filename', 'The filename is required.');
  }

  protected function doClean($values)
  {

    $errorSchema = new sfValidatorErrorSchema($this);

    foreach($values as $key => $value)
    {
      $errorSchemaLocal = new sfValidatorErrorSchema($this);


      if($key == 'pms_attachements'){

          foreach ($value  as $k=>$v) {
              if(!$v['filename'] && $v['filename_delete'] != 'on' ){
                  unset($values[$key][$k]);
              }
          }

      }

      // some error for this embedded-form
      if (count($errorSchemaLocal))
      {
        $errorSchema->addError($errorSchemaLocal, (string) $key);
      }
    }

    if(empty($values['pms_attachements'])){
        unset($values['pms_attachements']);
    }

    // throws the error for the main form
    if (count($errorSchema))
    {
      throw new sfValidatorErrorSchema($this, $errorSchema);
    }

    return $values;
  }

}
?>
