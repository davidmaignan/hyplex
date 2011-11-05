<?php


class cookieFilter extends sfFilter{


    public function execute($filterChain){

        //Get Request
        $request = $this->getContext()->getRequest();
        $user = $this->getContext()->getUser();
        $controller = $this->getContext()->getController();        

        $culture = $request->getParameter('sf_culture');
        $cultures = sfConfig::get('app_languages_available');

        //Get cookieCulture
        $cookieCulture = $request->getCookie('hypertech_culture');        

        //ob_start();
        //var_dump($culture);
        //var_dump($cookieCulture);
        //var_dump($user->getCulture());
        //var_dump($cookieDuration);

        //Check if sf_culture is in the url parameter
        if (!$request->getParameter('sf_culture') || !in_array($request->getParameter('sf_culture'), $cultures)){
            
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
        
        // Execute the next filter
        $filterChain->execute();

        if(is_null($cookieCulture) || $cookieCulture != $user->getCulture())
        {
            $cookieDuration = sfConfig::get('app_cookie_duration');
            $response = $this->getContext()->getResponse();
            $response->setcookie('hypertech_culture', $user->getCulture(), time()+$cookieDuration);
        }
        
    }




}