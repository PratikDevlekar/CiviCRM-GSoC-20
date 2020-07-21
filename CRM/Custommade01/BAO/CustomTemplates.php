<?php
use CRM_Custommade01_ExtensionUtil as E;

class CRM_Custommade01_BAO_CustomTemplates extends CRM_Custommade01_DAO_CustomTemplates {

  /**
   * Create a new CustomTemplates based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Custommade01_DAO_CustomTemplates|NULL
   */
  public static function create($params) {
    $className = 'CRM_Custommade01_DAO_CustomTemplates';
    $entityName = 'CustomTemplates';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  }
  // Delete the template
  public static function del($id) {
    $instance = new CRM_Custommade01_DAO_CustomTemplates();
    $instance->id = $id;
    $instance->delete();
  }
  // Call rest api 
  public static function mjmlToHtml($CustomFt) {
    $url = 'https://api.mjml.io/v1/render';

    $username = '96899f58-e0e1-4008-bb57-27fd4c2911ab';
    $password = '0d51e4a7-6d04-491f-a31d-f31c8635ef9f';
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_POST, 1);
    $CustomFt = is_array($CustomFt) ? json_encode($customFt) : $CustomFt;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $CustomFt);

    curl_setopt($curl, CURLOPT_USERPWD, "{$username}:{$password}");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    curl_close($curl);

    return json_decode($result, TRUE);
  }

}
