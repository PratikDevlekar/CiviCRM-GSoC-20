<?php
use CRM_Custommade01_ExtensionUtil as E;


class CRM_Custommade01_Page_CustomTemplate extends CRM_Core_Page {

  static $_links = NULL;
  public $_action;

  public function &links() {
    if (!(self::$_links)) {
      self::$_links = array(
        CRM_Core_Action::UPDATE => array(
          'name' => ts('Edit'),
          'url' => 'civicrm/admin/customtemplate/add',
          'qs' => 'action=update&id=%%id%%&reset=1',
          'title' => ts('Customize this message template'),
        ),
        CRM_Core_Action::DELETE => array(
          'name' => ts('Delete'),
          'url' => 'civicrm/admin/customtemplate/add',
          'qs' => 'action=delete&id=%%id%%',
          'title' => ts('Delete this message template'),
        )
      );
    }
    return self::$_links;
  }
   //https://doc.symbiotic.coop/dev/civicrm/v5.20/phpdoc/CRM_Core_Page_Basic.html
  public function action(&$object, $action, &$values, &$links, $permission, $forceAction = FALSE) {
  CRM_Core_Page_Basic::action($object, $action, $values, $links, $permission);
  }
  public function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(E::ts('Custom Templates'));
    //Basic page
    $CUSTOMTemplates = CRM_Core_DAO::executeQuery("SELECT * FROM civicrm_custom_templates");
    $temp = array();

    $action = NULL;
    if ($this->_action & CRM_Core_Action::ADD) {
      return;
    }
    $links = $this->links();
    if ($action == NULL) {
      if (!empty($links)) {
        $action = array_sum(array_keys($links));
      }
    }

    while($CUSTOMTemplates->fetch()) {
      $temp[$CUSTOMTemplates->id] = array();
      $temp[$CUSTOMTemplates->id]['msg_title'] = $CUSTOMTemplates->msg_title;
      $temp[$CUSTOMTemplates->id]['msg_template'] = $CUSTOMTemplates->msg_template;
      //for action
      $this->action($CUSTOMTemplates, $action, $temp[$CUSTOMTemplates->id], $links, CRM_Core_Permission::EDIT);
    }
    $this->assign('rows', $temp);

    parent::run();
  }

}
