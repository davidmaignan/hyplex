<?php

/**
 * PromotionalBanner form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PromotionalBannerForm extends BasePromotionalBannerForm {

    public function configure() {

        unset($this['rank']);

        $this->setWidget('filename', new sfWidgetFormInputFile());
        $this->setValidator('filename', new sfValidatorFile(array(
                    'mime_types' => 'web_images',
                    'path' => sfConfig::get('sf_upload_dir') . '/images/promotional_banner',
                    'required' => ($this->isNew())?true:false,
                )));

        $this->setWidget('filename', new sfWidgetFormInputFileEditable(array(
                    'file_src' => '/uploads/images/promotional_banner/' . $this->getObject()->filename,
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


        $languages = sfConfig::get('app_languages_available');
        $this->embedI18n($languages);

    }

}
