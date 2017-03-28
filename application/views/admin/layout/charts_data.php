<?php
if($this->uri->segment(2)=='users'){ ?>
<script>
	var chart;
	var chartData =<?php if(isset($users_data) && !empty($users_data)){ echo json_encode($users_data);} ?>
	/**
 * AmCharts plugin: automatically color each individual column
 * -----------------------------------------------------------
 * Will apply to graphs that have autoColor: true set
 */
 AmCharts.addInitHandler(function(chart) {
  // check if there are graphs with autoColor: true set
  for(var i = 0; i < chart.graphs.length; i++) {
  	var graph = chart.graphs[i];
  	if (graph.autoColor !== true)
  		continue;
  	var colorKey = "autoColor-"+i;
  	graph.lineColorField = colorKey;
  	graph.fillColorsField = colorKey;
  	for(var x = 0; x < chart.dataProvider.length; x++) {
  		var color = chart.colors[x]
  		chart.dataProvider[x][colorKey] = color;
  	}
  }
  
}, ["serial"]);
 var chart = AmCharts.makeChart("chartdiv", {
 	type: "serial",
 	dataProvider: chartData,
 	categoryField: "country",
 	depth3D: 20,
 	angle: 30,

 	categoryAxis: {
 		labelRotation: 30,
 		tickLength :5,
 		gridPosition: "start",
 		autoGridCount:false,
 		gridCount : 50
 	},

 	valueAxes: [{
 		title: "Total Emails Country Wise",
 		integersOnly :true,
 		minimum : 0,
 		maximum : 10000,
 		tickLength :5,
 		autoGridCount:false,
 		gridCount : 10
 	}],
 	"startDuration": 1,
 	graphs: [{

 		valueField: "emails",
 		autoColor : true,
 		type: "column",
 		lineAlpha: 0,
 		fillAlphas: 1
 	}],

 	chartCursor: {
 		cursorAlpha: 0,
 		zoomable: true,
 		categoryBalloonEnabled: true
 	},
 	"export": {
 		"enabled": true
 	}

 });
</script>

<?php } ?>