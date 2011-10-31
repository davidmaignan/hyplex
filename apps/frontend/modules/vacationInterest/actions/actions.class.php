<?php

/**
 * vacationInterest actions.
 *
 * @package    hyplexdemo
 * @subpackage vacationInterest
 * @author     David Maignan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vacationInterestActions extends sfActions
{



  public function executeIndex(sfWebRequest $request){

      $this->arIcons = array(   'north-america'=>'North Amrica',
                                'europe'=>'Europe',
                                'asia'=>'Asia',
                                'africa'=>'Africa',
                                'oceania'=>'Oceania',
                                'caraibes'=>'Caraibes',
                                'surfing'=>'Surfing'
                                );

    $arMarkers = array(
          'latitude'=> -25.363882,
          'longitude'=> 131.044922,
          'zoom'=> 4,
          'markers'=>
          array(
              array(
                      'name'=>'Boat Rock, Yarrawonga/ Mulwala',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-35.987951',
                      'longitude'=>'146.006691',
                      'icon'=>'north-america',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Uluru-Kata Tjuta National Park',
                      'desc'=> 'After traversing South australia, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-25.359597',
                      'longitude'=>'130.99906',
                      'icon'=>'north-america',
                    'pic'=>'Cable_Beach_Broome.jpg'),
              array(
                      'name'=>'Kimberley, Western Australia',
                      'desc'=> 'Don\t miss an oppotunity with consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-19.952166',
                      'longitude'=>'125.915207',
                      'icon'=>'north-america',
                      'pic'=>'Staircase_to_the_Moon.jpg'),
              array(
                      'name'=>'The Daintree, Queensland ',
                      'desc'=> 'Feeling the breeze and consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-16.250225',
                      'longitude'=>'145.320542',
                      'icon'=>'north-america',
                      'pic'=>'Karijini_National_Park.jpg'),
              array(
                      'name'=>'Coorong, South Australia',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-35.998489',
                      'longitude'=>'139.548342',
                      'icon'=>'north-america',
                      'pic'=>'Gibb_River_Road.jpg'),
              array(
                      'name'=>'Gippsland, Victoria ',
                      'latitude'=>'-38.266702',
                      'desc'=> 'Leave your car and walk consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'longitude'=>'146.741207',
                      'icon'=>'europe',
                      'pic'=>'Bungle_Bungle_Range.jpg'),
              array(
                      'name'=>'Cellar Hop, Barossa, SA',
                      'desc'=> 'Taste a wild variety a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-34.533333',
                      'longitude'=>'138.95',
                      'icon'=>'europe',
                      'pic'=>'Perth.jpg'),
              array(
                      'name'=>'Wind Down, Swan Valley',
                      'desc'=> 'Red and white wines from a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-31.797046',
                      'longitude'=>'116.04881',
                      'icon'=>'europe',
                      'pic'=>'Kings_Park.jpg'),
              array(
                      'name'=>'Grapes Galore Yarra Valley,VIC',
                      'desc'=> 'Discover this new regions a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-37.656812',
                      'longitude'=>'145.447161',
                      'icon'=>'europe',
                      'pic'=>'Antony_Gormley_Statues.jpg'),
              array(
                      'name'=>'Hunter Valley',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-32.46035',
                      'longitude'=>'150.767922',
                       'icon'=>'europe',
                      'pic'=>'Monkey_Mia.jpg'),
              array(
                      'name'=>'Cool Climate Wines, Coal River, TAS',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-42.48029',
                      'longitude'=>'147.439145',
                      'icon'=>'europe',
                      'pic'=>'Ningaloo_Reef.jpg'),
              array(
                      'name'=>'Coonawarra',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-37.291274',
                      'longitude'=>'140.839002',
                      'icon'=>'europe',
                      'pic'=>'Whale_Sharks_Ningaloo_Reef.jpg'),
              array(
                      'name'=>'Clare Valley',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-33.92587',
                      'longitude'=>'138.879997',
                      'icon'=>'asia',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Flinders range',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-31.864675',
                      'longitude'=>'139.365315',
                      'icon'=>'asia',
                      'pic'=>'Kings_Park.jpg'),
              array(
                      'name'=>'Longreach',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-23.440657',
                      'longitude'=>'144.251056',
                      'icon'=>'asia',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Broken Hill',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-31.955858',
                      'longitude'=>'141.465136',
                      'icon'=>'asia',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Glen Helen Gorge',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-23.685892',
                      'longitude'=>'132.673133',
                      'icon'=>'asia',
                      'pic'=>'Gibb_River_Road.jpg'),
              array(
                      'name'=>'Kununurra',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-15.773546',
                      'longitude'=>'128.739196',
                      'icon'=>'asia',
                      'pic'=>'Wildflowers_Australias_Golden_Outback.jpg'),
              array(
                      'name'=>'Mildura',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-34.206301',
                      'longitude'=>'142.135832',
                      'icon'=>'asia',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Kakadu National parc',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-12.682814',
                      'longitude'=>'132.470054',
                      'icon'=>'oceania',
                      'pic'=>'South_West_Region.jpg'),
               array(
                      'name'=>'Tasman National park',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-43.176861',
                      'longitude'=>'147.937216',
                      'icon'=>'oceania',
                      'pic'=>'Monkey_Mia.jpg'),
               array(
                      'name'=>'Namadgi National Park',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-35.632207',
                      'longitude'=>'148.874787',
                      'icon'=>'oceania',
                      'pic'=>'Tree_Top_Walk.jpg'),
              array(
                      'name'=>'Litchfield National Park',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-13.039922',
                      'longitude'=>'130.924273',
                      'icon'=>'oceania',
                      'pic'=>'The_Pinnacles.jpg'),
              array(
                      'name'=>'Mungo National Park',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-33.727959',
                      'longitude'=>'143.153444',
                      'icon'=>'caraibes',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
               array(
                      'name'=>'Australian Alps',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-37.000348',
                      'longitude'=>'148.000023',
                      'icon'=>'caraibes',
                      'pic'=>'Staircase_to_the_Moon.jpg'),
               array(
                      'name'=>'Blue mountains',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-33.650655',
                      'longitude'=>'150.442832',
                      'icon'=>'caraibes',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Byron Bay',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-28.644162',
                      'longitude'=>'153.612379',
                      'icon'=>'caraibes',
                      'pic'=>'Lucky_Bay.jpg'),
              array(
                      'name'=>'Shipstern Bluff, Gold Cost',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-28.644162',
                      'longitude'=>'153.612379',
                      'icon'=>'caraibes',
                      'pic'=>'Antony_Gormley_Statues.jpg'),
              array(
                      'name'=>'Trigg Island',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-31.909133',
                      'longitude'=>'115.640403',
                      'icon'=>'caraibes',
                      'pic'=>'Ningaloo_Reef.jpg'),
              array(
                      'name'=>'Bells Beach',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-38.365318',
                      'longitude'=>'144.264772',
                      'icon'=>'caraibes',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),

              array(
                      'name'=>'Grampians National Park',
                      'desc'=>'Renowned for rugged mountain ranges and stunning wildflower displays,
                               Grampians National Park is one of the State\'s most popular holiday...',
                      'latitude'=>'-37.287896',
                      'longitude'=>'142.489191',
                      'icon'=>'south-america',
                      'pic'=>'Gibb_River_Road.jpg'),
              array(
                      'name'=>'Lorem Ipsum dolores',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-38.365318',
                      'longitude'=>'144.264772',
                      'icon'=>'africa',
                      'pic'=>'Cable_Beach_Broome.jpg'),
              array(
                      'name'=>'Lorem Ipsum dolores',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-38.365318',
                      'longitude'=>'144.264772',
                      'icon'=>'south-america',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Lorem Ipsum dolores',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-38.365318',
                      'longitude'=>'144.264772',
                      'icon'=>'south-america',
                      'pic'=>'Bungle_Bungle_Range.jpg'),
              array(
                      'name'=>'Bells Beach',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-38.365318',
                      'longitude'=>'144.264772',
                      'icon'=>'africa',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),

              array(
                      'name'=>'Grampians National Park',
                      'desc'=>'Renowned for rugged mountain ranges and stunning wildflower displays,
                               Grampians National Park is one of the State\'s most popular holiday...',
                      'latitude'=>'-37.287896',
                      'longitude'=>'142.489191',
                      'icon'=>'africa',
                      'pic'=>'Gibb_River_Road.jpg'),
              array(
                      'name'=>'Lorem Ipsum dolores',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-38.365318',
                      'longitude'=>'144.264772',
                      'icon'=>'africa',
                      'pic'=>'Cable_Beach_Broome.jpg'),
              array(
                      'name'=>'Lorem Ipsum dolores',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-38.365318',
                      'longitude'=>'144.264772',
                      'icon'=>'south-america',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Lorem Ipsum dolores',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-38.365318',
                      'longitude'=>'144.264772',
                      'icon'=>'africa',
                      'pic'=>'Bungle_Bungle_Range.jpg'),

          ));

      $this->mapMarkers = json_encode($arMarkers);

      $this->arIcons = array(   'aboriginal'=>'aboriginal site',
                                'hiking'=>'Outback hiking',
                                'vineyard'=>'Wine tasting',
                                'park'=>'National park',
                                'mountains'=>'Mountains',
                                'panoramicview'=>'Panoramic view',
                                'surfing'=>'Surfing'
                                );


      $datas = $arMarkers['markers'];

      $keys = array();
      foreach($datas as $value){
          array_push($keys , $value['icon']);
      }

      $keys = array_unique($keys);

      $this->keys = json_encode($keys);

      $values = array_fill(0, count($keys), array());

      $this->combined = array_combine($keys, $values);

      foreach($datas as $value){
          array_push($this->combined[$value['icon']] , $value);
      }

     
  }



 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeCountry(sfWebRequest $request)
  {
    //$this->forward('default', 'module');

      $arMarkers = array(
          'latitude'=> -25.363882,
          'longitude'=> 131.044922,
          'zoom'=> 4,
          'markers'=>
          array(
              array(
                      'name'=>'Boat Rock, Yarrawonga/ Mulwala',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-35.987951',
                      'longitude'=>'146.006691',
                      'icon'=>'aboriginal',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Uluru-Kata Tjuta National Park',
                      'desc'=> 'After traversing South australia, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-25.359597',
                      'longitude'=>'130.99906',
                      'icon'=>'aboriginal',
                    'pic'=>'Cable_Beach_Broome.jpg'),
              array(
                      'name'=>'Kimberley, Western Australia',
                      'desc'=> 'Don\t miss an oppotunity with consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-19.952166',
                      'longitude'=>'125.915207',
                      'icon'=>'aboriginal',
                      'pic'=>'Staircase_to_the_Moon.jpg'),
              array(
                      'name'=>'The Daintree, Queensland ',
                      'desc'=> 'Feeling the breeze and consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-16.250225',
                      'longitude'=>'145.320542',
                      'icon'=>'aboriginal',
                      'pic'=>'Karijini_National_Park.jpg'),
              array(
                      'name'=>'Coorong, South Australia',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-35.998489',
                      'longitude'=>'139.548342',
                      'icon'=>'aboriginal',
                      'pic'=>'Gibb_River_Road.jpg'),
              array(
                      'name'=>'Gippsland, Victoria ',
                      'latitude'=>'-38.266702',
                      'desc'=> 'Leave your car and walk consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'longitude'=>'146.741207',
                      'icon'=>'aboriginal',
                      'pic'=>'Bungle_Bungle_Range.jpg'),
              array(
                      'name'=>'Cellar Hop, Barossa, SA',
                      'desc'=> 'Taste a wild variety a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-34.533333',
                      'longitude'=>'138.95',
                      'icon'=>'vineyard',
                      'pic'=>'Perth.jpg'),
              array(
                      'name'=>'Wind Down, Swan Valley',
                      'desc'=> 'Red and white wines from a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-31.797046',
                      'longitude'=>'116.04881',
                      'icon'=>'vineyard',
                      'pic'=>'Kings_Park.jpg'),
              array(
                      'name'=>'Grapes Galore Yarra Valley,VIC',
                      'desc'=> 'Discover this new regions a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-37.656812',
                      'longitude'=>'145.447161',
                      'icon'=>'vineyard',
                      'pic'=>'Antony_Gormley_Statues.jpg'),
              array(
                      'name'=>'Hunter Valley',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-32.46035',
                      'longitude'=>'150.767922',
                       'icon'=>'vineyard',
                      'pic'=>'Monkey_Mia.jpg'),
              array(
                      'name'=>'Cool Climate Wines, Coal River, TAS',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-42.48029',
                      'longitude'=>'147.439145',
                      'icon'=>'vineyard',
                      'pic'=>'Ningaloo_Reef.jpg'),
              array(
                      'name'=>'Coonawarra',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-37.291274',
                      'longitude'=>'140.839002',
                      'icon'=>'vineyard',
                      'pic'=>'Whale_Sharks_Ningaloo_Reef.jpg'),
              array(
                      'name'=>'Clare Valley',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-33.92587',
                      'longitude'=>'138.879997',
                      'icon'=>'vineyard',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Flinders range',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-31.864675',
                      'longitude'=>'139.365315',
                      'icon'=>'panoramicview',
                      'pic'=>'Kings_Park.jpg'),
              array(
                      'name'=>'Longreach',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-23.440657',
                      'longitude'=>'144.251056',
                      'icon'=>'hiking',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Broken Hill',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-31.955858',
                      'longitude'=>'141.465136',
                      'icon'=>'hiking',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Glen Helen Gorge',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-23.685892',
                      'longitude'=>'132.673133',
                      'icon'=>'hiking',
                      'pic'=>'Gibb_River_Road.jpg'),
              array(
                      'name'=>'Kununurra',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-15.773546',
                      'longitude'=>'128.739196',
                      'icon'=>'hiking',
                      'pic'=>'Wildflowers_Australias_Golden_Outback.jpg'),
              array(
                      'name'=>'Mildura',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-34.206301',
                      'longitude'=>'142.135832',
                      'icon'=>'hiking',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Kakadu National parc',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-12.682814',
                      'longitude'=>'132.470054',
                      'icon'=>'park',
                      'pic'=>'South_West_Region.jpg'),
               array(
                      'name'=>'Tasman National park',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-43.176861',
                      'longitude'=>'147.937216',
                      'icon'=>'park',
                      'pic'=>'Monkey_Mia.jpg'),
               array(
                      'name'=>'Namadgi National Park',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-35.632207',
                      'longitude'=>'148.874787',
                      'icon'=>'park',
                      'pic'=>'Tree_Top_Walk.jpg'),
              array(
                      'name'=>'Litchfield National Park',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-13.039922',
                      'longitude'=>'130.924273',
                      'icon'=>'park',
                      'pic'=>'The_Pinnacles.jpg'),
              array(
                      'name'=>'Mungo National Park',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-33.727959',
                      'longitude'=>'143.153444',
                      'icon'=>'park',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
               array(
                      'name'=>'Australian Alps',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-37.000348',
                      'longitude'=>'148.000023',
                      'icon'=>'mountains',
                      'pic'=>'Staircase_to_the_Moon.jpg'),
               array(
                      'name'=>'Blue mountains',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-33.650655',
                      'longitude'=>'150.442832',
                      'icon'=>'mountains',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'Byron Bay',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-28.644162',
                      'longitude'=>'153.612379',
                      'icon'=>'surfing',
                      'pic'=>'Lucky_Bay.jpg'),
              array(
                      'name'=>'Shipstern Bluff, Gold Cost',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-28.644162',
                      'longitude'=>'153.612379',
                      'icon'=>'surfing',
                      'pic'=>'Antony_Gormley_Statues.jpg'),
              array(
                      'name'=>'Trigg Island',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-31.909133',
                      'longitude'=>'115.640403',
                      'icon'=>'surfing',
                      'pic'=>'Ningaloo_Reef.jpg'),
              array(
                      'name'=>'Bells Beach',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-38.365318',
                      'longitude'=>'144.264772',
                      'icon'=>'surfing',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),

              array(
                      'name'=>'Grampians National Park',
                      'desc'=>'Renowned for rugged mountain ranges and stunning wildflower displays,
                               Grampians National Park is one of the State\'s most popular holiday...',
                      'latitude'=>'-37.287896',
                      'longitude'=>'142.489191',
                      'icon'=>'panoramicview',
                      'pic'=>'Gibb_River_Road.jpg'),
              array(
                      'name'=>'',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-38.365318',
                      'longitude'=>'144.264772',
                      'icon'=>'panoramicview',
                      'pic'=>'Cable_Beach_Broome.jpg'),
              array(
                      'name'=>'',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-38.365318',
                      'longitude'=>'144.264772',
                      'icon'=>'surfing',
                      'pic'=>'Gyorn_Gyorn_Paintings.jpg'),
              array(
                      'name'=>'',
                      'desc'=> 'Discover a treasure consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. ',
                      'latitude'=>'-38.365318',
                      'longitude'=>'144.264772',
                      'icon'=>'surfing',
                      'pic'=>'Bungle_Bungle_Range.jpg')

          ));

      $this->mapMarkers = json_encode($arMarkers);

      $this->arIcons = array(   'aboriginal'=>'aboriginal site',
                                'hiking'=>'Outback hiking',
                                'vineyard'=>'Wine tasting',
                                'park'=>'National park',
                                'mountains'=>'Mountains',
                                'panoramicview'=>'Panoramic view',
                                'surfing'=>'Surfing'
                                );


      $datas = $arMarkers['markers'];

      $keys = array();
      foreach($datas as $value){
          array_push($keys , $value['icon']);
      }

      $keys = array_unique($keys);

      $this->keys = json_encode($keys);

      $values = array_fill(0, count($keys), array());

      $this->combined = array_combine($keys, $values);

      foreach($datas as $value){
          array_push($this->combined[$value['icon']] , $value);
      }
      
      
      $newsRSS = new PlexRSSFeeder('http://feeds.feedburner.com/TheAustralianTheNationNews');
      $this->news = $newsRSS->getArItems();



      $weatherUrl = "http://api.wunderground.com/api/d07da430e5c514d2/forecast7day/q/Australia/Sydney.json";
      $weatherRequest = file_get_contents($weatherUrl);

      $weather = json_decode($weatherRequest);

      //var_dump($weather);

      //echo $weatherRequest;

      $file = sfConfig::get('sf_cache_dir').'/weather.plex';
      //echo $file;
      //file_put_contents($file, serialize($weather));
      //exit;
      
  }
}
