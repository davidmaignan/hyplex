<?php

/**
 * RequestPlex filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRequestPlexFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'type'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'search_infos'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_culture'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_ip'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_agent'         => new sfWidgetFormFilterInput(),
      'user_folder'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'filename'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_info'          => new sfWidgetFormFilterInput(),
      'header'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'header_raw'         => new sfWidgetFormFilterInput(),
      'response_raw'       => new sfWidgetFormFilterInput(),
      'response_code'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'response_processed' => new sfWidgetFormFilterInput(),
      'elapsed_time'       => new sfWidgetFormFilterInput(),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'date'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'type'               => new sfValidatorPass(array('required' => false)),
      'search_infos'       => new sfValidatorPass(array('required' => false)),
      'user_culture'       => new sfValidatorPass(array('required' => false)),
      'user_ip'            => new sfValidatorPass(array('required' => false)),
      'user_agent'         => new sfValidatorPass(array('required' => false)),
      'user_folder'        => new sfValidatorPass(array('required' => false)),
      'filename'           => new sfValidatorPass(array('required' => false)),
      'user_info'          => new sfValidatorPass(array('required' => false)),
      'header'             => new sfValidatorPass(array('required' => false)),
      'header_raw'         => new sfValidatorPass(array('required' => false)),
      'response_raw'       => new sfValidatorPass(array('required' => false)),
      'response_code'      => new sfValidatorPass(array('required' => false)),
      'response_processed' => new sfValidatorPass(array('required' => false)),
      'elapsed_time'       => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('request_plex_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RequestPlex';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'date'               => 'Date',
      'type'               => 'Text',
      'search_infos'       => 'Text',
      'user_culture'       => 'Text',
      'user_ip'            => 'Text',
      'user_agent'         => 'Text',
      'user_folder'        => 'Text',
      'filename'           => 'Text',
      'user_info'          => 'Text',
      'header'             => 'Text',
      'header_raw'         => 'Text',
      'response_raw'       => 'Text',
      'response_code'      => 'Text',
      'response_processed' => 'Text',
      'elapsed_time'       => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
