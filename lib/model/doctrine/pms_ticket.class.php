<?php

/**
 * pms_ticket
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    hypertech_booking
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class pms_ticket extends Basepms_ticket
{
    public function  getSubmittedBy() {

        

        //return 'to complete';
        return $this->submitted_by_id;
    }

    public function getClarifications(){

        $q = Doctrine_Query::create()
                ->from('pms_clarification a')
                ->where('a.pms_ticket_id = ?', $this->id)
                ->orderBy('a.id DESC')
                ->execute();

        return $q;


    }

    public function  getSubmittedByName() {
        $q = Doctrine::getTable('sfGuardUser')->findOneBy('id', $this->getSubmittedBy());
        return $q->getUserName();
    }


    public function  save(Doctrine_Connection $conn = null) {

        if($this->isNew() && php_sapi_name() != 'cli'){
            $this->setSubmittedById(sfContext::getInstance()->getUser()->getGuardUser()->getId());
        }

        parent::save($conn);
    }



}
