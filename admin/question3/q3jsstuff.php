<?php
// Starting the session, to use and
// store data in session variable
session_start();
// If the session variable is empty, this
// means the user is yet to login
// User will be sent to 'login.php' page
// to allow the user to login
if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You have to log in first";
	header('location: ../../login.php');
}
// Logout button will destroy the session, and
// will unset the session variables
// User will be headed to 'login.php'
// after loggin out
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: ../../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="../../indexstyle.css">
<link rel="stylesheet" type="text/css" href="style.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<title>CHARTS</title>

</head>

<body>

	<div class="sidenav">

		<!-- paroxous kai kathe yporerwthma-->

		<button class="dropdown-btn">Vodafone</i></button>
	  <div class="dropdown-container">
			<button class="dropdown-btn" onclick="histogramVodafone()">Ερώτημα1</button>
			<button class="dropdown-btn" onclick="stalefreshVodafone()">Ερώτημα2</button>
			<button class="dropdown-btn" onclick="cacheabilityVodafone()">Ερώτημα3</button>
	  </div>

		<button class="dropdown-btn">Cosmote</button>
	  <div class="dropdown-container">
			<button class="dropdown-btn" onclick="histogramCosmote()">Ερώτημα1</button>
	    <button class="dropdown-btn" onclick="stalefreshCosmote()">Ερώτημα2</button>
			<button class="dropdown-btn" onclick="cacheabilityCosmote()">Ερώτημα3</button>
	  </div>

		<button class="dropdown-btn">Wind</button>
	  <div class="dropdown-container">
			<button class="dropdown-btn" onclick="histogramWind()">Ερώτημα1</button>
	    <button class="dropdown-btn" onclick="stalefreshWind()">Ερώτημα2</button>
			<button class="dropdown-btn" onclick="cacheabilityWind()">Ερώτημα3</button>
	  </div>

		<button class="dropdown-btn">Forthnet</button>
	  <div class="dropdown-container">
			<button class="dropdown-btn" onclick="histogramForthet()">Ερώτημα1</button>
	    <button class="dropdown-btn" onclick="stalefreshForthet()">Ερώτημα2</button>
			<button class="dropdown-btn" onclick="cacheabilityForthet()">Ερώτημα3</button>
	  </div>

		<button class="dropdown-btn">Όλοι Πάροχοι</button>
	  <div class="dropdown-container">
			<button class="dropdown-btn" onclick="histogram()">Ερώτημα1</button>
	    <button class="dropdown-btn" onclick="stalefresh()">Ερώτημα2</button>
			<button class="dropdown-btn" onclick="cacheability()">Ερώτημα3</button>
	  </div>

    <a href="../../admin.php">Home Page</a>
</div>


<div class="main">

	<div id="DIVVodafone1" hidden>
		<div id="chart_div" style="width: 900px; height: 500px;"></div>
	</div>
	<div id="DIVVodafone2" hidden>
		<canvas id="ctxV1" class="doughnutL"></canvas>
		<canvas id="ctxV2" class="doughnutR"></canvas>
	</div>
	<div id="DIVVodafone3" hidden>
		<canvas id="ctxVo1" class="doughnutL"></canvas>
		<canvas id="ctxVo2" class="doughnutR"></canvas>
		<canvas id="ctxVo3" class="doughnutL"></canvas>
		<canvas id="ctxVo4" class="doughnutR"></canvas>
	</div>

	<div id="DIVCosmote1" hidden>

	</div>
	<div id="DIVCosmote2" hidden>
		<canvas id="ctxCo1" class="doughnutL"></canvas>
		<canvas id="ctxCo2" class="doughnutR"></canvas>

	</div>
	<div id="DIVCosmote3" hidden>
		<canvas id="ctxC1" class="doughnutL"></canvas>
		<canvas id="ctxC2" class="doughnutR"></canvas>
		<canvas id="ctxC3" class="doughnutL"></canvas>
		<canvas id="ctxC4" class="doughnutR"></canvas>
	</div>

	<div id="DIVWind1" hidden>

	</div>
	<div id="DIVWind2" hidden>
		<canvas id="ctxWi1" class="doughnutL"></canvas>
		<canvas id="ctxWi2" class="doughnutR"></canvas>

	</div>
	<div id="DIVWind3" hidden>
		<canvas id="ctxW1" class="doughnutL"></canvas>
		<canvas id="ctxW2" class="doughnutR"></canvas>
		<canvas id="ctxW3" class="doughnutL"></canvas>
		<canvas id="ctxW4" class="doughnutR"></canvas>
	</div>

	<div id="DIVForthet1" hidden>

	</div>
	<div id="DIVForthet2" hidden>
		<canvas id="ctxThne1" class="doughnutL"></canvas>
		<canvas id="ctxThne2" class="doughnutR"></canvas>

	</div>
	<div id="DIVForthet3" hidden>
		<canvas id="ctxFor1" class="doughnutL"></canvas>
		<canvas id="ctxFor2" class="doughnutR"></canvas>
		<canvas id="ctxFor3" class="doughnutL"></canvas>
		<canvas id="ctxFor4" class="doughnutR"></canvas>
	</div>


	<div id="DIV1" hidden>
		<div id="chart_div" style="width: 900px; height: 500px;"></div>
	</div>
	<div id="DIV2" hidden>
		<canvas id="ctx1" class="doughnutL"></canvas>
		<canvas id="ctx2" class="doughnutR"></canvas>
	</div>

	<div id="DIV3" hidden>
		<canvas id="ctx_1" class="doughnutL"></canvas>
		<canvas id="ctx_2" class="doughnutR"></canvas>
		<canvas id="ctx_3" class="doughnutL"></canvas>
		<canvas id="ctx_4" class="doughnutR"></canvas>
	</div>

</div>





<script>

/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}


function  histogramVodafone(){
	document.getElementById("DIVVodafone1").hidden = false;
	document.getElementById("DIVVodafone2").hidden = true;
	document.getElementById("DIVVodafone3").hidden = true;

	document.getElementById("DIVCosmote1").hidden = true;
	document.getElementById("DIVCosmote2").hidden = true;
  document.getElementById("DIVCosmote3").hidden = true;

	document.getElementById("DIVWind1").hidden = true;
	document.getElementById("DIVWind2").hidden = true;
  document.getElementById("DIVWind3").hidden = true;

	document.getElementById("DIVForthet1").hidden = true;
	document.getElementById("DIVForthet2").hidden = true;
  document.getElementById("DIVForthet3").hidden = true;

	document.getElementById("DIV1").hidden = true;
	document.getElementById("DIV2").hidden = true;
  document.getElementById("DIV3").hidden = true;

$(document).ready(function(){
		$.get("q3b_serverstuff.php", function(data, status){
			//obj = JSON.parse(data);
			//console.log(obj);



			google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	          ['MyData', 'Value']
	                    , ['whatevs', .3]
	                    , ['whatevs', .57]
	                    , ['whatevs', 1.2]
	                    , ['whatevs', 1.8]
											 , ['whatevs', 2.3]
											  , ['whatevs', 2.57]
												 , ['whatevs', 3.3]
												  , ['whatevs', 3.57]
													 , ['whatevs', 4.3]
													  , ['whatevs', 4.57]
														 , ['whatevs', .57]
														  , ['whatevs', .57]
															 , ['whatevs', .57]
															  , ['whatevs', .57]
																 , ['whatevs', .57]
																  , ['whatevs', .57]
																	 , ['whatevs', .57]
																	  , ['whatevs', .57]
																		 , ['whatevs', .57]
																		  , ['whatevs', .57]
																			 , ['whatevs', .57]
																			  , ['whatevs', .57]
																				 , ['whatevs', .57] , ['whatevs', 5.57]
																				  , ['whatevs', .57]
																					 , ['whatevs', .57]


	                    ]);

	        var options = {
	          title: 'My Histogram'
	          , legend: { position: 'none' }
	                    , histogram: {

													 maxBuckets: 10
	                    }
	        };

	        var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
	        chart.draw(data, options);
	      }





});
});
};

function  histogramCosmote(){};
function  histogramWind(){};
function  histogramForthet(){};
function  histogram(){};
//telos prwtou erwthmatos-------------------------------------------------------




//arxh deuterou erwthmatos:-----------------------------------------------------

function  stalefreshVodafone(){
	document.getElementById("DIVVodafone1").hidden = true;
	document.getElementById("DIVVodafone2").hidden = false;
	document.getElementById("DIVVodafone3").hidden = true;

	document.getElementById("DIVCosmote1").hidden = true;
	document.getElementById("DIVCosmote2").hidden = true;
  document.getElementById("DIVCosmote3").hidden = true;

	document.getElementById("DIVWind1").hidden = true;
	document.getElementById("DIVWind2").hidden = true;
  document.getElementById("DIVWind3").hidden = true;

	document.getElementById("DIVForthet1").hidden = true;
	document.getElementById("DIVForthet2").hidden = true;
  document.getElementById("DIVForthet3").hidden = true;

	document.getElementById("DIV1").hidden = true;
	document.getElementById("DIV2").hidden = true;
  document.getElementById("DIV3").hidden = true;

	$(document).ready(function(){
			$.get("q3b_serverstuff.php", {number:1} , function(data, status){
				obj = JSON.parse(data);
				console.log(obj);
				console.log(obj[0].fresh_percentage);
				console.log(obj[0].ContentType_fre);

				var myDoughnutChart = new Chart(ctxV1, {
				    type: 'doughnut',
				    data:{
				      datasets:[{
				        data:[],
				        backgroundColor:[]

				      }],
				      labels:[]

				    },
				    options: {
				       responsive: false,
				       legend: {
				          position: 'bottom' //place legend on the right side of chart
				       }, title: {
				            display: true,
				            text: 'Fresh'
				        }

				    }
				});

				var myDoughnutChart1 = new Chart(ctxV2, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
				            display: true,
				            text: 'Stale'
				        }

						}
				});

				function addData(chart, label, data, color) {
				    chart.data.labels.push(label);
				    chart.data.datasets.forEach((dataset) => {
				        dataset.data.push(data);
				        dataset.backgroundColor.push(color);
				    });
				    chart.update();
				}

				var endoftime=obj.length;

				for (var i = 0; i < endoftime; i++) {
				  r = Math.floor(Math.random() * 200);
				g = Math.floor(Math.random() * 200);
				b = Math.floor(Math.random() * 200);
				color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
				    addData(myDoughnutChart, obj[i].ContentType_fre, obj[i].fresh_percentage,color);
						addData(myDoughnutChart1, obj[i].ContentType_sta, obj[i].stale_percentage,color);
				     console.log(obj[i].fresh_percentage);
				    console.log(obj[i].ContentType_fre);
				     console.log(color);
				  }






})
})
};

function  stalefreshCosmote(){
	document.getElementById("DIVVodafone1").hidden = true;
	document.getElementById("DIVVodafone2").hidden = true;
	document.getElementById("DIVVodafone3").hidden = true;

	document.getElementById("DIVCosmote1").hidden = true;
	document.getElementById("DIVCosmote2").hidden = false;
  document.getElementById("DIVCosmote3").hidden = true;

	document.getElementById("DIVWind1").hidden = true;
	document.getElementById("DIVWind2").hidden = true;
  document.getElementById("DIVWind3").hidden = true;

	document.getElementById("DIVForthet1").hidden = true;
	document.getElementById("DIVForthet2").hidden = true;
  document.getElementById("DIVForthet3").hidden = true;

	document.getElementById("DIV1").hidden = true;
	document.getElementById("DIV2").hidden = true;
  document.getElementById("DIV3").hidden = true;

	$(document).ready(function(){
			$.get("q3b_serverstuff.php", {number:2} , function(data, status){
				obj = JSON.parse(data);
				console.log(obj);
				console.log(obj[0].fresh_percentage);
				console.log(obj[0].ContentType_fre);

				var myDoughnutChart = new Chart(ctxCo1, {
				    type: 'doughnut',
				    data:{
				      datasets:[{
				        data:[],
				        backgroundColor:[]

				      }],
				      labels:[]

				    },
				    options: {
				       responsive: false,
				       legend: {
				          position: 'bottom' //place legend on the right side of chart
				       }, title: {
				            display: true,
				            text: 'Fresh'
				        }

				    }
				});

				var myDoughnutChart1 = new Chart(ctxCo2, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
				            display: true,
				            text: 'Stale'
				        }

						}
				});

				function addData(chart, label, data, color) {
				    chart.data.labels.push(label);
				    chart.data.datasets.forEach((dataset) => {
				        dataset.data.push(data);
				        dataset.backgroundColor.push(color);
				    });
				    chart.update();
				}

				var endoftime=obj.length;

				for (var i = 0; i < endoftime; i++) {
				  r = Math.floor(Math.random() * 200);
				g = Math.floor(Math.random() * 200);
				b = Math.floor(Math.random() * 200);
				color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
				    addData(myDoughnutChart, obj[i].ContentType_fre, obj[i].fresh_percentage,color);
						addData(myDoughnutChart1, obj[i].ContentType_sta, obj[i].stale_percentage,color);
				     console.log(obj[i].fresh_percentage);
				    console.log(obj[i].ContentType_fre);
				     console.log(color);
				  }






})
})
};//telos stale/fresh Cosmote

function  stalefreshWind(){
	document.getElementById("DIVVodafone1").hidden = true;
	document.getElementById("DIVVodafone2").hidden = true;
	document.getElementById("DIVVodafone3").hidden = true;

	document.getElementById("DIVCosmote1").hidden = true;
	document.getElementById("DIVCosmote2").hidden = true;
  document.getElementById("DIVCosmote3").hidden = true;

	document.getElementById("DIVWind1").hidden = true;
	document.getElementById("DIVWind2").hidden = false;
  document.getElementById("DIVWind3").hidden = true;

	document.getElementById("DIVForthet1").hidden = true;
	document.getElementById("DIVForthet2").hidden = true;
  document.getElementById("DIVForthet3").hidden = true;

	document.getElementById("DIV1").hidden = true;
	document.getElementById("DIV2").hidden = true;
  document.getElementById("DIV3").hidden = true;

	$(document).ready(function(){
			$.get("q3b_serverstuff.php", {number:3} , function(data, status){
				obj = JSON.parse(data);
				console.log(obj);
				console.log(obj[0].fresh_percentage);
				console.log(obj[0].ContentType_fre);

				var myDoughnutChart = new Chart(ctxWi1, {
				    type: 'doughnut',
				    data:{
				      datasets:[{
				        data:[],
				        backgroundColor:[]

				      }],
				      labels:[]

				    },
				    options: {
				       responsive: false,
				       legend: {
				          position: 'bottom' //place legend on the right side of chart
				       }, title: {
				            display: true,
				            text: 'Fresh'
				        }

				    }
				});

				var myDoughnutChart1 = new Chart(ctxWi2, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
				            display: true,
				            text: 'Stale'
				        }

						}
				});

				function addData(chart, label, data, color) {
				    chart.data.labels.push(label);
				    chart.data.datasets.forEach((dataset) => {
				        dataset.data.push(data);
				        dataset.backgroundColor.push(color);
				    });
				    chart.update();
				}

				var endoftime=obj.length;

				for (var i = 0; i < endoftime; i++) {
				  r = Math.floor(Math.random() * 200);
				g = Math.floor(Math.random() * 200);
				b = Math.floor(Math.random() * 200);
				color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
				    addData(myDoughnutChart, obj[i].ContentType_fre, obj[i].fresh_percentage,color);
						addData(myDoughnutChart1, obj[i].ContentType_sta, obj[i].stale_percentage,color);
				     console.log(obj[i].fresh_percentage);
				    console.log(obj[i].ContentType_fre);
				     console.log(color);
				  }






})
})//telos stale/fresh Wind
};

function  stalefreshForthet(){
	document.getElementById("DIVVodafone1").hidden = true;
	document.getElementById("DIVVodafone2").hidden = true;
	document.getElementById("DIVVodafone3").hidden = true;

	document.getElementById("DIVCosmote1").hidden = true;
	document.getElementById("DIVCosmote2").hidden = true;
	document.getElementById("DIVCosmote3").hidden = true;

	document.getElementById("DIVWind1").hidden = true;
	document.getElementById("DIVWind2").hidden = true;
	document.getElementById("DIVWind3").hidden = true;

	document.getElementById("DIVForthet1").hidden = true;
	document.getElementById("DIVForthet2").hidden = false;
	document.getElementById("DIVForthet3").hidden = true;

	document.getElementById("DIV1").hidden = true;
	document.getElementById("DIV2").hidden = true;
	document.getElementById("DIV3").hidden = true;

	$(document).ready(function(){
			$.get("q3b_serverstuff.php", {number:4} , function(data, status){
				obj = JSON.parse(data);
				console.log(obj);
				console.log(obj[0].fresh_percentage);
				console.log(obj[0].ContentType_fre);

				var myDoughnutChart = new Chart(ctxThne1, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'Fresh'
								}

						}
				});

				var myDoughnutChart1 = new Chart(ctxThne2, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'Stale'
								}

						}
				});

				function addData(chart, label, data, color) {
						chart.data.labels.push(label);
						chart.data.datasets.forEach((dataset) => {
								dataset.data.push(data);
								dataset.backgroundColor.push(color);
						});
						chart.update();
				}

				var endoftime=obj.length;

				for (var i = 0; i < endoftime; i++) {
					r = Math.floor(Math.random() * 200);
				g = Math.floor(Math.random() * 200);
				b = Math.floor(Math.random() * 200);
				color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
						addData(myDoughnutChart, obj[i].ContentType_fre, obj[i].fresh_percentage,color);
						addData(myDoughnutChart1, obj[i].ContentType_sta, obj[i].stale_percentage,color);
						 console.log(obj[i].fresh_percentage);
						console.log(obj[i].ContentType_fre);
						 console.log(color);
					}






})
})//telos stale/fresh gia Forthnet
};

function  stalefresh(){
	document.getElementById("DIVVodafone1").hidden = true;
	document.getElementById("DIVVodafone2").hidden = true;
	document.getElementById("DIVVodafone3").hidden = true;

	document.getElementById("DIVCosmote1").hidden = true;
	document.getElementById("DIVCosmote2").hidden = true;
  document.getElementById("DIVCosmote3").hidden = true;

	document.getElementById("DIVWind1").hidden = true;
	document.getElementById("DIVWind2").hidden = true;
  document.getElementById("DIVWind3").hidden = true;

	document.getElementById("DIVForthet1").hidden = true;
	document.getElementById("DIVForthet2").hidden = true;
  document.getElementById("DIVForthet3").hidden = true;

	document.getElementById("DIV1").hidden = true;
	document.getElementById("DIV2").hidden = false;
  document.getElementById("DIV3").hidden = true;

	$(document).ready(function(){
			$.get("q3b_serverstuff.php", {number:5} , function(data, status){
				console.log(data);
				obj = JSON.parse(data);
				console.log(obj);
				console.log(obj[0].fresh_percentage);
				console.log(obj[0].ContentType_fre);

				var myDoughnutChart = new Chart(ctx1, {
				    type: 'doughnut',
				    data:{
				      datasets:[{
				        data:[],
				        backgroundColor:[]

				      }],
				      labels:[]

				    },
				    options: {
				       responsive: false,
				       legend: {
				          position: 'bottom' //place legend on the right side of chart
				       }, title: {
				            display: true,
				            text: 'Fresh'
				        }

				    }
				});

				var myDoughnutChart1 = new Chart(ctx2, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
				            display: true,
				            text: 'Stale'
				        }

						}
				});

				function addData(chart, label, data, color) {
				    chart.data.labels.push(label);
				    chart.data.datasets.forEach((dataset) => {
				        dataset.data.push(data);
				        dataset.backgroundColor.push(color);
				    });
				    chart.update();
				}

				var endoftime=obj.length;

				for (var i = 0; i < endoftime; i++) {
				  r = Math.floor(Math.random() * 200);
				g = Math.floor(Math.random() * 200);
				b = Math.floor(Math.random() * 200);
				color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
				    addData(myDoughnutChart, obj[i].ContentType_fre, obj[i].fresh_percentage,color);
						addData(myDoughnutChart1, obj[i].ContentType_sta, obj[i].stale_percentage,color);
				     console.log(obj[i].fresh_percentage);
				    console.log(obj[i].ContentType_fre);
				     console.log(color);
				  }






})
})
};
//telos deuterou erwthmatos-----------------------------------------------------




//arxh tritou erwthmatos:-------------------------------------------------------

function  cacheabilityVodafone(){
	document.getElementById("DIVVodafone1").hidden = true;
	document.getElementById("DIVVodafone2").hidden = true;
	document.getElementById("DIVVodafone3").hidden = false;

	document.getElementById("DIVCosmote1").hidden = true;
	document.getElementById("DIVCosmote2").hidden = true;
	document.getElementById("DIVCosmote3").hidden = true;

	document.getElementById("DIVWind1").hidden = true;
	document.getElementById("DIVWind2").hidden = true;
	document.getElementById("DIVWind3").hidden = true;

	document.getElementById("DIVForthet1").hidden = true;
	document.getElementById("DIVForthet2").hidden = true;
	document.getElementById("DIVForthet3").hidden = true;

	document.getElementById("DIV1").hidden = true;
	document.getElementById("DIV2").hidden = true;
	document.getElementById("DIV3").hidden = true;

	$(document).ready(function(){
			$.get("q3c_serverstuff.php", {number:1} , function(data, status){
				obj = JSON.parse(data);
				console.log(obj);
				console.log(obj[0].Percentage_public);
				console.log(obj[0].ContentType_public);

				var myDoughnutChart = new Chart(ctxVo1, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'Public'
								}

						}
				});

				var myDoughnutChart1 = new Chart(ctxVo2, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'Private'
								}

						}
				});

				var myDoughnutChart2 = new Chart(ctxVo3, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'No cache'
								}

						}
				});

				var myDoughnutChart3 = new Chart(ctxVo4, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'No store'
								}

						}
				});
				function addData(chart, label, data, color) {
						chart.data.labels.push(label);
						chart.data.datasets.forEach((dataset) => {
								dataset.data.push(data);
								dataset.backgroundColor.push(color);
						});
						chart.update();
				}

				var endoftime=obj.length;

				for (var i = 0; i < endoftime; i++) {
					r = Math.floor(Math.random() * 200);
				g = Math.floor(Math.random() * 200);
				b = Math.floor(Math.random() * 200);
				color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
						addData(myDoughnutChart, obj[i].ContentType_public, obj[i].Percentage_public,color);
						addData(myDoughnutChart1, obj[i].ContentType_private, obj[i].Percentage_private,color);
						addData(myDoughnutChart2, obj[i].ContentType_no_cache, obj[i].Percentage_no_cache,color);
						addData(myDoughnutChart3, obj[i].ContentType_no_store, obj[i].Percentage_no_store,color);
						 console.log(obj[i].Percentage_public);
						console.log(obj[i].ContentType_public);
						 console.log(color);
					}






	})
	})

};
function  cacheabilityCosmote(){
	document.getElementById("DIVVodafone1").hidden = true;
	document.getElementById("DIVVodafone2").hidden = true;
	document.getElementById("DIVVodafone3").hidden = true;

	document.getElementById("DIVCosmote1").hidden = true;
	document.getElementById("DIVCosmote2").hidden = true;
	document.getElementById("DIVCosmote3").hidden = false;

	document.getElementById("DIVWind1").hidden = true;
	document.getElementById("DIVWind2").hidden = true;
	document.getElementById("DIVWind3").hidden = true;

	document.getElementById("DIVForthet1").hidden = true;
	document.getElementById("DIVForthet2").hidden = true;
	document.getElementById("DIVForthet3").hidden = true;

	document.getElementById("DIV1").hidden = true;
	document.getElementById("DIV2").hidden = true;
	document.getElementById("DIV3").hidden = true;

	$(document).ready(function(){
			$.get("q3c_serverstuff.php", {number:2} , function(data, status){
				obj = JSON.parse(data);
				console.log(obj);
				console.log(obj[0].Percentage_public);
				console.log(obj[0].ContentType_public);

				var myDoughnutChart = new Chart(ctxC1, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'Public'
								}

						}
				});

				var myDoughnutChart1 = new Chart(ctxC2, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'Private'
								}

						}
				});

				var myDoughnutChart2 = new Chart(ctxC3, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'No cache'
								}

						}
				});

				var myDoughnutChart3 = new Chart(ctxC4, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'No store'
								}

						}
				});
				function addData(chart, label, data, color) {
						chart.data.labels.push(label);
						chart.data.datasets.forEach((dataset) => {
								dataset.data.push(data);
								dataset.backgroundColor.push(color);
						});
						chart.update();
				}

				var endoftime=obj.length;

				for (var i = 0; i < endoftime; i++) {
					r = Math.floor(Math.random() * 200);
				g = Math.floor(Math.random() * 200);
				b = Math.floor(Math.random() * 200);
				color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
						addData(myDoughnutChart, obj[i].ContentType_public, obj[i].Percentage_public,color);
						addData(myDoughnutChart1, obj[i].ContentType_private, obj[i].Percentage_private,color);
						addData(myDoughnutChart2, obj[i].ContentType_no_cache, obj[i].Percentage_no_cache,color);
						addData(myDoughnutChart3, obj[i].ContentType_no_store, obj[i].Percentage_no_store,color);
						 console.log(obj[i].Percentage_public);
						console.log(obj[i].ContentType_public);
						 console.log(color);
					}






	})
	})

};
function  cacheabilityWind(){
	document.getElementById("DIVVodafone1").hidden = true;
	document.getElementById("DIVVodafone2").hidden = true;
	document.getElementById("DIVVodafone3").hidden = true;

	document.getElementById("DIVCosmote1").hidden = true;
	document.getElementById("DIVCosmote2").hidden = true;
	document.getElementById("DIVCosmote3").hidden = true;

	document.getElementById("DIVWind1").hidden = true;
	document.getElementById("DIVWind2").hidden = true;
	document.getElementById("DIVWind3").hidden = false;

	document.getElementById("DIVForthet1").hidden = true;
	document.getElementById("DIVForthet2").hidden = true;
	document.getElementById("DIVForthet3").hidden = true;

	document.getElementById("DIV1").hidden = true;
	document.getElementById("DIV2").hidden = true;
	document.getElementById("DIV3").hidden = true;


	$(document).ready(function(){
			$.get("q3c_serverstuff.php", {number:3} , function(data, status){
				obj = JSON.parse(data);
				console.log(obj);
				console.log(obj[0].Percentage_public);
				console.log(obj[0].ContentType_public);

				var myDoughnutChart = new Chart(ctxW1, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'Public'
								}

						}
				});

				var myDoughnutChart1 = new Chart(ctxW2, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'Private'
								}

						}
				});

				var myDoughnutChart2 = new Chart(ctxW3, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'No cache'
								}

						}
				});

				var myDoughnutChart3 = new Chart(ctxW4, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'No store'
								}

						}
				});
				function addData(chart, label, data, color) {
						chart.data.labels.push(label);
						chart.data.datasets.forEach((dataset) => {
								dataset.data.push(data);
								dataset.backgroundColor.push(color);
						});
						chart.update();
				}

				var endoftime=obj.length;

				for (var i = 0; i < endoftime; i++) {
					r = Math.floor(Math.random() * 200);
				g = Math.floor(Math.random() * 200);
				b = Math.floor(Math.random() * 200);
				color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
						addData(myDoughnutChart, obj[i].ContentType_public, obj[i].Percentage_public,color);
						addData(myDoughnutChart1, obj[i].ContentType_private, obj[i].Percentage_private,color);
						addData(myDoughnutChart2, obj[i].ContentType_no_cache, obj[i].Percentage_no_cache,color);
						addData(myDoughnutChart3, obj[i].ContentType_no_store, obj[i].Percentage_no_store,color);
						 console.log(obj[i].Percentage_public);
						console.log(obj[i].ContentType_public);
						 console.log(color);
					}






	})
	})
};
function  cacheabilityForthet(){
	document.getElementById("DIVVodafone1").hidden = true;
	document.getElementById("DIVVodafone2").hidden = true;
	document.getElementById("DIVVodafone3").hidden = true;

	document.getElementById("DIVCosmote1").hidden = true;
	document.getElementById("DIVCosmote2").hidden = true;
	document.getElementById("DIVCosmote3").hidden = true;

	document.getElementById("DIVWind1").hidden = true;
	document.getElementById("DIVWind2").hidden = true;
	document.getElementById("DIVWind3").hidden = true;

	document.getElementById("DIVForthet1").hidden = true;
	document.getElementById("DIVForthet2").hidden = true;
	document.getElementById("DIVForthet3").hidden = false;

	document.getElementById("DIV1").hidden = true;
	document.getElementById("DIV2").hidden = true;
	document.getElementById("DIV3").hidden = true;

	$(document).ready(function(){
			$.get("q3c_serverstuff.php", {number:4} , function(data, status){
				obj = JSON.parse(data);
				console.log(obj);
				console.log(obj[0].Percentage_public);
				console.log(obj[0].ContentType_public);

				var myDoughnutChart = new Chart(ctxFor1, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'Public'
								}

						}
				});

				var myDoughnutChart1 = new Chart(ctxFor2, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'Private'
								}

						}
				});

				var myDoughnutChart2 = new Chart(ctxFor3, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'No cache'
								}

						}
				});

				var myDoughnutChart3 = new Chart(ctxFor4, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'No store'
								}

						}
				});
				function addData(chart, label, data, color) {
						chart.data.labels.push(label);
						chart.data.datasets.forEach((dataset) => {
								dataset.data.push(data);
								dataset.backgroundColor.push(color);
						});
						chart.update();
				}

				var endoftime=obj.length;

				for (var i = 0; i < endoftime; i++) {
					r = Math.floor(Math.random() * 200);
				g = Math.floor(Math.random() * 200);
				b = Math.floor(Math.random() * 200);
				color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
						addData(myDoughnutChart, obj[i].ContentType_public, obj[i].Percentage_public,color);
						addData(myDoughnutChart1, obj[i].ContentType_private, obj[i].Percentage_private,color);
						addData(myDoughnutChart2, obj[i].ContentType_no_cache, obj[i].Percentage_no_cache,color);
						addData(myDoughnutChart3, obj[i].ContentType_no_store, obj[i].Percentage_no_store,color);
						 console.log(obj[i].Percentage_public);
						console.log(obj[i].ContentType_public);
						 console.log(color);
					}






	})
	})

};
function  cacheability(){
	document.getElementById("DIVVodafone1").hidden = true;
	document.getElementById("DIVVodafone2").hidden = true;
	document.getElementById("DIVVodafone3").hidden = true;

	document.getElementById("DIVCosmote1").hidden = true;
	document.getElementById("DIVCosmote2").hidden = true;
	document.getElementById("DIVCosmote3").hidden = true;

	document.getElementById("DIVWind1").hidden = true;
	document.getElementById("DIVWind2").hidden = true;
	document.getElementById("DIVWind3").hidden = true;

	document.getElementById("DIVForthet1").hidden = true;
	document.getElementById("DIVForthet2").hidden = true;
	document.getElementById("DIVForthet3").hidden = true;

	document.getElementById("DIV1").hidden = true;
	document.getElementById("DIV2").hidden = true;
	document.getElementById("DIV3").hidden = false;

	$(document).ready(function(){
			$.get("q3c_serverstuff.php", {number:5} , function(data, status){
				obj = JSON.parse(data);
				console.log(obj);
				console.log(obj[0].Percentage_public);
				console.log(obj[0].ContentType_public);

				var myDoughnutChart = new Chart(ctx_1, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'Public'
								}

						}
				});

				var myDoughnutChart1 = new Chart(ctx_2, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'Private'
								}

						}
				});

				var myDoughnutChart2 = new Chart(ctx_3, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'No cache'
								}

						}
				});

				var myDoughnutChart3 = new Chart(ctx_4, {
						type: 'doughnut',
						data:{
							datasets:[{
								data:[],
								backgroundColor:[]

							}],
							labels:[]

						},
						options: {
							 responsive: false,
							 legend: {
									position: 'bottom' //place legend on the right side of chart
							 }, title: {
										display: true,
										text: 'No store'
								}

						}
				});
				function addData(chart, label, data, color) {
						chart.data.labels.push(label);
						chart.data.datasets.forEach((dataset) => {
								dataset.data.push(data);
								dataset.backgroundColor.push(color);
						});
						chart.update();
				}

				var endoftime=obj.length;

				for (var i = 0; i < endoftime; i++) {
					r = Math.floor(Math.random() * 200);
				g = Math.floor(Math.random() * 200);
				b = Math.floor(Math.random() * 200);
				color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
						addData(myDoughnutChart, obj[i].ContentType_public, obj[i].Percentage_public,color);
						addData(myDoughnutChart1, obj[i].ContentType_private, obj[i].Percentage_private,color);
						addData(myDoughnutChart2, obj[i].ContentType_no_cache, obj[i].Percentage_no_cache,color);
						addData(myDoughnutChart3, obj[i].ContentType_no_store, obj[i].Percentage_no_store,color);
						 console.log(obj[i].Percentage_public);
						console.log(obj[i].ContentType_public);
						 console.log(color);
					}






	})
	})

};
//telos tritou erwthmatos-------------------------------------------------------



</script>

</body>
</html>
