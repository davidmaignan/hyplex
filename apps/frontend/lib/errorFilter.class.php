<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sferrorFilter
 *
 * @author david
 */
class errorFilter extends sfFilter {
    //put your code here

    public function execute($filterChain) {

        set_error_handler(array($this,"myErrorHandler"));

        $filterChain->execute();
        
    }

    static public function myErrorHandler($errno, $errstr, $errfile, $errline) {

        switch ($errno) {
            case E_NOTICE:
            case E_USER_NOTICE:
                $errors = 8;
                break;
            case E_WARNING:
            case E_USER_WARNING:
                $errors = 2;
                break;
            case E_ERROR:
            case E_USER_ERROR:
                $errors = 1;
                break;
            default:
                $errors = 0;
                break;
        }

        $infos = array();
        $infos['error'] = $errors;
        $infos['errno'] = $errno;
        $infos['errstr'] = $errstr;
        $infos['errfile'] = $errfile;
        $infos['errline'] = $errline;

        $event = new sfEvent('errorFilter', 'php.throw_error', array('infos' => $infos));

        sfContext::getInstance()->getEventDispatcher()->notify($event);

        if (ini_get("display_errors"))
            //printf("<br />\n<b>%s</b>: %s in <b>%s</b> on line <b>%d</b><br /><br />\n", $errors, $errstr, $errfile, $errline);
        if (ini_get('log_errors'))
            error_log(sprintf("PHP %s:  %s in %s on line %d", $errors, $errstr, $errfile, $errline));
        return true;
    }




}
?>
