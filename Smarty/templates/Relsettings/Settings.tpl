<!--	dree	-->
<link href="themes/bootcss/css/Setting.css" type="text/css" rel="stylesheet" />
<!--Dashboad-->
<div class="container-fluid clearfix">
	<div class="row-fluid">
		<div class="span2" style="margin-left:-10px;">
			<div class="accordion clearfix" id="settingion1">
				{include file='Relsettings/SettingLeft.tpl'}
			</div>
		</div>
		<div class="span10">
			<!--	Setting		-->
			<div class="row-fluid box" clearfix">
				<div class="tab-header">{$RELSETHEAD}</div>
				  <div class="padded">
						<form action="index.php" method="post" name="relsetform" id="relsetform">
							<input type="hidden" name="module" value="Relsettings">
							<input type="hidden" name="action">
							<input type="hidden" name="parenttab" value="Settings">
							<input type="hidden" name="relset" value="{$RELSET}">
							<input type="hidden" name="relsetmode" value="{$RELSETMODE}">
							<input type="hidden" name="issubmit" value="1">
							{if $RELSET == 'EmailConfig'}
								{include file='Relsettings/EmailConfig.tpl'}
							{elseif $RELSET == 'MessageConfig'}
								{include file='Relsettings/MessageConfig.tpl'}
							{elseif $RELSET == 'MemdayConfig'}
								{include file='Relsettings/MemdayConfig.tpl'}
							{elseif $RELSET == 'EditPwd'}
								{include file='Relsettings/EditPwd.tpl'}
							{elseif $RELSET == 'EditMoreInfo'}
								{include file='Relsettings/EditMoreInfo.tpl'}
							{elseif $RELSET == 'MailLogs'}
								{include file='Relsettings/MailLogs.tpl'}
							{elseif $RELSET == 'SmsLogs'}
								{include file='Relsettings/SmsLogs.tpl'}
							{elseif $RELSET == 'Taobaozushou'}
								{include file='Relsettings/Taobaozushou.tpl'}
							{elseif $RELSET == 'SmsAccount'}
								{include file='Relsettings/SmsAccount.tpl'}
							{/if}
						</form>
				  </div>
			</div>
		</div>
		<!--	/Setting	-->
	</div>
</div>