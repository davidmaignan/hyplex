<?php

/**
 * TopDestination form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TopDestinationForm extends BaseTopDestinationForm
{
  public function configure()
  {

      $languages = sfConfig::get('app_languages_available');
      $this->embedI18n($languages);

      unset($this['rank']);

      $this->setWidget('filename', new sfWidgetFormInputFile());
        $this->setValidator('filename', new sfValidatorFile(array(
                    'mime_types' => 'web_images',
                    'path' => sfConfig::get('sf_upload_dir') . '/images/top_destination',
                    'required' => ($this->isNew())?true:false,
                )));

        $this->setWidget('filename', new sfWidgetFormInputFileEditable(array(
                    'file_src' => '/uploads/images/top_destination/' . $this->getObject()->filename,
                    'edit_mode' => !$this->isNew(),
                    'is_image' => true,
                    'with_delete' => false,
                )));

        $this->widgetSchema['start_at'] = new sfWidgetFormJQueryDate(array(
          'config' => '{}',
        ));
        $this->widgetSchema['expires_at'] = new sfWidgetFormJQueryDate(array(
          'config' => '{}',
        ));

        
        

  }
}
