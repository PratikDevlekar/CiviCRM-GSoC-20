<?php

require_once 'custommade01.civix.php';
use CRM_Custommade01_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/ 
 */
function custommade01_civicrm_config(&$config) {
  _custommade01_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function custommade01_civicrm_xmlMenu(&$files) {
  _custommade01_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function custommade01_civicrm_install() {
  _custommade01_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function custommade01_civicrm_postInstall() {
  _custommade01_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function custommade01_civicrm_uninstall() {
  _custommade01_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function custommade01_civicrm_enable() {
  _custommade01_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function custommade01_civicrm_disable() {
  _custommade01_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function custommade01_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _custommade01_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function custommade01_civicrm_managed(&$entities) {
  _custommade01_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function custommade01_civicrm_caseTypes(&$caseTypes) {
  _custommade01_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function custommade01_civicrm_angularModules(&$angularModules) {
  _custommade01_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function custommade01_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _custommade01_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function custommade01_civicrm_entityTypes(&$entityTypes) {
  _custommade01_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function custommade01_civicrm_themes(&$themes) {
  _custommade01_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

function custommade01_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Contact_Form_Task_Email') {
    $extURL = CRM_Core_Resources::singleton()->getURL('com.civicrm.custommade01');
    $form->assign('extURL', $extURL);
    //CRM_Core_Resources::singleton()->addScriptFile('com.civicrm.custommade01', 'mjml.js');
    $form->add('textarea', 'mjml_message',
      ts('MJML Format'),
      array('cols' => '80', 'rows' => '8')
    );

    $CUSTOMTitles = CRM_Core_DAO::executeQuery("SELECT id, msg_title FROM civicrm_custom_templates");
    while($CUSTOMTitles->fetch()) {
      $MJML_options[$CUSTOMTitles->id] = $CUSTOMTitles->msg_title;
    }
    $templatePath = realpath(dirname(__FILE__)."/templates");
    $form->add('select', "CUSTOMtemplate", ts("Use MJML Template"),
      array('' => ts('- select -')) + $MJML_options , FALSE,
      array("onChange" => "selectMJMLValue( this.value, \"{}\");")
    );
    // dynamically insert a template block in the page
    CRM_Core_Region::instance('page-body')->add(array(
      'template' => "{$templatePath}/mjml_field.tpl"
    ));
  }
}

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 *

function custommade01_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function custommade01_civicrm_navigationMenu(&$menu) {
  _custommade01_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('Custom Templates'),
    'name' => 'custom_templates',
    'url' => 'civicrm/admin/customtemplates',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _custommade01_civix_navigationMenu($menu);
} 
