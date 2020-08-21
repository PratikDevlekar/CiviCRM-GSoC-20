<?php
use CRM_Custommade01_ExtensionUtil as E;

/**
 * CustomMade.Convertmjml API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_custom_made_Convertmjml_spec(&$spec) {
  $spec['mjml']['api.required'] = 1;
}

/**
 * CustomMade.Convertmjml API
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
function civicrm_api3_custom_made_Convertmjml($params) {
  if (strpos($params['mjml'], '<mj-container>') == false) {
    $mjml = explode("<mj-body", $params['mjml']);
    $mjml[1] = preg_replace('/>/', '><mj-container>', $mjml[1], 1);
    $params['mjml'] = implode('<mj-body', $mjml);

    $params['mjml'] = str_replace('</mj-body>', ' </mj-container> </mj-body>', $params['mjml']);
  }
  $result = CRM_Custommade01_BAO_CustomTemplates::mjmlToHtml($params);
  return civicrm_api3_create_success($result, $params, 'CustomMade', 'Convertmjml');
}
