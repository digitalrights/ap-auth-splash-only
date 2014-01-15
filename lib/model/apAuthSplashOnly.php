<?php
/**
 * apSplashOnlyUser
 * 
 * This class is the facade class of the authenticator, to be used by the application
 * 
 * 
 * @package    authpuppy
 * @subpackage plugin
 * @author     Geneviève Bastien <gbastien@versatic.net>
 * @author 		 Philippe April <philippe@philippeapril.com>
 * @version    BZR: $Id$
 */

class apAuthSplashOnly extends apAuthentication {
  
  protected $_name = "Splash-only authentication";
  protected $form;
  
  public function __construct() {
      $this->_name = apAuthSplashOnlyMain::getPlugin()->getConfigValue('authenticator_name', $this->_name);
  }

  /**
   * @see apAuthentication
   */
  public function initialize(sfWebRequest $request, apBaseIdentity $identity) {
    if (apAuthSplashOnlyMain::getPlugin()->getConfigValue('auto_log_users', false)) {
      $login = 'guest' . time();
      $this->_identify($login, $identity);
    }
    $this->form = new apAuthSplashOnlyLoginForm();
  }
  
  /**
   * @see apAuthentication
   */
  public function process(sfAction $action, sfWebRequest $request, apBaseIdentity $identity) {
    $params = $request->getParameter('submit');
   
    if (isset($params['apAuthSplashOnlyConnect'])) {
      $this->form->bind($request->getParameter('apAuthSplashOnly'));
      if ($this->form->isValid()) {
        $values = $this->form->getValues(); 
        $login = isset($values['optional_name'])? $values['optional_name']:'';
        
        if ($login == '' || is_null($login)) {
          $login = 'guest' . time();
        }
        $this->_identify($login, $identity);
      }
    } 
  }
  
  protected function _identify($login, &$identity) {
    $idobject = new apAuthSplashOnlyUser($login);
        
    $identity->identify($login, $idobject, $this);
  }
  
  
  
  /**
   * This function is called in the context of a view and returns the html string
   *   to render the authenticator
   * @return string
   */
  public function render() {
    return include_partial('apAuthSplashOnlyLogin/'.get_class($this->form), array('form' => $this->form));
  }
  
}

class apAuthSplashOnlyUser {
  protected $username;
  public function __construct($name = 'guest') {
    $this->username = $name;
  }
  public function getUsername() {
    return $this->username;
  }
}
