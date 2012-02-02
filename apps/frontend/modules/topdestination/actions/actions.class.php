<?php

/**
 * topdestination actions.
 *
 * @package    hypertech_booking
 * @subpackage topdestination
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class topdestinationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      
     $arTopDestination = array(1=>'Discover Australia', 'Romantic Paris','Historic Rome','Surfing Hawaii','Traditional Japan','Discover Easter');
     $arPrices = array_fill(1, count($arTopDestination)-1, rand(2587, 6790));
     
     
     $this->arDatas = array();
     
     foreach($arTopDestination as $key=>$destination){
         $tmp = array();
         $tmp['title'] = $destination;
         $tmp['price'] = rand(2587, 6790);
         $tmp['image'] = 'tmp/topDestination'.($key).'.jpg';
         $tmp['description'] = 'There\'s nothing like fall in New York City. The crisp autumn air, changing colors, romantic restaurants, nonstop nightlife, and all that shopping. Stay 3 or more nights and experience all that the Big Apple has to offer with these special rates. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
         
         $date = new DateTime();
         $x = rand(20, 150);
         $date->modify("+$x day");
         $tmp['date'] = $date;
         
         array_push($this->arDatas, $tmp);
     }
     
     
     
      //$request->setRequestFormat('xml');
  }
}
