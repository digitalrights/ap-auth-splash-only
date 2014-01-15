<?php

/**
 * Main configuration for the apAuthSplashOnlyPluginConfiguration
 *
 * @package    authpuppy
 * @subpackage plugin
 * @author     Geneviève Bastien <gbastien@versatic.net>
 * @version    Bzr: $Id: pre-alpha$
 */

class apAuthSplashOnlyPluginConfiguration extends sfPluginConfiguration {
 
  const version= "1.0.0-DEV";
  const plugin_name = "apAuthSplashOnlyPlugin";
 /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {  
    $this->dispatcher->connect('authentication.request', array($this, 'registerAuthenticator'));
    $this->dispatcher->connect('authenticator.report_interface', array('apAuthSplashOnlyMain', 'getAuthenticatorTypes'));
    $this->dispatcher->connect('connection.first_check', array('apAuthSplashOnlyMain', 'checkByRouter'));
    
  }

  public static function isAuthPuppyPlugin() {
    return true;
  }

  public function registerAuthenticator() {
    apAuthentication::registerAuthenticator('apAuthSplashOnly');
  }
}
