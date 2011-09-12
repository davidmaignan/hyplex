<?php

/**
 * sfErrorLog filter form base class.
 *
 * @package    hypertech_booking
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfErrorLogFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'class_name'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'message'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'module_name'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'action_name'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'exception_object' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'request'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'uri'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'type'             => new sfValidatorPass(array('required' => false)),
      'class_name'       => new sfValidatorPass(array('required' => false)),
      'message'          => new sfValidatorPass(array('required' => false)),
      'module_name'      => new sfValidatorPass(array('required' => false)),
      'action_name'      => new sfValidatorPass(array('required' => false)),
      'exception_object' => new sfValidatorPass(array('required' => false)),
      'request'          => new sfValidatorPass(array('required' => false)),
      'uri'              => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('sf_error_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfErrorLog';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'type'             => 'Text',
      'class_name'       => 'Text',
      'message'          => 'Text',
      'module_name'      => 'Text',
      'action_name'      => 'Text',
      'exception_object' => 'Text',
      'request'          => 'Text',
      'uri'              => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
