<?php

class myUser extends sfGuardSecurityUser
{
    
    public function  initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array()) {

        parent::initialize($dispatcher, $storage, $options);

        //sfContext::getInstance()->getLogger()->alert('User class');
        //$this->dispatcher->notify(new sfEvent($this, 'user.cache_folder'));

        //First request - create attribute to keep the searches
    }
   

    public function isFirstRequest($boolean = null)
    {
      if (is_null($boolean))
      {
        //$this->setAttribute('sTId', null);
        //$this->setAttribute('sTId_time', null);
        //$this->setAttribute('prevSearch', array());
        return $this->getAttribute('first_request', true);
      }
      else
      {
        $this->setAttribute('first_request', $boolean);
      }
    }

    static public function createFolder(sfEvent $event)
    {

        $user = sfContext::getInstance()->getUser();

        $log = sfContext::getInstance()->getLogger();
        $log->warning('Event listened to createFolder');

        if(!$user->hasAttribute('folder'))
        {
            $name = uniqid();
            $user->setAttribute('folder', $name);
            $message = "Creating a folder in cache for this user with name: $name";
            $log ->alert($message);

            $cacheDir = sfConfig::get('sf_cache_dir');
            $folder = $cacheDir.DIRECTORY_SEPARATOR.$name;

            if(!is_dir($folder))
            {
                mkdir($folder , 0777, true);
                $log ->alert('Folder created');
            }else{
                //$log ->alert('Folder already created');
            }

            sfConfig::set('sf_user_folder', $folder);
            
            
        }else{

            $folder = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.$user->getAttribute('folder');

            if(is_dir($folder))
            {
                $message = "Folder exist in cache for this user with name: ".$user->getAttribute('folder');
                //$log->alert($message);
                sfConfig::set('sf_user_folder', $folder);
            }else{
                $message = "Folder does not exist and it's going to be a problem";
                $log->alert($message);
                mkdir($folder , 0777, true);
                $log ->alert('Folder re-created');
            }
       }
         
       if(sfConfig::has('sf_user_folder'))
       {
           $log->debug('sfConfig has the parameter sf_user_folder: '.sfConfig::get('sf_user_folder'));

       }  else {
           $log->alert('If this message display. Big problem. cause sfConfig does not have the param sf_user_folder');
       }


    }

    static public function test(sfEvent $event)
    {
        var_dump('test user');
        break;
    }

    public function hasCredential($credential, $useAnd = true) {
        // combine the credential and the permission check
        return (parent::hasCredential($credential, $useAnd) || parent::hasPermission($credential));
    }

    public function getCSRFToken($class){
        $secret = sfConfig::get('sf_csrf_secret');
        $csrf_token = md5($secret.session_id().get_class($class));
        return $csrf_token;
    }


    public function getLastFilename(){
    	
    	$request = sfContext::getInstance()->getRequest();
    	
    	$module = $request->getParameter('module');
    	$action = $request->getParameter('action');
    	
    	//if($action == 'selected' || $action == 'flightResult'){
    		$prevSearch = $this->getAttribute('prevSearch');

        	$filename =  is_array($prevSearch)? end($prevSearch):null;
		
        	return $filename['filename'];
        	
    	//}
    		
    	return null;

    }
    
    /**
     * Return filename for historic filter purpose
     * return a value after a search or a item added to basket
     */
    public function getFilename(){
    	
    	$request = sfContext::getInstance()->getRequest();
    	
    	$module = $request->getParameter('module');
    	$action = $request->getParameter('action');
    	
    	var_dump($module, $action);
    	
    	
    	if($action == 'selected'){
    		
    		$filename = $this->getLastFilename();
    		  		
    	}
    	
    	return  $filename['filename'];
    	exit;
    }


    public function addBookingId($bookingId){

        $prevBooking = $this->setAttribute('prevBooking', $bookingId);

        return true;

        if(is_null($prevBooking)){

            $prevBooking = array($bookingId);
            $this->setAttribute('prevBooking', $prevBooking);

        }else if(is_array($prevBooking)){
            array_push($prevBooking , $bookingId);
            $this->setAttribute('prevBooking', $prevBooking);

        }else{
            throw new Exception('An error has occured in sfUser addBooking function. Cannot recognize attribute prevBooking.');
        }
    }

    public function getLastBookingId(){

        $prevBooking = $this->getAttribute('prevBooking');

        return $prevBooking;

        if(is_array($prevBooking)){
            return end($prevBooking);
        }else{
            throw new Exception('An error has occured in sfUser getLastBookingId. Cannot recognize attribute prevBooking.');
        }

    }
    
    
    public function createAccount(sfEvent $event){
        
        
        $booking = $event['booking'];
        
        $email = $booking->getEmail();
        $password = $booking->getPassword();
        

        try{
            $user = new sfGuardUser();
            $user->setEmailAddress($email);
            $user->setUsername($email);
            $user->setPassword($password);
            $user->save();
            
            //Need to login the user. 
            sfContext::getInstance()->getUser()->signin($user, false);
            
           
            
        }catch (Doctrine_Exception $e){

            

        }
        
        
    }
    
    public function getId(){
        
        if($this->isAuthenticated()){
        
            $username = sfContext::getInstance()->getUser()->getGuardUser()->getUsername();
            $user = Doctrine::getTable('sfGuardUser')->findOneBy('username', $username);
            return $user->getId();
            
        }else{
            
            return null;
            
        }
        
    }

}
 