<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of myValidateFile
 *
 * @author david
 */
class myValidatedFile extends sfValidatedFile
{

  /**
   * Generates a non-random-filename
   *
   * @return string A non-random name to represent the current file
   */
  public function generateFilename()
  {
    $filename = $this->getOriginalName();

    $ext = $this->getExtension($this->getOriginalExtension());
    $name = substr($this->getOriginalName(), 0, - strlen($ext));
    $i = 1;
    while(file_exists($this->getPath() . '/' .  $filename)) {
      $filename = $name . '-' . $i . $ext;
      $i++;
    }
    return $filename;
  }


  


}

?>
