<?php

/**
 * account actions.
 *
 * @package    hyplexdemo
 * @subpackage account
 * @author     David Maignan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class accountActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {

        $userId = $this->getUser()->getGuardUser()->getId();
        $this->myInfos = Doctrine::getTable('Booking')->retrieveInfos($userId);

        $this->passwordForm = new PasswordForm();

        //$this->tabToShow = 'password';
    }

    public function executeChangePassword(sfWebRequest $request) {

        $userId = $this->getUser()->getGuardUser()->getId();
        $this->myInfos = Doctrine::getTable('Booking')->retrieveInfos($userId);
        $this->passwordForm = new PasswordForm();

        if ($request->isMethod('post')) {
            //var_dump($request->getParameterHolder());
            $this->passwordForm->bind($request->getParameter('change_password'));

            if ($this->passwordForm->isValid()) {

                $values = $this->passwordForm->getValues();
                //$this->getUser()->setPassword($)
                $this->getUser()->setPassword($values['password']);

                $this->getUser()->setFlash('change_password', 'Your password has been changed successfully.');
            }
            $this->tabToShow = 'password';
            $this->setTemplate('index');
        }
    }
    
    
    public function executeCreateAccount(sfWebRequest $request) {
        
        $this->form = new AccountForm();
        
        if('POST' === $request->getMethod()){
            $this->processForm($request, $this->form);
        }
        
    }
    
    protected function processForm(sfWebRequest $request, sfForm $form) {
        
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        
        if ($form->isValid()) {
            
            
            
        }
        
    }
    
    
    public function executeListPreferences(sfWebRequest $request) {
        
    }
    
    
    public function executePrevSearches(sfWebRequest $request) {
        
    }

    
    public function executeListOfBookings(sfWebRequest $request) {

        $userId = $this->getUser()->getGuardUser()->getId();
        $this->bookings = Doctrine::getTable('booking')->getBookingsPerUser($userId);
    }

    public function executeForgotPassword($request) {
        
    }

    public function executeSignin($request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            return $this->redirect('@homepage');
        }

        $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
        $this->form = new $class();

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('signin'));
            if ($this->form->isValid()) {
                $values = $this->form->getValues();

                $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

                // always redirect to a URL set in app.yml
                // or to the referer
                // or to the homepage
                $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer($request->getReferer()));

                return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');
            }
        } else {
            if ($request->isXmlHttpRequest()) {
                $this->getResponse()->setHeaderOnly(true);
                $this->getResponse()->setStatusCode(401);

                return sfView::NONE;
            }

            // if we have been forwarded, then the referer is the current URL
            // if not, this is the referer of the current request
            $user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

            $module = sfConfig::get('sf_login_module');
            if ($this->getModuleName() != $module) {
                return $this->redirect($module . '/' . sfConfig::get('sf_login_action'));
            }

            $this->getResponse()->setStatusCode(401);
        }
    }

}
