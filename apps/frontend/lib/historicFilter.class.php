<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of historicFilter
 *
 * @author david
 */
class historicFilter extends sfFilter {
    
    //private $arExclude = array('autocomplete');

    public function execute($filterChain) {

            $request = sfContext::getInstance()->getRequest();
            $user = sfContext::getInstance()->getUser();
            
            if($request->getParameter('module') == 'autocomplete'){
                //exit;
                $filterChain->execute();
                return true;
            }

            $date = date('Y-m-d H:i:s');
            
            $ip = $request->getRemoteAddress();
            $folder = explode('/',sfConfig::get('sf_user_folder'));
            
            $agent = $request->getHttpHeader('user-agent');
            $uri = $request->getUri();
            $lastFilename = $user->getLastFilename();
            $sTId = $user->getAttribute('sTId');
            $parameters = $request->getParameterHolder()->serialize();

            $string = '';

            //Info to save: date, ip, agent, uri, lastFilename, parameters
            $string =   $date.'|'.$ip.'|'.end($folder).'|'.$agent.'|'
                        .$uri.'|'.$sTId.'|'.$lastFilename.'|'.$parameters.'|'.session_id()."\r\n";

            $filename = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'historic';
            $handle = fopen($filename, 'ab');
            fwrite($handle, $string);
            fclose($handle);

            // Execute the next filter
            $filterChain->execute();
            
        }


}

