<?php

require_once dirname(__FILE__).'/../lib/cityGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/cityGeneratorHelper.class.php';

/**
 * city actions.
 *
 * @package    hypertech_booking
 * @subpackage city
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cityActions extends autoCityActions
{

    public function executeCacheUncache(sfWebRequest $request)
    {
        $id = $this->getRequestParameter('id');

        //var_dump($id);

        //break;
        
        $q = Doctrine_Query::create()
          ->from('City a')
          ->where('a.id = ?', $id);

        foreach ($q->execute() as $city)
        {
          $city->cacheOrUncache();
        }

        $this->getUser()->setFlash('notice', 'The selected cities have been cached or uncached.');

        $this->redirect('city');

    }


    public function executeBatchCacheUncache(sfWebRequest $request)
      {
        $ids = $request->getParameter('ids');

        $q = Doctrine_Query::create()
          ->from('City j')
          ->whereIn('j.id', $ids);

        foreach ($q->execute() as $city)
        {
          $city->cacheOrUncache();
        }

        $this->getUser()->setFlash('notice', 'The selected cities have been cached or uncached.');
        $this->redirect('city');
      }


}
