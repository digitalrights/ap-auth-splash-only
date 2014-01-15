<?php
/**
 * apAuthSplashOnlyMain
 * 
 * Main class implementing static functions for different calls of the plugin and also a
 *   plugin specific shortcut to the plugin object
 * 
 * 
 * @package    authpuppy
 * @subpackage plugin
 * @author     Geneviève Bastien <gbastien@versatic.net>
 * @author 		 Philippe April <philippe@philippeapril.com>
 * @version    BZR: $Id$
 */

class apAuthSplashOnlyMain  {
  protected static $_plugin; 
  
  /**
   * Returns the plugin object associated with this plugin
   * @return apPlugin
   */
  public static function getPlugin() {
    if (is_null(self::$_plugin))
      self::$_plugin = apPlugin::getPlugin('apAuthSplashOnlyPlugin');
    return self::$_plugin;
  }
  
  
  /**
   * Returns the authenticator and states of authenticators for this authentication plugin
   */
  public static function getAuthenticatorTypes(sfEvent $event, $result) {  
    $result["apAuthSplashOnly"] = 'apAuthSplashOnly';
    return $result;
  }
  
  /**
   * This function is called on event connection.first_check
   * If mac_as_username is selected, we need to change the identity for this connection as the mac address instead
   * @param sfEvent $event
   * @param unknown_type $connection
   */
  public static function checkByRouter(sfEvent $event, $connection) {
    if (apAuthSplashOnlyMain::getPlugin()->getConfigValue('mac_as_username', false)) {
      if ($connection->getMac() != '' && $connection->getAuthType() == 'apAuthSplashOnly')
        $connection->setIdentity($connection->getMac()); 
    }
    return $connection; 
  }
  
  
}