<?php
use CRM_Custommade01_ExtensionUtil as E;

/**
 * CustomMTemplates.Importtemplates API
 *
 * @param array $params
 *
 * @return array
 *   API result descriptor
 *
 * @see civicrm_api3_create_success
 *
 * @throws API_Exception
 */
function civicrm_api3_custom_templates_Importtemplates($params) {
  $templatesSrcDir = E::path('Custom Templates');

  $mjmlTemplates = [];
  foreach (glob("{$templatesSrcDir}/*") as $name) {
    if (is_dir($name)) {
      foreach (glob("{$name}/*.mjml") as $mjmlTpl) {
        $mjmlTemplates[basename($name) . '_' . basename($mjmlTpl)] = $mjmlTpl;
      }
    }
  }
  if (!empty($mjmlTemplates)) {
    foreach ($mjmlTemplates as $tplName => $tplPath)
    $createdTpls[] = civicrm_api3('CustomTemplates', 'create', [
      'msg_title' => $tplName,
      'msg_template' => file_get_contents($tplPath),
    ]);
  }

  return civicrm_api3_create_success($createdTpls, $params, 'CustomTemplates', 'Importtemplates');
}
