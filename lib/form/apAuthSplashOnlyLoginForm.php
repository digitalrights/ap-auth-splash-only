<?php

/**
 * apAuthSplashOnlyLoginForm
 * Login form for splashonly node
 *
 * @package    authpuppy
 * @subpackage plugin
 * @author     Geneviève Bastien <gbastien@versatic.net>
 * @version    $Id: pre-alpha$
 */
class apAuthSplashOnlyLoginForm extends BaseForm
{
  protected $namespace = 'apAuthSplashOnly';
  /**
   * @see sfForm
   */
  public function setup()
  {
    parent::setup();
    if (apAuthSplashOnlyMain::getPlugin()->getConfigValue('allow_enter_name', true)) {
      $this->widgetSchema['optional_name'] = new sfWidgetFormInputText(array('label' => "Optional name to identify yourself"));
      $this->validatorSchema['optional_name'] = new sfValidatorString(array('required' => false, 'max_length' => 255));
    }
    
    $this->widgetSchema->setNameFormat($this->namespace . '[%s]');
  }

}