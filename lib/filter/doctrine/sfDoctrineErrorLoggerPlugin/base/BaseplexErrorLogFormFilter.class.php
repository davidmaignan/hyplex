<?php

/**
 * plexErrorLog filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseplexErrorLogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'class_name'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'message'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'file'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parameters'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'plex_response' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'type'          => new sfValidatorPass(array('required' => false)),
      'class_name'    => new sfValidatorPass(array('required' => false)),
      'message'       => new sfValidatorPass(array('required' => false)),
      'file'          => new sfValidatorPass(array('required' => false)),
      'parameters'    => new sfValidatorPass(array('required' => false)),
      'plex_response' => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('plex_error_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'plexErrorLog';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'type'          => 'Text',
      'class_name'    => 'Text',
      'message'       => 'Text',
      'file'          => 'Text',
      'parameters'    => 'Text',
      'plex_response' => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
