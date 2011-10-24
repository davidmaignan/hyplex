<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfErrorLogger.class.php 8080 2008-03-25 16:41:29Z fabien $
 */
class sfErrorLogger {

    static public function log500(sfEvent $event) {
        $exception = $event->getSubject();
        $context = sfContext::getInstance();

        

        // is database configured?
        try {
            $test = 'here';
            Doctrine::getConnectionByTableName('sfErrorLog');

            // log exception in db
            $log = new sfErrorLog();
            $log->setType('sfError404Exception' == get_class($exception) ? 404 : 500);
            $log->setClassName(get_class($exception));
            $log->setMessage(!is_null($exception->getMessage()) ? $exception->getMessage() : 'n/a');
            $log->setModuleName($context->getModuleName());
            $log->setActionName($context->getActionName());
            $log->setExceptionObject($exception);
            //$log->setRequest($context->getRequest());
            $log->setUri($context->getRequest()->getUri());
            $log->save();
            
        } catch (Exception $e) {
           
        }

       

    }

    static public function log404(sfEvent $event) {

        $exception = $event->getSubject();

        $request = sfContext::getInstance()->getRequest();

        // is database configured?
        try {
            Doctrine::getConnectionByTableName('sfErrorLog');

            // log 404 in db
            $log = new sfErrorLog();
            $log->setType(404);
            $log->setClassName(get_class($exception));
            $log->setMessage('n/a');
            $log->setModuleName($event['module']);
            $log->setActionName($event['action']);
            $log->setExceptionObject(null);
            $log->setRequest($request);
            $log->setUri($request->getUri());
            $log->save();
        } catch (Exception $e) {
            
        }
    }

    static public function plexError(sfEvent $event) {

        $message = $event['infos']['message'];
        $filename = $event['infos']['filename'];
        $code = $event['infos']['code'];
        $plexResponse = $event['infos']['response'];
        $params = $event['infos']['parameters'];

        $exception = $event->getSubject();
        $context = sfContext::getInstance();

        $filename = PlexParsing::splitFilename($filename);

        try {
            
            Doctrine::getConnectionByTableName('sfErrorLog');
            $log = new plexErrorLog();
            $log->setType($code);
            $log->setClassName(get_class($exception));
            $log->setMessage($message);
            $log->setFile($filename);
            $log->setParameters(serialize($params));
            $log->setPlexResponse($plexResponse);
            $log->save();

            

        } catch (Exception $e) {
            
        }

    
    }

    static public function phpError(sfEvent $event){

        $error = $event['infos']['error'];
        $errno = $event['infos']['error'];
        $errno = $event['infos']['errno'];
        $errstr = $event['infos']['errstr'];
        $errfile = $event['infos']['errfile'];
        $errline = $event['infos']['errline'];

        $message = sprintf("PHP %s:  %s in %s on line %d", $error, $errstr, $errfile, $errline);

        $request = sfContext::getInstance()->getRequest();
        //var_dump($request->getParameter('module'));

        // is database configured?
        try {
            Doctrine::getConnectionByTableName('sfErrorLog');

            // log 404 in db
            $log = new sfErrorLog();
            $log->setType($error);
            $log->setClassName('n/a');
            $log->setMessage($message);
            $log->setModuleName($request->getParameter('module'));
            $log->setActionName($request->getParameter('action'));
            $log->setExceptionObject(null);
            $log->setRequest('');
            $log->setUri($request->getUri());
            $log->save();
        } catch (Exception $e) {

        }
        

    }

}