<form name="uploadform" method="POST" ENCTYPE="multipart/form-data" action="uploadfileInfo.php" style="margin:0px">
<input type="hidden" name="module" value="Maillists">
<input type="hidden" name="action" value="uploadfileInfo">
<input type="hidden" name="record" value="">
<input id="viewname" name="viewname" type="hidden" value="">
<!-- List View Master Holder starts -->
<div class="row-fluid">
<table class="span2 table table-bordered table-hover table-condensed table-striped">
<tbody>
<tr>
<td>
<font color="red">注意：请先根据cron/readme.txt说明设置群发邮件任务计划，云商店会自动设置，每三分钟发一次，每次100封邮件.</font><br>
1.选择分组，添加该分组所有客户至接收人Email。<br>
2.如果没有你需要的分组，可自行创建新分组。<br>
3.群发前，请先到<b>控制面板</b>-><b>相关设置</b>中设置SMTP服务器。<br>
4.群发前，请先到客户中创建一个自己的客户，再修改测试分组中会员名，测试发送给自己。<br>
5.邮件为空的用户,不显示。<br>
6.邮件发送结束后，可点击<a href="index.php?action=Maillists&module=Relsettings">群发统计</a>查看发送情况。<br>
7.如果不能配置cron服务，可点击<a href="dosendmail.php">手工发送</a>。
</td>
</tr>
</tbody>
</table>
<table class="span3 table table-bordered table-hover table-condensed table-striped">
<tbody>
<tr>
<td>
<h5>接收人Email</h5>
<font color="#808080">每行一个邮件</font>
</td>
</tr>
<tr>
<td >
<textarea style="line-height: 150%;width: 96%; height: 380px;" cols="35" name="dst" rows="8" id="receiveaccountinfo"  >{$receiveaccountinfo}</textarea>
</td>
</tr>
</tbody>
</table>
<table class="span7 table table-bordered table-hover table-condensed table-striped">
<tbody>
<tr><td><h5>邮件信息</h5></td></tr>
<tr>
<td>
<b>发&nbsp;&nbsp;件&nbsp;&nbsp;人：&nbsp;
<font color=red>{if $from_name neq ''}"{$from_name}"{/if} &nbsp;
{if $from_email neq ''}({$from_email}){/if}</font></b> 
<input name="from_name" id="from_name" value="{$from_name}" type="hidden">
<input name="from_email" id="from_email" value="{$from_email}" type="hidden">
</td>
</tr>
<tr>
<td>
<b>邮件主题：</b><input name="subject" type="text" id="subject" class="txtBox" value="">
<input title="选择Email模版" class="btn btn-small btn-primary" onclick="SelectTmp();" type="button" name="button" value=" 选择Email模版  ">
<input class="btn btn-small btn-primary" type="button" onclick="CreateTmp();" name="profile" value="新增模版">
</td>
</tr>
<tr>
<td valign="top" >
<p align="left">
<b> 邮件内容：</b>
<br />
<textarea rows="15"  name="mailcontent" id="mailcontent" style="width:100%;height:275px;"></textarea>
</p>
<input type="button" name="savebutton" id="savebutton" value="&nbsp;&nbsp;&nbsp;&nbsp;群发&nbsp;&nbsp;&nbsp;&nbsp; "   class="btn btn-primary" onclick="SendMailToAll('Maillists','{$sjid}','KE');return false;" />
</td>
</tr>
<tr>
<td>
<input type="hidden" value="{$sjid}" name="sjid" id="sjid" />
</td>
</tr>
</tbody>
</table>
</div>
</form>
