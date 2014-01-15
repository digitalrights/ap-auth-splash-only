<?php

/**
 * apAuthSplashOnlyConfigureForm
 * Configure options for the splash only authenticator
 *
 * @package    authpuppy
 * @subpackage plugin
 * @author     Geneviève Bastien <gbastien@versatic.net>
 * @version    $Id: pre-alpha$
 */
class apAuthSplashOnlyConfigureForm extends apPluginManagerConfigurationForm
{
  protected $namespace = 'apAuthSplashOnlyConfigure';
  /**
   * @see sfForm
   */
  public function setup()
  {
    parent::setup();
   
    $this->widgetSchema['authenticator_name'] = new sfWidgetFormInputText(array('label' => "Authenticator name"));
    $this->widgetSchema->setHelp('authenticator_name', 'Title that will describe this authenticator.');
    $this->validatorSchema['authenticator_name'] = new sfValidatorString();
    
    $this->widgetSchema['allow_enter_name'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
    $this->widgetSchema->setHelp('allow_enter_name', 'Whether a textbox at login can optionally allow to enter a friendly name.');
    $this->validatorSchema['allow_enter_name'] = new sfValidatorPass();

    $this->widgetSchema['mac_as_username'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
    $this->widgetSchema->setHelp('mac_as_username', 'Whether to use the MAC address as username, otherwise a unique username is generated for each connection.');
    $this->validatorSchema['mac_as_username'] = new sfValidatorPass();

    $this->widgetSchema['auto_log_users'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
    $this->widgetSchema->setHelp('auto_log_users', 'If checked, the login page is not shown and users are automatically logged in.');
    $this->validatorSchema['auto_log_users'] = new sfValidatorPass();
    
    $this->widgetSchema['connect_button_text'] = new sfWidgetFormInputText(array('label' => "Connect button text"));
    $this->widgetSchema->setHelp('connect_button_text', 'Text to display on the connect button.');
    $this->validatorSchema['connect_button_text'] = new sfValidatorString(array('required' => false));
    
    $this->widgetSchema['text_before'] = new sfWidgetFormTextarea(array('label' => "Text before"));
    $this->widgetSchema->setHelp('text_before', 'Html text to display before the connect button');
    $this->validatorSchema['text_before'] = new sfValidatorString(array('required' => false));
    
    $this->widgetSchema['text_after'] = new sfWidgetFormTextarea(array('label' => "Text after"));
    $this->widgetSchema->setHelp('text_after', 'Html text to display after the connect button');
    $this->validatorSchema['text_after'] = new sfValidatorString(array('required' => false));
    

  }
  
  public function getPartial() {
    return "apAuthSplashOnlyLogin/formConfigure";
  }
  
  public function findDefaults() {
    $this->setDefaults(array('allow_enter_name' => $this->plugin->getConfigValue('allow_enter_name', false),
                           'authenticator_name' => $this->plugin->getConfigValue('authenticator_name', "Splash-only authentication"),
                            'connect_button_text' => $this->plugin->getConfigValue('connect_button_text', "Connect"),
                            'text_before' => $this->plugin->getConfigValue('text_before', ""),
                            'text_after' => $this->plugin->getConfigValue('text_after', ""),
                            'mac_as_username' => $this->plugin->getConfigValue('mac_as_username', false),
                            'auto_log_users' => $this->plugin->getConfigValue('auto_log_users', false),
                          ));
  }

}