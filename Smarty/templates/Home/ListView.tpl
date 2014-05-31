<!-- highcharts plugin-->
<script src="include/js/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
	function highchartss(category,divid,series,title,type,name){ldelim}
		var chart;
		var cat_arr = new Array();
		cat_arr = category.split(",");
		if(type.split(",").length>1){ldelim}
			type = type.split(",");
			series = series.split("_");
			name = name.split(",");
			$(document).ready(function() {ldelim}
			var colors = Highcharts.getOptions().colors,
					categories = cat_arr,
				chart = new Highcharts.Chart({ldelim}
					chart: {ldelim}
						//renderTo: 'container',
						renderTo:divid,
						height:210,
						inverted: false  //左右显示，默认上下正向。假如设置为true，则横纵坐标调换位置
					{rdelim},
					title: {ldelim}
						text: title
						{rdelim},
					xAxis: {ldelim}
						categories: categories,
						labels: {ldelim}
							rotation: 0   //坐标值显示的倾斜度
						{rdelim}
					{rdelim},
					yAxis: [{ldelim}
						min: 0,
						title: {ldelim}
							text: '数值(元)'
						{rdelim}
					{rdelim},{ldelim}
						min:0,
						title:{ldelim}
							text:"数值(个)"
						{rdelim},
						opposite:true
					{rdelim}
					],
					plotOptions: {ldelim}
						pie: {ldelim}
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {ldelim}
								enabled: true,
								color: '#000000',
								connectorColor: '#000000',
								formatter: function() {ldelim}
									return '<b>'+ this.point.name +'</b>: '+ this.y ;
								{rdelim}
							{rdelim}
						{rdelim}
					{rdelim},
					tooltip: {ldelim}
						crosshairs: true,
						formatter: function() {ldelim}
							var s;
							if (type == 'pie') {ldelim}// the pie chart
								s = ''+
									this.point.name + ': '+ this.percentage +' %';
							{rdelim} else {ldelim}
								s = ''+
									this.x  +': '+ this.y;
							{rdelim}
							return s;
						{rdelim}
					{rdelim},
					series:[{ldelim}
						name:name[0],
						type:type[0],
						data:eval("["+series[0]+"]")
					{rdelim},
					{ldelim}
						name:name[1],
						type:type[1],
						data:eval("["+series[1]+"]"),
						yAxis: 1
					{rdelim}]
				{rdelim});
		  {rdelim});
	  {rdelim}
	  else{ldelim}
			$(document).ready(function() {ldelim}
			var colors = Highcharts.getOptions().colors,
					categories = cat_arr,
				chart = new Highcharts.Chart({ldelim}
					chart: {ldelim}
						renderTo:divid,
						height:210,
						inverted: false  //左右显示，默认上下正向。假如设置为true，则横纵坐标调换位置
					{rdelim},
					title: {ldelim}
						text: title
						{rdelim},
					xAxis: {ldelim}
						categories: categories,
						labels: {ldelim}
							rotation: 0   //坐标值显示的倾斜度
						{rdelim}
					{rdelim},
					yAxis: {ldelim}
						min: 0,
						title: {ldelim}
							text: '数值(元)'
						{rdelim}
					{rdelim}
					,
					plotOptions: {ldelim}
						pie: {ldelim}
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {ldelim}
								enabled: true,
								color: '#000000',
								connectorColor: '#000000',
								formatter: function() {ldelim}
									return '<b>'+ this.point.name +'</b>: '+ this.y ;
								{rdelim}
							{rdelim}
						{rdelim}
					{rdelim},
					tooltip: {ldelim}
						crosshairs: true,
						formatter: function() {ldelim}
							var s;
							if (type == 'pie') {ldelim}// the pie chart
								s = ''+
									this.point.name + ': '+ this.percentage +' %';
							{rdelim} else {ldelim}
								s = ''+
									this.x  +': '+ this.y;
							{rdelim}
							return s;
						{rdelim}
					{rdelim},
					series:[{ldelim}
						name:name,
						type:type,
						data:eval("["+series+"]")
					{rdelim}
					]
				{rdelim});
		  {rdelim});
	  {rdelim}
	 {rdelim}
</script>
<!-- Contents Start-->
<div class="portal-container clearfix"  >
	<div class="summary">
		<div class="datalist clearfix">
			<ul>
				<li>
					<h3>本周新增客户数</h3>
					<h4 class="up">{$DAYTOTAL}</h4>
					<div class="data">
						<p>
							较上周：
							<span>
							{if $ACCOUNTUPDOWN=="U"}
							<i class="icon-arrow-up"></i>
							{else}
							<i class="icon-arrow-down"></i>
							{/if}
							{$ACCOUNTPERCENT}
							</span>
						</p>
					</div>
				</li>
				<li >
					<h3>本周新增联系记录数</h3>
					<h4>{$WEEKNEWNOTES}</h4>
					<div class="data">
						<p>
							较上周：<span>
							{if $NOTESUPDOWN=="U"}
							<i class="icon-arrow-up"></i>
							{else}
							<i class="icon-arrow-down"></i>
							{/if}
							{$NOTESPERCENT}</span>
						</p>
					</div>
				</li>
				<li style="border-right:1px solid #ededed;margin-left:-12px">
					<h3>本周订单成交量</h3>
					<h4 class="up">{$ORDERCOUNT}</h4>
					<div class="data">
						<p>
							较上周：
							<span>
							{if $ORDERCOUNTUPDOWN=="D"}
							<i class="icon-arrow-down"></i>
							{else}
							<i class="icon-arrow-up"></i>
							{/if}
							{$ORDERCOUNTPERCENT}
							</span>
						</p>
					</div>
				</li>
				<li>
					<h3>本周订单成交金额</h3>
					<h4 class="up">{$MONTHDEALORDER}</h4>
					<div class="data">
						<p>
							较上周：
							<span>
							{if $ORDERUPDOWN=="D"}
							<i class="icon-arrow-down"></i>
							{else}
							<i class="icon-arrow-up"></i>
							{/if}
							{$ORDERPERCENT}
							</span>
						</p>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div class="dash-container clearfix" >
{foreach from =$MYDASHBOARD item=val}
	{include file="Home/MainHomeBlock.tpl"}
{/foreach}
	</div>
</div>