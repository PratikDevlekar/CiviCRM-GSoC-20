<?php

use CRM_Custommade01_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Custommade01_Form_CustomTemplate extends CRM_Core_Form {
  public function buildQuickForm() {

    $this->_id = CRM_Utils_Request::retrieve('id', 'Positive', $this);
    $this->_action = CRM_Utils_Request::retrieve('action', 'String',
      $this, FALSE, 'add'
    );

    $this->assign('action', $this->_action);
    $temp = array();
    if($this->_action & CRM_Core_Action::UPDATE) {
      $CUSTOMTemplates = CRM_Core_DAO::executeQuery("SELECT * FROM civicrm_custom_templates WHERE id=". $this->_id);
      while($CUSTOMTemplates->fetch()) {
        $temp[$CUSTOMTemplates->id] = array();
        $temp[$CUSTOMTemplates->id]['msg_title'] = $CUSTOMTemplates->msg_title;
        $temp[$CUSTOMTemplates->id]['msg_template'] = $CUSTOMTemplates->msg_template;
      }
      $this->setDefaults($temp[$this->_id]);
    }


    $cancel = CRM_Utils_System::url('civicrm/admin/customtemplates', "reset=1");
    $cancel = str_replace('&amp;', '&', $cancel);
    $buttons[] = array(
      'type' => 'upload',
      'name' => $this->_action & CRM_Core_Action::DELETE ? ts('Delete') : ts('Save'),
      'isDefault' => TRUE,
    );
    if (!($this->_action & CRM_Core_Action::DELETE)) {
      $buttons[] = array(
        'type' => 'submit',
        'name' => ts('Save and Done'),
        'subName' => 'done',
      );
    }
    $buttons[] = array(
      'type' => 'cancel',
      'name' => ts('Cancel'),
      'js' => array('onclick' => "location.href='{$cancel}'; return false;"),
    );
    $this->addButtons($buttons);

    $breadCrumb = array(
      array(
        'title' => ts('Custom Templates'),
        'url' => CRM_Utils_System::url('civicrm/admin/customtemplates',
          'action=browse&reset=1'
        ),
      ),
    );

    CRM_Utils_System::appendBreadCrumb($breadCrumb);
    $this->applyFilter('__ALL__', 'trim');
    $this->add('text', 'msg_title', ts('Message Title'), CRM_Core_DAO::getAttribute('CRM_Core_DAO_MessageTemplate', 'msg_title'));

    $tokens = CRM_Core_SelectValues::contactTokens();
    CRM_Core_Resources::singleton()->addScriptFile('com.civicrm.custommade01', 'mjml.js');
    $this->assign('tokens', CRM_Utils_Token::formatTokensForDisplay($tokens));

    $this->add('textarea', 'msg_template', ts('MJML Message'),
      "cols=50 rows=6"
    );

    $this->add('wysiwyg', 'msg_html', ts('HTML Message'),
      array(
        'cols' => '80',
        'rows' => '8'
      )
    );

    parent::buildQuickForm();
  }

  public function postProcess() {
    $params = $this->exportValues();

    if ($this->_action & CRM_Core_Action::DELETE) {
      CRM_Custommade01_BAO_CustomTemplates::del($this->_id);
    }
    else {
      $mjmlParams = array();
      if(!empty($this->_id) && $this->_action & CRM_Core_Action::UPDATE) {
        $mjmlParams['id'] = $this->_id;
      }
      foreach (array('msg_title', 'msg_template') as $val) {
        $mjmlParams[$val] = CRM_Utils_Array::value($val, $params);
      }
      CRM_Custommade01_BAO_CustomTemplates::create($mjmlParams);
    }
    CRM_Utils_System::redirect(CRM_Utils_System::url('civicrm/admin/customtemplates', 'reset=1'));
    parent::postProcess();
  }
  
} 
