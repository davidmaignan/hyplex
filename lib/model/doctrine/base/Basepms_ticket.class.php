<?php

/**
 * Basepms_ticket
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $subject
 * @property clob $description
 * @property integer $submitted_by_id
 * @property integer $assigned_to_id
 * @property enum $ticket_type
 * @property enum $urgency_type
 * @property enum $status_type
 * @property integer $pms_milestone_id
 * @property sfGuardUser $sfGuardUser
 * @property pms_milestone $pms_milestone
 * @property Doctrine_Collection $PmsAttachements
 * @property Doctrine_Collection $Tickets
 * 
 * @method string              getSubject()          Returns the current record's "subject" value
 * @method clob                getDescription()      Returns the current record's "description" value
 * @method integer             getSubmittedById()    Returns the current record's "submitted_by_id" value
 * @method integer             getAssignedToId()     Returns the current record's "assigned_to_id" value
 * @method enum                getTicketType()       Returns the current record's "ticket_type" value
 * @method enum                getUrgencyType()      Returns the current record's "urgency_type" value
 * @method enum                getStatusType()       Returns the current record's "status_type" value
 * @method integer             getPmsMilestoneId()   Returns the current record's "pms_milestone_id" value
 * @method sfGuardUser         getSfGuardUser()      Returns the current record's "sfGuardUser" value
 * @method pms_milestone       getPmsMilestone()     Returns the current record's "pms_milestone" value
 * @method Doctrine_Collection getPmsAttachements()  Returns the current record's "PmsAttachements" collection
 * @method Doctrine_Collection getTickets()          Returns the current record's "Tickets" collection
 * @method pms_ticket          setSubject()          Sets the current record's "subject" value
 * @method pms_ticket          setDescription()      Sets the current record's "description" value
 * @method pms_ticket          setSubmittedById()    Sets the current record's "submitted_by_id" value
 * @method pms_ticket          setAssignedToId()     Sets the current record's "assigned_to_id" value
 * @method pms_ticket          setTicketType()       Sets the current record's "ticket_type" value
 * @method pms_ticket          setUrgencyType()      Sets the current record's "urgency_type" value
 * @method pms_ticket          setStatusType()       Sets the current record's "status_type" value
 * @method pms_ticket          setPmsMilestoneId()   Sets the current record's "pms_milestone_id" value
 * @method pms_ticket          setSfGuardUser()      Sets the current record's "sfGuardUser" value
 * @method pms_ticket          setPmsMilestone()     Sets the current record's "pms_milestone" value
 * @method pms_ticket          setPmsAttachements()  Sets the current record's "PmsAttachements" collection
 * @method pms_ticket          setTickets()          Sets the current record's "Tickets" collection
 * 
 * @package    hypertech_booking
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basepms_ticket extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pms_ticket');
        $this->hasColumn('subject', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
        $this->hasColumn('submitted_by_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('assigned_to_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ticket_type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'question',
              1 => 'bug',
              2 => 'feature',
              3 => 'internal',
              4 => 'change',
             ),
             'notnull' => true,
             ));
        $this->hasColumn('urgency_type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'low',
              1 => 'normal',
              2 => 'high',
              3 => 'emergency',
             ),
             'default' => 'low',
             ));
        $this->hasColumn('status_type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'open',
              1 => 'resolve',
              2 => 'close',
             ),
             'default' => 'open',
             ));
        $this->hasColumn('pms_milestone_id', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'INNODB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
             'local' => 'assigned_to_id',
             'foreign' => 'id'));

        $this->hasOne('pms_milestone', array(
             'local' => 'pms_milestone_id',
             'foreign' => 'id'));

        $this->hasMany('pms_attachement as PmsAttachements', array(
             'local' => 'id',
             'foreign' => 'pms_ticket_id'));

        $this->hasMany('pms_clarification as Tickets', array(
             'local' => 'id',
             'foreign' => 'pms_ticket_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}