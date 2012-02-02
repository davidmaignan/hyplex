<?php

/**
 * IpMapping filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseIpMappingFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ip_from'      => new sfWidgetFormFilterInput(),
      'ip_to'        => new sfWidgetFormFilterInput(),
      'country_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => true)),
      'country_code' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'ip_from'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_to'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'country_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Country'), 'column' => 'id')),
      'country_code' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ip_mapping_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'IpMapping';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'ip_from'      => 'Number',
      'ip_to'        => 'Number',
      'country_id'   => 'ForeignKey',
      'country_code' => 'Text',
    );
  }
}
