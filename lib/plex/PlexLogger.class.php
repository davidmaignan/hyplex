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
        /*
        $datas = array();
        $datas['type'] = $this->type;
        $datas['infosUser'] = $this->infoUser;
        $datas['header'] = $this->header;
        $datas['code']= $this->responseCode;
        $datas['userFolder'] = $this->getFilename();
         * 
         */
        $datas = $event['datas'];
        $type = $datas['type'];

        //print_r($datas);
        //break;
        /*
        if($datas['code'] == 0){
            $times = sfTimerManager::getTimers();
            $time_plex = $times['PlexRequest']->getElapsedTime();
            $totalTime = 0;
            $t = $times['PlexResponse'];
            $totalTime += $t->getElapsedTime();
            $t = $times['ParseResponse'];
            $totalTime += $t->getElapsedTime();
            $t = $times['AnalyseResponse'];
            $totalTime += $t->getElapsedTime();
        }else{
            $times = sfTimerManager::getTimers();
            $time_plex = $times['PlexRequest']->getElapsedTime();
            $totalTime = 0;
        }
        */

       
        //var_dump($datas);

        $tmp = explode('/', sfConfig::get('sf_user_folder'));


        $folder = $tmp[count($tmp)-1];

        switch($type){
            case 'hotelSimple':
                $filename = sfConfig::get('sf_user_folder').'/hotel/'.$datas['filename'].'.raw';
                break;
            default:
                $filename = sfConfig::get('sf_user_folder').'/'.$datas['filename'].'.raw';
                break;
        }
        //echo $filename;
        //var_dump(file_exists($filename));

        //$filename = $datas['filename'];

        //var_dump(file_exists($datas['userFolder']));
        if(file_exists($filename)){
            $content_raw = file_get_contents($filename);
        }else{
            $content_raw = null;
        }

        //var_dump($content_raw);
        //break;

        if(file_exists($filename.'.plex')){
            $content_processed = file_get_contents($filename.'.plex');
        }else{
            $content_processed = null;
        }
        //echo $content_raw;
       

        try {
            Doctrine::getConnectionByTableName('sfErrorLog');
            
            $requestPlex = new RequestPlex();
            $requestPlex->setDate(date('Y-m-d H:i:s'));
            $requestPlex->setType($datas['type']);
            $requestPlex->setUserCulture(sfContext::getInstance()->getUser()->getCulture());
            $requestPlex->setUserIp($datas['infosUser']['ip']);
            $requestPlex->setUserAgent($datas['infosUser']['userAgent']);
            $requestPlex->setSearchInfos(serialize($datas['params']));
            $requestPlex->setUserFolder($folder);
            $requestPlex->setFilename($filename);
            $requestPlex->setResponseRaw($content_raw);
            $requestPlex->setHeader(serialize($datas['header']));
            $requestPlex->setHeaderRaw($datas['header']['raw']);
            $requestPlex->setResponseCode($datas['code']);
            $requestPlex->setElapsedPlexRequest($time_plex);
            $requestPlex->setResponseProcessed($content_processed);
            $requestPlex->setElapsedProcessResponse($totalTime);
            $requestPlex->save();


        }  catch (Doctrine_Exception $e){
            
        }

        //echo 'PlexLogger: logResponse';
        //break;

    }

}
?>
