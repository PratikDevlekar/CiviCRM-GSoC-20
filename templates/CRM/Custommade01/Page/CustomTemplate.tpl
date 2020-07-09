<div class="crm-content-block crm-block">
  <div id='mainTabContainer'>
    {include file="CRM/common/jsortable.tpl"}
    <div id="user" class='ui-tabs-panel ui-widget-content ui-corner-bottom'>
    <div>
        <div class="action-link">
            {crmButton p='civicrm/admin/customtemplate/add' q="action=add&reset=1" id="newMessageTemplates"  icon="plus-circle"}{ts}Add Custom Template{/ts}{/crmButton}
        </div>
        <div class="spacer"></div>
        {if !empty( $rows) }
            <table class="display">
                <thead>
                    <tr>
                        <th class="sortable">{ts}Message Title{/ts}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                {foreach from=$rows item=row}
                    <tr id="mjml_template-{$row.id}" class="crm-entity">
                        <td>{$row.msg_title}</td>
                        <td>{$row.action|replace:'xx':$row.id}</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        {/if}

            {* <div class="action-link">
            {crmButton p='civicrm/admin/customtemplate/
            add' q="action=add&reset=1" id="newMessageTemplates"  icon="plus-circle"}{ts}Add Message Template{/ts}{/crmButton}
            </div>
            <div class="spacer"></div> *}

        {* {if empty( $rows) }
            <div class="messages status no-popup">
                <div class="icon inform-icon"></div>&nbsp;
                {ts 1=$crmURL}There are no System-Workflow Message Templates entered. You can <a href='%1'>add one</a>.{/ts}
            </div>
        {/if} *}
        </div>
    </div>
  </div>
</div>
