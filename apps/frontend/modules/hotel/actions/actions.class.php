<?php

/**
 * hotel actions.
 *
 * @package    hypertech_booking
 * @subpackage hotel
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class hotelActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }

  public function executeHotelResult(sfWebRequest $request)
  {
      $prevSearches = $this->getUser()->getAttribute('prevSearch');
        //var_dump($prevSearches);

      $prevSearche = $prevSearches[count($prevSearches) - 1];
      $filename = $prevSearche['file'];

      $this->page = 1;

      //Retrieve the search parameters.
      $this->parameters = Utils::retreiveParameters($filename);

      //Generate the form for modifying the search
      $this->form = new SearchHotelForm($this->parameters->getParametersArray($this->getUser()->getCulture()));

      //Create Filter object
      $filteredResponse = PlexFilterResponseFactory::factory(
                        $this->parameters->getType(), $filename, $this->page, array()
      );

      $this->filterResponse = $filteredResponse;
      $this->results = $filteredResponse->filteredObjs;

      //Get the FilterForm and values to set the filters
      $this->filterFormFinal = $filteredResponse->displayFilterForm();
      
      $this->filterValues = $filteredResponse->getDatasForFilterForm();
      //unset($this->filterValues['starRating']);
      //unset($this->filterValues['chain']);
      //unset($this->filterValues['location']);
      unset($this->filterValues['isOurPick']);

      $this->filterValues = json_encode($this->filterValues);
      
      //Google map
      $fileMarkers = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.$filename.'.markers';

      if(file_exists($fileMarkers)){

          $content = file_get_contents($fileMarkers);
          $arGmap = unserialize($content);
         
          //Add info hotel - starRating, desc, minprice, number rates, pic, filtered or not
          foreach($this->filterResponse->arObjs as $result){


              if(array_key_exists($result->id, $arGmap['hotels'])){
                 
                  $arGmap['hotels'][$result->id]['starRating'] = $result->starRating;
                  //$arGmap['hotels'][$result->id]['description'] = $result->description;
                  $arGmap['hotels'][$result->id]['slug'] = Utils::slugify($result->name);
                  $arGmap['hotels'][$result->id]['numberRates'] = $result->getNumberRates();
                  $arGmap['hotels'][$result->id]['minPrice'] = $result->minPrice;
                  $arGmap['hotels'][$result->id]['image'] = $result->getImageFullPath();
                  $arGmap['hotels'][$result->id]['location'] = str_replace(' ', '_', $result->location);
                  $arGmap['hotels'][$result->id]['chain'] = str_replace(' ','_',$result->chain);


              }else{

                  //fire an event to save in db missing hotel in marker files.
                  

              }

          }



      }else{
            //fire an event the marker file is missing
      }

      $this->gMapHotels = json_encode($arGmap);


      



  }

  public function executeNotFound($request) {
        if ($request->getRequestFormat() == 'iphone') {
            $this->setLayout('layout');
        }


        $this->parameters = $this->getUser()->getFlash('parameters');
    }

    public function executeFilterHotel(sfWebRequest $request){

        $this->parameters = $request->getPostParameters();

        $this->page = $request->getPostParameter('page');

        //var_dump($this->parameters);
        

        //Which link or checkbox is clicked will determine which checkbox to disabled
        $class = $request->getPostParameter('class');
        
        //var_dump($class);

        $type = $request->getPostParameter('type');
        $filename = $request->getPostParameter('filename');
        $filteredResponse = PlexFilterResponseFactory::factory(
                        $type, $filename, $this->page, $this->parameters
        );

        $this->filterResponse = $filteredResponse;

        $this->results = $filteredResponse->filteredObjs;

        $this->type = $request->getPostParameter('type');

        //sfConfig::set('sf_escaping_strategy', false);

        //$this->filterToDeactivate = $this->filterResponse->arFilterToDeactivate;

        //Remove in the array the fields which should not be applied to disabled the checkbox in the filter form
        switch (true) {

            case(preg_match('#(star)#i', $class) >0):
                 //unset($this->filterToDeactivate['starRating']);
                 $this->filterToDeactivate = $filteredResponse->createArFilterToDeactivate('starRating');
                 break;

            case(preg_match('#(location)#i', $class) >0):
                 $this->filterToDeactivate = $filteredResponse->createArFilterToDeactivate('location');
                 //unset($this->filterToDeactivate['location']);
                 break;

            case(preg_match('#(chain)#i', $class) >0):
                 //unset($this->filterToDeactivate['chain']);
                 $this->filterToDeactivate = $filteredResponse->createArFilterToDeactivate('chain');
                 break;

            case(preg_match('#(slider)|(price)#i', $class) >0):
                 
                 //unset($this->filterToDeactivate['chain']);
                 $this->filterToDeactivate = $filteredResponse->createArFilterToDeactivate('slider');
                 break;

        }

        //break;
        $this->filterToDeactivateJson = json_encode($this->filterToDeactivate);


        $this->markerFiltered = json_encode($filteredResponse->filteredObjGmap);
        //If debug
        //$this->setTemplate('debugAjaxCall');
        

    }

    public function executeHotelDetail(sfWebRequest $request){

        $debug = false;

        $slug = $request->getParameter('slug');

        $prevSearches = $this->getUser()->getAttribute('prevSearch');
        $prevSearche = $prevSearches[count($prevSearches) - 1];

        $filename = $prevSearche['file'];

        $this->parameters = Utils::retreiveParameters($filename);

        $file = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.$filename.'.plex';
        
        $handle = fopen($file , 'r');
        while(!feof($handle)){

            $content = fgets($handle);
            if(strpos($content , '---') === false){
                $hotel = unserialize($content);
                if(Utils::slugify($hotel->name) == $slug){
                    $this->hotel = $hotel;
                    break;    
                }
            }
        }

        //Hotel detail file name path
        $hotelDetailFile = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.$filename.DIRECTORY_SEPARATOR.$hotel->id.'.raw';

        if(!file_exists($hotelDetailFile)){            

            //Hotel detail request
            $plexRequest = new PlexHotelDetailsRequest($hotel, $filename, $this->getUser());
            $plexRequest->buildXML();
            $response = $plexRequest->executeRequest();


            $finalResponse = new PlexHotelDetailsResponse($hotel, $response, $request, $filename);
            $finalResponse->checkResponseCode();
            $code = $finalResponse->responseCode;

            switch ($code) {

                case '0':
                      $finalResponse->parseResponse();
                      break;

                default:
                      $this->getUser()->setFlash('parameters', $parameters);
                      $datas = array();
                      $datas['type'] = $this->type;
                      $datas['infosUser'] = Utils::retreiveUserInfos($request);
                      $datas['header'] = Utils::getHeader($finalResponse->filename);
                      $datas['code']= 3;
                      $datas['userFolder'] = sfConfig::get('sf_user_folder');
                      $datas['filename'] = $finalResponse->filename;
                      $datas['params'] = $paramFactory;

                      //Save info in db
                      $event = new sfEvent($this, 'plex.response_success', array('datas' => $datas));
                      sfContext::getInstance()->getEventDispatcher()->notify($event);

                      //$this->redirect('hotel/notFound');
                      $this->forward('error', 'SessionExpired');
                      break;

                }

                $this->hotel = $finalResponse->getHotel();
                //Rewrite the file to get the hotel object with the data received from the plex request.
                $content = file_get_contents($file);
                $newContent = '';

                while ($join = strpos($content, '---')) {

                    $hotel = unserialize(trim(substr($content, 0, $join)));

                    $hotel = unserialize($content);
                    if(Utils::slugify($hotel->name) == $slug){
                         $newContent .= serialize($this->hotel)  . "\r\n --- " . "\r\n";
                    }else{
                         $obj = (trim(substr($content, 0, $join)));
                         $newContent .= $obj . "\r\n --- " . "\r\n";
                    }

                    $content = trim(substr($content, $join + 3));

                }

                file_put_contents($file, $newContent);

        }
        


        $this->hotelCoordinates = json_encode($this->hotel->arCoordinates);
        $this->slugName = Utils::slugify($this->hotel->getName());
        
    }


    public function executeCompare(sfWebRequest $request){

        $parameters = $request->getParameter('hotels');

        $parameters = str_replace('hotel-thumb-', '', $parameters);


        $hotels = split(',', $parameters);

        unset($hotels[count($hotels)-1]);

        $this->arHotels = array();


        $prevSearches = $this->getUser()->getAttribute('prevSearch');
        $prevSearche = $prevSearches[count($prevSearches) - 1];

        $filename = $prevSearche['file'];

        $file = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.$filename.'.plex';

        $handle = fopen($file , 'r');
        while(!feof($handle)){

            $content = fgets($handle);
            if(strpos($content , '---') === false){

                //var_dump($content);

                if($content !== false){
                    $hotel = unserialize($content);
                }

                
                if(in_array($hotel->id,$hotels)){
                    array_push($this->arHotels, $hotel);
                }
            }
        }
        fclose($handle);

        //return $this->renderText($hotels);


    }

    
}
