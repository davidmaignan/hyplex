<?php

/**
 * pms_clarification filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basepms_clarificationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'clarification_type' => new sfWidgetFormChoice(array('choices' => array('' => '', 'question' => 'question', 'answer' => 'answer', 'note' => 'note'))),
      'pms_ticket_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PmsTicket'), 'add_empty' => true)),
      'from_user_id'       => new sfWidgetFormFilterInput(),
      'to_user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'message'            => new sfWidgetFormFilterInput(),
      'answer'             => new sfWidgetFormFilterInput(),
      'is_internal'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'clarification_type' => new sfValidatorChoice(array('required' => false, 'choices' => array('question' => 'question', 'answer' => 'answer', 'note' => 'note'))),
      'pms_ticket_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PmsTicket'), 'column' => 'id')),
      'from_user_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'to_user_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'message'            => new sfValidatorPass(array('required' => false)),
      'answer'             => new sfValidatorPass(array('required' => false)),
      'is_internal'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('pms_clarification_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'pms_clarification';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'clarification_type' => 'Enum',
      'pms_ticket_id'      => 'ForeignKey',
      'from_user_id'       => 'Number',
      'to_user_id'         => 'ForeignKey',
      'message'            => 'Text',
      'answer'             => 'Text',
      'is_internal'        => 'Boolean',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
