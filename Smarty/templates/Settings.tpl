<div class="container-fluid clearfix">
	<div class="row-fluid">
		<div class="span2" style="margin-left:-10px;">
			<div class="accordion clearfix" id="settingion1">
				{include file='Settings/SettingLeft.tpl'}
			</div>
		</div>
		<div class="span10">
			<!--	Setting		-->
			<div class="row-fluid box clearfix">
				<div class="tab-header">
					{$RELSETHEAD}
				</div>
				  <div class="padded clearfix">
						<form action="index.php" method="post" name="settingform" id="settingform">
							<input type="hidden" name="module" value="Settings">
							<input type="hidden" name="action">
							<input type="hidden" name="parenttab" value="Settings">
							<input type="hidden" name="settype" value="{$SETTYPE}">
							<input type="hidden" name="settingmode" value="{$SETTINGMODE}">
							<input type="hidden" name="issubmit" value="1">
							{if $SETTYPE == 'SmsUser'}
								{include file='Settings/SmsUser.tpl'}
							{elseif $SETTYPE == 'CustomBlockList'}
								{include file='Settings/CustomBlockList.tpl'}
							{/if}
						</form>
				  </div>
			</div>
		</div>
		<!--	/Setting	-->
	</div>
</div>