<?php

/**
 * RequestInitPlex
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    hypertech_booking
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class RequestInitPlex extends BaseRequestInitPlex
{

    public function advancedSave($infosUser, $header, $elapsedTime, $sessionTokenId){

        $this->setDate(date('Y-m-d H:i:s'));
        $this->setUserCulture($infosUser['culture']);
        $this->setUserIp($infosUser['ip']);
        $this->setUserAgent($infosUser['userAgent']);
        $this->setUserFolder($infosUser['folder']);
        $this->setElapsedTime($elapsedTime);
        $this->setHeader(serialize($header));
        $this->setResponseCode($header['code'][1]);
        $this->setStid($sessionTokenId);

        $this->save();


    }

}
