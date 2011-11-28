<?php

/**
 * PromotionalBannerTranslation form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PromotionalBannerTranslationForm extends BasePromotionalBannerTranslationForm
{
  public function configure()
  {
      $this->widgetSchema['message'] = new sfWidgetFormTextareaTinyMCE(array(
                    'width' => 550,
                    'height' => 250,
                    'config' => 'theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect"',
                ));

      /*
      $this->widgetSchema['message'] = new sfWidgetFormTextareaTinyMCE(array(
                    'width' => 550,
                    'height' => 250,
                    'theme'=>'advanced',
                    'config' => '',
                    'skin' => "o2k7",
                ));
       * 
       */

      $this->widgetSchema['message'] = new sfWidgetFormTextareaTinyMCE(array(
                    'width' => 550,
                    'height' => 250,
                    'theme'=>'advanced'
                ));


  }
}
