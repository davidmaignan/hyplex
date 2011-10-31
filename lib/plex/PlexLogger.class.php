<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexLogger
 *
 * @author david
 */
class PlexLogger {
    //put your code here

    static public function logResponse(sfEvent $event)
    {
        
        $object = $event['this'];

        //Datas to save
        $userInfos = $object->retreiveUserInfos();
        $filename = $object->filename;
        $parameters = PlexParsing::retreiveParameters($filename);
        $folder = sfConfig::get('sf_user_folder');
        $folder = explode('/', $folder);
        $folder = end($folder);

        $times = sfTimerManager::getTimers();
       
        try {
            Doctrine::getConnectionByTableName('sfErrorLog');
            
            $requestPlex = new RequestPlex();
            $requestPlex->setDate(date('Y-m-d H:i:s'));
            $requestPlex->setType($object->type);
            $requestPlex->setUserCulture(sfContext::getInstance()->getUser()->getCulture());
            $requestPlex->setUserIp($userInfos['ip']);
            $requestPlex->setUserAgent($userInfos['userAgent']);
            $requestPlex->setSearchInfos(serialize($parameters));
            $requestPlex->setUserFolder($folder);
            $requestPlex->setFilename($filename);
            $requestPlex->setResponseCode($object->responseCode);
            $requestPlex->setElapsedTime($times);
            $requestPlex->save();

        }  catch (Doctrine_Exception $e){
            //echo 'Error doctrine';
        }

       
    }

}
?>
