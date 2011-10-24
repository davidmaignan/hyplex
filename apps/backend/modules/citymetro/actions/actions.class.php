<?php

require_once dirname(__FILE__).'/../lib/citymetroGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/citymetroGeneratorHelper.class.php';

/**
 * citymetro actions.
 *
 * @package    hypertech_booking
 * @subpackage citymetro
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class citymetroActions extends autoCitymetroActions
{
    public function executeIndex(sfWebRequest $request)
    {


        $this->cityMetros = Doctrine::getTable('city_metro')->findAll();


    }
}
