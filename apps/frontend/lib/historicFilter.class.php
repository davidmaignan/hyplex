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

        public function execute($filterChain) {

            $request = sfContext::getInstance()->getRequest();
            $user = sfContext::getInstance()->getUser();

            $date = date('Y-m-d H:m:i');
            
            $ip = $request->getRemoteAddress();
            $agent = $request->getHttpHeader('user-agent');
            $uri = $request->getUri();
            $lastFilename = serialize($user->getLastFilename());
            $sTId = $user->getAttribute('sTId');
            $parameters = $request->getParameterHolder()->serialize();

            /*
            ob_start();
            var_dump($date);
            var_dump($ip);
            var_dump($agent);
            var_dump($uri);
            var_dump($lastFilename);
            var_dump($parameters);
            */

            $string = '';

            //Info to save: date, ip, agent, uri, lastFilename, parameters
            $string = $date.'|'.$ip.'|'.$agent.'|'.$uri.'|'.$sTId.'|'.$lastFilename.'|'.$parameters."\r\n";

            $filename = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'historic';
            $handle = fopen($filename, 'ab');
            fwrite($handle, $string);
            fclose($handle);

            // Execute the next filter
            $filterChain->execute();
            
        }


}

