<?php

/**
 * pms_attachement form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pms_attachementForm extends Basepms_attachementForm
{
  public function configure()
  {
      unset($this['pms_ticket_id']);

      $this->widgetSchema['filename'] = new sfWidgetFormInputFileEditable(array(
        'label' => 'Field Name',
        'file_src' => '/uploads/pms/attachements/'.$this->getObject()->getFilename(),
        //'is_image' => true,
        'edit_mode' => !$this->isNew(),
        'template' => '%file% %input% %delete% %delete_label%'
      ));

      $this->validatorSchema['filename'] = new sfValidatorFile(array(
        'required'   => false,
        //'mime_types' => 'web_images',
        'path'       => sfConfig::get('sf_upload_dir').'/pms/attachements',
        'validated_file_class' => 'myValidatedFile',
      ));

      // delete checkbox
      $this->validatorSchema['filename_delete'] = new sfValidatorPass();



      /*
      
      $this->setWidget('filename', new sfWidgetFormInputFile());
      $this->setValidator('filename', new sfValidatorFile(array(
          'mime_types' => 'web_images',
          'path' => sfConfig::get('sf_upload_dir').'/pms/attachements',
          'validated_file_class' => 'CustomValidatedFile',
          'required' => false,
      )));
      
      $this->setWidget('filename', new sfWidgetFormInputFile());
      $this->setValidator('filename', new sfValidatorFile(array(
          //'mime_types' => 'web_images',
          'path' => sfConfig::get('sf_upload_dir').'/pms/attachements',
          'required' => false,
      )));
       *
       * 
       */

      //Manage the display depending of the 
      /*
      $this->setWidget('filename', new sfWidgetFormInputFileEditable(array(
        'file_src'    => '/uploads/pms/attachements/'.$this->getObject()->filename,
        'edit_mode'   => !$this->isNew(),
        'is_image'    => true,
        'with_delete' => true,
        'template'  => '<table><tr>
                          <td><img width=200 src="/uploads/pms/attachements/'.$this->getObject()->filename.'" /></td>
                          <td>
                          Load a new picture: <br /><br />%input%<br /><br />
                          %delete%%delete_label%
                          </td>
                          </tr>
                          </table>'
      )));
      */

      
      
      //$this->widgetSchema['filename'] = new sfWidgetFormInputFile();
      $this->validatorSchema['filename_delete'] = new sfValidatorPass();
      //$this->validatorSchema->setOption('allow_extra_fields', true);

  }
  
  public function save($con = null) {

        return parent::save($con);
  }


  
  
}
