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
  
  public static function del($id) {
    $instance = new CRM_Custommade01_DAO_CustomTemplates();
    $instance->id = $id;
    $instance->delete();
  }



}
