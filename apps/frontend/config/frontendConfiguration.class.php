<?php

class frontendConfiguration extends sfApplicationConfiguration {

    public function configure() {
        $this->dispatcher->connect('request.filter_parameters', array($this, 'filterRequestParameters'));
        $this->dispatcher->connect('user.cache_folder', array('myUser', 'createFolder'));
        //$this->dispatcher->connect('user.new_request',array('myUser','addNewRequest'));
        //$this->dispatcher->connect('request.filter_parameters', array($this, 'filterRequestParameters'));
        $this->dispatcher->connect('plex.airline_array', array('Utils', 'createAirlineArray'));
        $this->dispatcher->connect('php.throw_error', array('sfErrorLogger','phpError'));
        $this->dispatcher->connect('plex.responsexml_error', array('sfErrorLogger','plexError'));
        $this->dispatcher->connect('plex.response_success', array('PlexLogger','logResponse'));
        $this->dispatcher->connect('user.create_account', array('myUser','createAccount'));

        sfConfig::set('plex_ipm', 2);
       
        sfConfig::set('totalPerPage', 10);
    }

    public function filterRequestParameters(sfEvent $event, $parameters) {
        $request = $event->getSubject();

        if (preg_match('#iPhone.+Mobile/.+Safari#i', $request->getHttpHeader('User-Agent'))) {
            $request->setRequestFormat('iphone');
        } else if (preg_match('#iPad.+Mobile/.+Safari#i', $request->getHttpHeader('User-Agent'))) {
            $request->setRequestFormat('ipad');
        }
        
        //$request->setRequestFormat('ipad');
        
        return $parameters;
    }

    public function configureIPhoneFormat(sfEvent $event) {

        if ('iphone' == $event['format']) {
            
        }
    }

}
