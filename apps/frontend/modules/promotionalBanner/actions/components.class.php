<?php

/**
 * promotionalBanner actions.
 *
 * @package    hypertech_booking
 * @subpackage promotionalBanner
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class promotionalBannerComponents extends sfComponents
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      //$promotionalBanners = Doctrine::getTable('PromotionalBanner')->getActivePromotions($this->getUser()->getCulture());
      //$this->promotionalBanners = json_encode($promotionalBanners);

      
      //sfView::NONE;
  }
}
