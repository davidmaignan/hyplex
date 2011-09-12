<?php

/**
 * tmp actions.
 *
 * @package    hypertech_booking
 * @subpackage tmp
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tmpActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->pms_clarifications = Doctrine_Core::getTable('pms_clarification')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->pms_clarification = Doctrine_Core::getTable('pms_clarification')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->pms_clarification);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new pms_clarificationForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new pms_clarificationForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($pms_clarification = Doctrine_Core::getTable('pms_clarification')->find(array($request->getParameter('id'))), sprintf('Object pms_clarification does not exist (%s).', $request->getParameter('id')));
    $this->form = new pms_clarificationForm($pms_clarification);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($pms_clarification = Doctrine_Core::getTable('pms_clarification')->find(array($request->getParameter('id'))), sprintf('Object pms_clarification does not exist (%s).', $request->getParameter('id')));
    $this->form = new pms_clarificationForm($pms_clarification);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($pms_clarification = Doctrine_Core::getTable('pms_clarification')->find(array($request->getParameter('id'))), sprintf('Object pms_clarification does not exist (%s).', $request->getParameter('id')));
    $pms_clarification->delete();

    $this->redirect('tmp/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $pms_clarification = $form->save();

      $this->redirect('tmp/edit?id='.$pms_clarification->getId());
    }
  }
}
