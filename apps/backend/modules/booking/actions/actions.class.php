<?php

require_once dirname(__FILE__).'/../lib/bookingGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/bookingGeneratorHelper.class.php';

/**
 * booking actions.
 *
 * @package    hyplexdemo
 * @subpackage booking
 * @author     David Maignan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bookingActions extends autoBookingActions
{
	
	public function executeListByDates(sfWebRequest $request){
		
		$from = $request->getParameter('from', new DateTime());
		$to = $request->getParameter('to', new DateTime());
		
		$currentPage = 1;
		$resultsPerPage = 50;
		
		$test = Doctrine_Query::create()
					->from('Booking a')
					->leftJoin('a.sfGuardUser b')
					->orderBy('a.created_at DESC')
					->fetchArray();
					
		//var_dump($test);
		
		// Creating pager object
		$pager = new Doctrine_Pager(
		      Doctrine_Query::create()
					->from('Booking a')
					->leftJoin('a.sfGuardUser b')
					->orderBy('a.created_at DESC'),
		      $currentPage, // Current page of request
		      $resultsPerPage // (Optional) Number of results per page. Default is 25
		);
		
		$pager->execute();
		
		
		
		$this->pager = $pager;
		$this->sort = $this->getSort();
		
		
	}
		


}
