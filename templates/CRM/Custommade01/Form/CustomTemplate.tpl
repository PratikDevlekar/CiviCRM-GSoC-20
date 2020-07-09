{* HEADER *}
<h3>{if $action eq 1}{ts}New Custom Template{/ts}{elseif $action eq 2}{ts}Edit Custom Template{/ts}{else}{ts}Delete Custom Template{/ts}{/if}</h3>

<div class="crm-block crm-form-block">
<div class="form-item" id="message_templates">
{if $action eq 8}
   <div class="messages status no-popup">
       <div class="icon inform-icon"></div>
       {ts}Do you want to delete this custom template?{/ts}
   </div>
{else}
        <div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="top"}</div>
        <table class="form-layout-compressed">
        <tr>
            <td class="label-left">{$form.msg_title.label}</td>
            <td>{$form.msg_title.html}
                <br /><span class="description html-adjust">{ts}Descriptive title of message - used for template selection.{/ts}</span>
            </td>
        </tr>
        <tr>
           <td class="label-left">{$form.file_type.label}</td>
            <td>{$form.file_type.html}
                <br /><span class="description html-adjust">{ts}Compose a message on-screen for general use in emails or document output, or upload a pre-composed document for mail-merge.{/ts}</span>
            </td>
        </tr>
  </table>
    <div id="msg_mjml_section" class="crm-accordion-wrapper crm-html_email-accordion ">
    <div class="crm-accordion-header">
        {ts}MJML Format{/ts}
        {help id="id-message-text" file="CRM/Contact/Form/Task/Email.hlp"}
    </div><!-- /.crm-accordion-header -->
    <div class="crm-accordion-body">
      <div class="helpIcon" id="helphtml">
        <input class="crm-token-selector big" data-field="msg_template" />
        {help id="id-token-html" tplFile=$tplFile isAdmin=$isAdmin file="CRM/Contact/Form/Task/Email.hlp"}
    </div>
    <div class="clear"></div>
    <div class='html'>
        {$form.msg_template.html|crmAddClass:huge}
        <div class="description">{ts}An HTML formatted version of this message will be sent to contacts whose Email Format preference is 'HTML' or 'Both'.{/ts} {ts 1=$tokenDocsRepeated}Tokens may be included (%1).{/ts}</div>
    </div>
    <button class="crm-button" type="button" id="mjml_to_html">Preview Into HTML</button>
    </div><!-- /.crm-accordion-body -->
  </div><!-- /.crm-accordion-wrapper -->

      <div id="msg_html_section" class="crm-accordion-wrapper crm-html_email-accordion ">
        <div class="crm-accordion-header">
            {ts}HTML Format{/ts}
            {help id="id-message-text" file="CRM/Contact/Form/Task/Email.hlp"}
        </div><!-- /.crm-accordion-header -->
         <div class="crm-accordion-body">
           <div class="helpIcon" id="helphtml">
             <input class="crm-token-selector big" data-field="msg_html" />
             {help id="id-token-html" tplFile=$tplFile isAdmin=$isAdmin file="CRM/Contact/Form/Task/Email.hlp"}
           </div>
                <div class="clear"></div>
                <div class='html'>
                    {$form.msg_html.html|crmAddClass:huge}
                    <div class="description">{ts}An HTML formatted version of this message will be sent to contacts whose Email Format preference is 'HTML' or 'Both'.{/ts} {ts 1=$tokenDocsRepeated}Tokens may be included (%1).{/ts}</div>
                </div>
        </div><!-- /.crm-accordion-body -->
      </div><!-- /.crm-accordion-wrapper -->
  {/if}

  <div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="bottom"}</div>
  <br clear="all" />
</div>
</div> <!-- end of crm-form-block -->
{include file="CRM/Mailing/Form/InsertTokens.tpl"}