<?php

/**
 * RequestInitPlex filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRequestInitPlexFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'user_culture'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_ip'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_agent'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_folder'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'elapsed_time'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'header'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'response_code' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'response_raw'  => new sfWidgetFormFilterInput(),
      'stid'          => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'user_culture'  => new sfValidatorPass(array('required' => false)),
      'user_ip'       => new sfValidatorPass(array('required' => false)),
      'user_agent'    => new sfValidatorPass(array('required' => false)),
      'user_folder'   => new sfValidatorPass(array('required' => false)),
      'elapsed_time'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'header'        => new sfValidatorPass(array('required' => false)),
      'response_code' => new sfValidatorPass(array('required' => false)),
      'response_raw'  => new sfValidatorPass(array('required' => false)),
      'stid'          => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('request_init_plex_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RequestInitPlex';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'date'          => 'Date',
      'user_culture'  => 'Text',
      'user_ip'       => 'Text',
      'user_agent'    => 'Text',
      'user_folder'   => 'Text',
      'elapsed_time'  => 'Number',
      'header'        => 'Text',
      'response_code' => 'Text',
      'response_raw'  => 'Text',
      'stid'          => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
