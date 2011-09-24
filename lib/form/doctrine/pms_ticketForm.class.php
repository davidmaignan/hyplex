<?php

/**
 * pms_ticket form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pms_ticketForm extends Basepms_ticketForm
{
  public function configure()
  {
      unset($this['submitted_by_id']);

      $this->widgetSchema['ticket_type']->addOption('expanded',true);
      $this->widgetSchema['urgency_type']->addOption('expanded',true);
      $this->widgetSchema['status_type']->addOption('expanded',true);

      $this->widgetSchema['assigned_to_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true));

      $this->widgetSchema['subject'] = new sfWidgetFormInputText(array(),array('size'=>'70px'));

      
      $this->widgetSchema['description'] = new sfWidgetFormTextareaTinyMCE(array(
	  'width'  => 800,
	  'height' => 250,
	  'config' => 'theme: "simple"'
	));

      $this->widgetSchema['description'] = new sfWidgetFormTextarea(array(),array('cols'=>'136','rows'=>'10', 'class'=>'required'));


      //Embed Form
      $attachements = $this->getObject()->getPmsAttachements();
      //var_dump(count($attachements));

      $attachementsForm = new sfForm();
      $count = 0;

      if(count($attachements)){
          //$attachement = new pms_attachement();
          //$attachement->setPmsTicket($this->getObject());
          //$attachements = array($attachement);
          
          foreach($attachements as $attachement){
              $attachementForm = new pms_attachementForm($attachement);
              $attachementsForm->embedForm($count , $attachementForm);
              $count++;
          }

      }else{
          $pmsAttachement = new pms_attachement();
          $pmsAttachement->PmsTicket = $this->getObject();

          $attachementForm = new pms_attachementForm($pmsAttachement);
          $attachementsForm->embedForm($count , $attachementForm);
          $count++;
      }


      //Embedding the container in the main form
      $this->embedForm('pms_attachements', $attachementsForm);

      $this->disableCSRFProtection();
      $this->disableLocalCSRFProtection();

      $this->mergePostValidator(new AttachementsValidatorSchema());

      
  }

  public function addAttachement($num){
      $pmsAttachement = new pms_attachement();
      $pmsAttachement->PmsTicket = $this->getObject();
      $attachementForm = new pms_attachementForm($pmsAttachement);

      //Embedding the new picture in the container
      $this->embeddedForms['pms_attachements']->embedForm($num, $attachementForm);
      //Re-embedding the container
      $this->embedForm('pms_attachements', $this->embeddedForms['pms_attachements']);
  }


  public function  doSave($con = null) {

      //var_dump($this->getValues());

      //break;

      parent::doSave($con);
    }

  public function bind(array $taintedValues = null, array $taintedFiles = null)
    {
      foreach($taintedValues['pms_attachements'] as $key=>$newPic)
      {
        if (!isset($this['pms_attachements'][$key]))
        {
          $this->addAttachement($key);
        }
      }
      parent::bind($taintedValues, $taintedFiles);
    }

   public function saveEmbeddedForms($con = null, $forms = null)
    {      

      if (null === $forms)
      {
        $attachements = $this->getValue('pms_attachements');
        $forms = $this->embeddedForms;

        foreach ($this->embeddedForms['pms_attachements'] as $name => $form)
        {

          //var_dump($attachements[$name]);

          if (!isset($attachements[$name]))
          {
            unset($forms['pms_attachements'][$name]);
          }
        }
      }

      return parent::saveEmbeddedForms($con, $forms);
    }

    
}
