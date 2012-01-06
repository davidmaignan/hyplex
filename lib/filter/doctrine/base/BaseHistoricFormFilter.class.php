<?php

/**
 * Historic filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHistoricFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'tsop'       => new sfWidgetFormFilterInput(),
      'ip'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'country_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => true)),
      'folder'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'language'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sTId'       => new sfWidgetFormFilterInput(),
      'agent'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'os'         => new sfWidgetFormFilterInput(),
      'browser'    => new sfWidgetFormFilterInput(),
      'version'    => new sfWidgetFormFilterInput(),
      'uri'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'module'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'action'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'filename'   => new sfWidgetFormFilterInput(),
      'parameters' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'scrubbed'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'session_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'tsop'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip'         => new sfValidatorPass(array('required' => false)),
      'country_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Country'), 'column' => 'id')),
      'folder'     => new sfValidatorPass(array('required' => false)),
      'language'   => new sfValidatorPass(array('required' => false)),
      'sTId'       => new sfValidatorPass(array('required' => false)),
      'agent'      => new sfValidatorPass(array('required' => false)),
      'os'         => new sfValidatorPass(array('required' => false)),
      'browser'    => new sfValidatorPass(array('required' => false)),
      'version'    => new sfValidatorPass(array('required' => false)),
      'uri'        => new sfValidatorPass(array('required' => false)),
      'module'     => new sfValidatorPass(array('required' => false)),
      'action'     => new sfValidatorPass(array('required' => false)),
      'filename'   => new sfValidatorPass(array('required' => false)),
      'parameters' => new sfValidatorPass(array('required' => false)),
      'scrubbed'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'session_id' => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('historic_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historic';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'date'       => 'Date',
      'tsop'       => 'Number',
      'ip'         => 'Text',
      'country_id' => 'ForeignKey',
      'folder'     => 'Text',
      'language'   => 'Text',
      'sTId'       => 'Text',
      'agent'      => 'Text',
      'os'         => 'Text',
      'browser'    => 'Text',
      'version'    => 'Text',
      'uri'        => 'Text',
      'module'     => 'Text',
      'action'     => 'Text',
      'filename'   => 'Text',
      'parameters' => 'Text',
      'scrubbed'   => 'Boolean',
      'session_id' => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
