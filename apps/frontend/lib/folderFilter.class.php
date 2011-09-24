<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of folderFilter
 *
 * Check if cookie folder exists to retreive previous searches
 * Check if cookie culture exist
 * Check if sf_culture is in url
 *
 * @author david
 */
class folderFilter extends sfFilter {

    public function execute($filterChain) {
        

        $log = $this->getContext()->getLogger();
        $request = $this->getContext()->getRequest();
        $response = $this->getContext()->getResponse();
        $user = $this->getContext()->getUser();
        $controller = $this->getContext()->getController();
        $cookie = $request->getCookie('hypertech_user_folder');
        $cookieCulture = $request->getCookie('hypertech_culture');

        $cultures = sfConfig::get('app_languages_available');

        sfContext::getInstance()->getLogger()->alert("cookieCulture: ".$cookieCulture);

        $cookieDuration = sfConfig::get('app_cookie_duration');

        //If cookie culture is not en_US, fr_FR, zh_CN ->delete it
        if(!in_array($cookieCulture, $cultures)){       
            $response->setcookie('hypertech_culture', null, time()-3600);
            $cookieCulture = null;
        }

        if ($this->isFirstCall()) {

            if ($cookie) {

                $log->warning('folder Filter has detected the cookie');

                //Check if folder with the cookie value still exists.
                $folder = sfConfig::get('sf_cache_dir').'/'.$cookie;

                if(is_dir($folder))
                {
                    $log->warning('folder exists and cookie too. PERFECT');
                    $user->setAttribute('folder', $cookie);
                    sfConfig::set('sf_user_folder', $folder );
                    //Utils::retreivePrevSearch($user);
                    

                }else{
                    $log->alert('folder Filter has detected the cookie but the folder does not exist anymore');
                    $response->setcookie('hypertech_user_folder', null, time()-3600);
                    $log->warning('folder Filter has deleted the cookie');
                    sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent($this, 'user.cache_folder'));

                }
                
            }else{
                $log->alert('folderFilter: cookie does not exists. What can I do now.');
                sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent($this, 'user.cache_folder'));
            }
        }

        //check if sf_culture is on
        //Special case for sfForm language action
        //if (!$request->getParameter('sf_culture') && $request->getParameter('module') != 'language') {

        if (!$request->getParameter('sf_culture') && $request->getParameter('module') != 'language') {

            $log->alert('no culture in url');

            if ($user->isFirstRequest()) {

                if($cookieCulture){
                    $culture = $cookieCulture;
                }else{
                    $culture = $request->getPreferredCulture($cultures);
                }
 
                $user->setCulture($culture);
                
            } else {
                $culture = $user->getCulture();
            }

            $controller->redirect('localized_homepage');
        }

        //Load basket from file or create a new one
        $basketFile = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'basket';
        if(file_exists($basketFile)){
            $basketContent = file_get_contents($basketFile);
            $plexBasket = unserialize($basketContent);
            if($plexBasket === false){
                $plexBasket = PlexBasket::getInstance();
            }
            $plexBasket->setInstance($plexBasket);

        }else{
            $plexBasket = PlexBasket::getInstance();
        }


        //If first request - move all the previous saved items to an historic state / array
        if($user->isFirstRequest()){
            $user->isFirstRequest(false);
            $plexBasket->setAllItemsToHistoric();
            //Retreive the previous searches saved in the request file in the sf_user_folder
            //Utils::retreivePrevSearch($user);
        }
        
        // Execute the next filter
        $filterChain->execute();


        //Create the cookie if doesn't exist.
        if(is_null($cookie))
        {
            $name = $user->getAttribute('folder');
            $response->setcookie('hypertech_user_folder', $name, time()+$cookieDuration);
            $log->warning('folderFilter create the cookie');
        }

        if(is_null($cookieCulture) || $cookieCulture != $user->getCulture())
        {
            $response->setcookie('hypertech_culture', $user->getCulture(), time()+$cookieDuration);
        }
    }

}

?>
