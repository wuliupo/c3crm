<div class="span4 mydash" id="{$val.divid}_win"><div class="wrap">
	<h4 class="header">
		{$val.title}
		<span>
			<a href="#" hidefocus="true"><i class="icon-repeat"></i></a>
			<a href="#" hidefocus="true" onclick="hiddenwin('{$val.divid}_win')"><i class="icon-remove"></i></a>
		</span>
	</h4>
	<div class="content" >
		{if $val.type=="text"}
			{foreach from=$val.content item=cont}
				<p>{$cont}</p>
			{/foreach}
		{elseif $val.type=="table"}
			<table class="table table-bordered table-condensed table-striped table-hover">
				<thead>
					{foreach from=$val.thead item=heads}
					<td>{$heads}</td>
					{/foreach}
				</thead>
				<tbody>
					{$val.tbody}
				</tbody>
			</table>
		{else}
			<div id="{$val.divid}">
			<script>highchartss("{$val.categorys}",'{$val.divid}',"{$val.series}","{$val.title}","{$val.type}","{$val.name}");</script>
			</div>
		{/if}
	</div>
</div></div>