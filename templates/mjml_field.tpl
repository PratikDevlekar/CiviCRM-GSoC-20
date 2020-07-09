
<div class="crm-accordion-wrapper crm-mjml_email-accordion" id="mjml_accordian">
  <div class="crm-accordion-header">
      {ts}MJML Format{/ts}
      {help id="id-message-text" file="CRM/Contact/Form/Task/Email.hlp"}
  </div><!-- /.crm-accordion-header -->
 <div class="crm-accordion-body" style="display: block;">
  <div class="helpIcon" id="helpmjml">
    <input class="crm-token-selector big" data-field="mjml_message" />
  </div>
  <div class="clear"></div>
    <div>
      {$form.mjml_message.html}<br />
    </div>
    <div>
    <a id='preview' class='button crm-popup'>Preview</a></div>
    <div class="clear"></div>
  </div><!-- /.crm-accordion-body -->

</div><!-- /.crm-accordion-wrapper -->
<script type="text/javascript" src="{$extURL}/packages/codemirror/lib/codemirror.js"></script>
<link rel="stylesheet" href="{$extURL}/packages/codemirror/lib/codemirror.css">
<link rel="stylesheet" href="{$extURL}/packages/codemirror/theme/elegant.css">
{include file="CRM/Mailing/Form/InsertTokens.tpl"} 
