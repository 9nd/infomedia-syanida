<div class="container" id="sample-grafik">
<div  class="container">
<div class="row" >

<!--area chart-->
<div class="col-md-4">
    <div class="panel panel-lte" >
		<div class="panel-heading lte-heading-primary">Area Chart</div>
		<div class="panel-body" >
        <canvas id="areaChart" style="height:250px; min-height:250px"></canvas>
		</div>
	</div>
</div>		

<!--donut chart-->
<div class="col-md-4">
	<div class="panel panel-lte"  >
		<div class="panel-heading lte-heading-important">Donut Chart</div>
		<div class="panel-body"  >
		<canvas id="donutChart" style="height:230px; min-height:230px"></canvas>
		</div>
	</div>
</div>	 
 
<!--line chart--> 
<div class="col-md-4">
	<div class="panel panel-lte" >
		<div class="panel-heading lte-heading-danger" >Line Chart</div>
		<div class="panel-body">
		<canvas id="lineChart" style="height:250px; min-height:250px"></canvas>
		</div>
	</div>
</div>	 
</div>
</div>
</div>

<div class="col-md-12 col-xl-12" >
<div class="form-group">
 <label class="form-label">copy code load css dan JS libarary ChartJS:</label>
<textarea id="text-chartjs-css" class="form-control bg-dark text-white" rows="10" readonly></textarea>
</div>			
</div>



<div class="col-md-12 col-xl-12" >
<div class="form-group">
 <label class="form-label">copy code html:</label>
<textarea id="text-code-g1" class="form-control bg-dark text-white" rows="10" readonly></textarea>
</div>	
		

</div>

<div class="col-md-12 col-xl-12" >
<div class="form-group">
 <label class="form-label">copy code javascript:</label>
<textarea id="text-js-g1" class="form-control bg-dark text-white" rows="10" readonly></textarea>
</div>	
<br>
<br>		

</div>


<div class="container" id="sample-grafik-2">
<div  class="container">
<div class="row" >

<!--bar chart -->
<div class="col-md-6">
	<div class="panel panel-lte"  >
		<div class="panel-heading lte-heading-success" >Bar Chart</div>
		<div class="panel-body">
		<canvas id="barChart" style="height:230px; min-height:230px"></canvas>
		</div>
	</div>
</div>	 

<!--pie chart --> 
<div class="col-md-6">
	<div class="panel panel-lte" >
		<div class="panel-heading lte-heading-warning" >Pie Chart</div>
		<div class="panel-body">
		<canvas id="pieChart" style="height:230px; min-height:230px"></canvas>
		</div>
	</div>
</div>	
</div>
</div>
</div>


<div class="col-md-12 col-xl-12" >
<div class="form-group">
 <label class="form-label">copy code load css dan JS libarary ChartJS:</label>
<textarea id="text-chartjs-2-css" class="form-control bg-dark text-white" rows="10" readonly></textarea>
</div>			
</div>
 
<div class="col-md-12 col-xl-12" >
<div class="form-group">
 <label class="form-label">copy code html:</label>
<textarea id="text-code-g2" class="form-control bg-dark text-white" rows="10" readonly></textarea>
</div>			
</div>
<br>

<div class="col-md-12 col-xl-12" >
<div class="form-group">
 <label class="form-label">copy code javascript:</label>
<textarea id="text-js-g2" class="form-control bg-dark text-white" rows="10" readonly></textarea>
</div>	
<br>
<br>		

</div>
  
  
  
 <!-- ChartJS -->
<script src="<?php echo base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>

<script>
	var a = $('#sample-grafik').html().trim();
	$('#text-code-g1').val(a);
	
	var a = "" +
			"<script> \n" +
			"//---area chart---// \n" +
			"  		var areaChartCanvas = $('#areaChart').get(0).getContext('2d') \n	"+
			"		var areaChartData = {\n	"+
			"		  labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],\n	"+
			"		  datasets: [\n	"+
			"			{\n	"+
			"				  	label               : 'Digital Goods',\n	"+
			"				  	backgroundColor     : 'rgba(60,141,188,0.9)',\n	"+
			"					borderColor         : 'rgba(60,141,188,0.8)',\n	"+
			"	  				pointRadius          : false,\n	"+
			"	  				pointColor          : '#3b8bba',\n	"+
			"	  				pointStrokeColor    : 'rgba(60,141,188,1)',\n	"+
			"	  				pointHighlightFill  : '#fff',\n	"+
			"	  				pointHighlightStroke: 'rgba(60,141,188,1)',\n	"+
			"	  				data                : [28, 48, 40, 19, 86, 27, 90]\n	"+
			"			},\n	"+
			"			{\n	"+
			"	  				label               : 'Electronics',\n	"+
			"	  				backgroundColor     : 'rgba(210, 214, 222, 1)',\n	"+
			"	  				borderColor         : 'rgba(210, 214, 222, 1)',\n	"+
			"	  				pointRadius         : false,\n	"+
			"	  				pointColor          : 'rgba(210, 214, 222, 1)',\n	"+
			"	  				pointStrokeColor    : '#c1c7d1',\n	"+
			"	  				pointHighlightFill  : '#fff',\n	"+
			"	  				pointHighlightStroke: 'rgba(220,220,220,1)',\n	"+
			"	  				data                : [65, 59, 80, 81, 56, 55, 40]\n	"+
			"			},\n	"+
			"  					]\n	"+
			" 		}\n\n	"+
			"		var areaChartOptions = {\n	"+
			"  			maintainAspectRatio : false,\n	"+
			"  			responsive : true,\n	"+
			" 			legend: {\n	"+
			"			display: false\n	"+
			"  			},\n	"+
			"  			scales: {\n	"+
			"			xAxes: [{\n	"+
			"	  					gridLines : {\n	"+
			"						display : false,\n	"+
			"	  					}\n	"+
			"					}],\n	"+
			"			yAxes: [{\n	"+
			"	  					gridLines : {\n	"+
			"						display : false,\n	"+
			"	  					}\n	"+
			"					}]\n	"+
			" 					}\n	"+
			" 		}\n	\n"+
			"		var areaChart       = new Chart(areaChartCanvas, {\n	"+ 
			"  		type: 'line',\n	"+
			"  		data: areaChartData,\n	"+ 
			"  		options: areaChartOptions\n	"+
			"		})\n	"+
			"<\/script>\n\n"+
			"\n\n"+
			"<script> \n"+
			"//---donut chart---// \n"+
			"var donutChartCanvas = $('#donutChart').get(0).getContext('2d')\n"+
			"var donutData        = {\n"+
			"  labels: [\n"+
			"	  'Chrome', \n"+
			"	  'IE',\n"+
			"	  'FireFox',\n"+
			"	  'Safari', \n"+
			"	  'Opera', \n"+
			"	  'Navigator', \n"+
			"  ],\n"+
			"  datasets: [\n"+
			"	{\n"+
			"	  data: [700,500,400,600,300,100],\n"+
			"	  backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],\n"+
			"	}\n"+
			"  ]\n"+
			"}\n"+
			"var donutOptions     = {\n"+
			"  maintainAspectRatio : false,\n"+
			"  responsive : true,\n"+
			"}\n"+
			"//Create pie or douhnut chart\n"+
			"// You can switch between pie and douhnut using the method below.\n"+
			"var donutChart = new Chart(donutChartCanvas, {\n"+
			"  type: 'doughnut',\n"+
			"  data: donutData,\n"+
			"  options: donutOptions\n"+      
			"})\n"+
			"\n"+
			"<\/script>\n\n"+
			"\n\n"+
			"<script> \n"+
			"//---line chart---// \n"+
			"		var areaChartData = {\n	"+
			"		  labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],\n	"+
			"		  datasets: [\n	"+
			"			{\n	"+
			"				  	label               : 'Digital Goods',\n	"+
			"				  	backgroundColor     : 'rgba(60,141,188,0.9)',\n	"+
			"					borderColor         : 'rgba(60,141,188,0.8)',\n	"+
			"	  				pointRadius          : false,\n	"+
			"	  				pointColor          : '#3b8bba',\n	"+
			"	  				pointStrokeColor    : 'rgba(60,141,188,1)',\n	"+
			"	  				pointHighlightFill  : '#fff',\n	"+
			"	  				pointHighlightStroke: 'rgba(60,141,188,1)',\n	"+
			"	  				data                : [28, 48, 40, 19, 86, 27, 90]\n	"+
			"			},\n	"+
			"			{\n	"+
			"	  				label               : 'Electronics',\n	"+
			"	  				backgroundColor     : 'rgba(210, 214, 222, 1)',\n	"+
			"	  				borderColor         : 'rgba(210, 214, 222, 1)',\n	"+
			"	  				pointRadius         : false,\n	"+
			"	  				pointColor          : 'rgba(210, 214, 222, 1)',\n	"+
			"	  				pointStrokeColor    : '#c1c7d1',\n	"+
			"	  				pointHighlightFill  : '#fff',\n	"+
			"	  				pointHighlightStroke: 'rgba(220,220,220,1)',\n	"+
			"	  				data                : [65, 59, 80, 81, 56, 55, 40]\n	"+
			"			},\n	"+
			"  					]\n	"+
			" 		}\n\n	"+
			"		var areaChartOptions = {\n	"+
			"  			maintainAspectRatio : false,\n	"+
			"  			responsive : true,\n	"+
			" 			legend: {\n	"+
			"			display: false\n	"+
			"  			},\n	"+
			"  			scales: {\n	"+
			"			xAxes: [{\n	"+
			"	  					gridLines : {\n	"+
			"						display : false,\n	"+
			"	  					}\n	"+
			"					}],\n	"+
			"			yAxes: [{\n	"+
			"	  					gridLines : {\n	"+
			"						display : false,\n	"+
			"	  					}\n	"+
			"					}]\n	"+
			" 					}\n	"+
			" 		}\n	\n"+
			"	var lineChartCanvas = $('#lineChart').get(0).getContext('2d')\n"+
			"	var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)\n"+
			"	var lineChartData = jQuery.extend(true, {}, areaChartData)\n"+
			"	lineChartData.datasets[0].fill = false;\n"+
			"	lineChartData.datasets[1].fill = false;\n"+
			"	lineChartOptions.datasetFill = false\n"+
			"\n"+
			"	var lineChart = new Chart(lineChartCanvas, { \n"+
			"	  type: 'line',\n"+
			"	  data: lineChartData, \n"+
			"	  options: lineChartOptions\n"+
			"	})\n"+
			"\n"+
			"<\/script>\n\n"+
			"\n";
			
			
	
	$('#text-js-g1').val(a);
	
	
	
	
	var a = $('#sample-grafik-2').html().trim();
	$('#text-code-g2').val(a);
	
	
	
	var a = "<script> \n" +
			"//---bar chart---// \n" +
			"		var areaChartData = {\n	"+
			"		  labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],\n	"+
			"		  datasets: [\n	"+
			"			{\n	"+
			"				  	label               : 'Digital Goods',\n	"+
			"				  	backgroundColor     : 'rgba(60,141,188,0.9)',\n	"+
			"					borderColor         : 'rgba(60,141,188,0.8)',\n	"+
			"	  				pointRadius          : false,\n	"+
			"	  				pointColor          : '#3b8bba',\n	"+
			"	  				pointStrokeColor    : 'rgba(60,141,188,1)',\n	"+
			"	  				pointHighlightFill  : '#fff',\n	"+
			"	  				pointHighlightStroke: 'rgba(60,141,188,1)',\n	"+
			"	  				data                : [28, 48, 40, 19, 86, 27, 90]\n	"+
			"			},\n	"+
			"			{\n	"+
			"	  				label               : 'Electronics',\n	"+
			"	  				backgroundColor     : 'rgba(210, 214, 222, 1)',\n	"+
			"	  				borderColor         : 'rgba(210, 214, 222, 1)',\n	"+
			"	  				pointRadius         : false,\n	"+
			"	  				pointColor          : 'rgba(210, 214, 222, 1)',\n	"+
			"	  				pointStrokeColor    : '#c1c7d1',\n	"+
			"	  				pointHighlightFill  : '#fff',\n	"+
			"	  				pointHighlightStroke: 'rgba(220,220,220,1)',\n	"+
			"	  				data                : [65, 59, 80, 81, 56, 55, 40]\n	"+
			"			},\n	"+
			"  					]\n	"+
			" 		}\n\n	"+
			"	var barChartCanvas = $('#barChart').get(0).getContext('2d')\n"+
			"	var barChartData = jQuery.extend(true, {}, areaChartData)\n"+
			"	var temp0 = areaChartData.datasets[0]\n"+
			"	var temp1 = areaChartData.datasets[1]\n"+
			"	barChartData.datasets[0] = temp1\n"+
			"	barChartData.datasets[1] = temp0\n"+
			"\n"+
			"	var barChartOptions = {\n"+
			"	  responsive              : true,\n"+
			"	  maintainAspectRatio     : false,\n"+
			"	  datasetFill             : false\n"+
			"	}\n"+
			"\n"+
			"	var barChart = new Chart(barChartCanvas, {\n"+
			"	  type: 'bar', \n"+
			"	  data: barChartData,\n"+
			"	  options: barChartOptions\n"+
			"	})\n"+
			"<\/script>\n\n"+
			"\n"+
			"<script> \n" +
			"//---pie chart---// \n" +
			"var donutData        = {\n"+
			"  labels: [\n"+
			"	  'Chrome', \n"+
			"	  'IE',\n"+
			"	  'FireFox',\n"+
			"	  'Safari', \n"+
			"	  'Opera', \n"+
			"	  'Navigator', \n"+
			"  ],\n"+
			"  datasets: [\n"+
			"	{\n"+
			"	  data: [700,500,400,600,300,100],\n"+
			"	  backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],\n"+
			"	}\n"+
			"  ]\n"+
			"}\n"+
			"	var pieChartCanvas = $('#pieChart').get(0).getContext('2d')\n"+
			"	var pieData        = donutData;\n"+
			"	var pieOptions     = {\n"+
			"	  maintainAspectRatio : false,\n"+
			"	  responsive : true,\n"+
			"	}\n"+
			"	//Create pie or douhnut chart\n"+
			"	// You can switch between pie and douhnut using the method below.\n"+
			"	var pieChart = new Chart(pieChartCanvas, {\n"+
			"	  type: 'pie',\n"+
			"	  data: pieData,\n"+
			"	  options: pieOptions      \n"+
			"	})\n"+
			"\n"+
			"<\/script>\n\n"+
			"";
	$('#text-js-g2').val(a);
	
	
	
	
	var a = '<\!-- load css Chart JS--\> \n'+
		'<\!-- tempatkan code ini pada top page view--\>\n'+
		'<\?php echo _css("chartjs")\?> \n' +
		'\n'+
		'\n'+
		'<\!-- load library Chart JS --\> \n'+
		'<\!-- tempatkan code ini pada akhir code html sebelum masuk tag script--\>\n'+
		'<\?php echo _js("chartjs")\?> \n' +
		'';
	$('#text-chartjs-css').val(a);
	$('#text-chartjs-2-css').val(a);
	
	
	
</script>



<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas, { 
      type: 'line',
      data: areaChartData, 
      options: areaChartOptions
    })

	
	
	
	
	 //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome', 
          'IE',
          'FireFox', 
          'Safari', 
          'Opera', 
          'Navigator', 
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })
	
	
	  //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })
	
	
	 //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })
	
	
	
	 //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })
	
   
  })
</script>
