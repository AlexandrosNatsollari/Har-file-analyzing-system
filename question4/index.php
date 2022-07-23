<!DOCTYPE html>
<html>
<head>
		<title>IP Heatmap</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="../style2.css">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/heatmap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet-heatmap@1.0.0/leaflet-heatmap.js"></script>

<style>
	#mapid { height: 400px; width: 90%; align: "center"}
</style>



</head>
<body>
	<script>
	$(document).ready(function(){
	  $("button").click(function(){
	    var promise =$.get("load-data.php")
			 .done(function(data, status){
	      a=[];
				latarr=[];
				lngarr=[];

				//counters for later use in for
				var g=0;
				var j=0;
	      //console.log(data);

				//xwrizoume ta latitude-longitude pou einai sthn idia grammh kai ta
				//apothikeuoume sto array a
				a=data.split("\n");
				console.log(data);

				var arrlength=a.length;

			 for (var i = 0; i <arrlength-1; i++) {
				if ((i % 2) == 0 ) {
					latarr[g]=a[i];
					//console.log(latarr[g]);
					g++;
				}else if ((i % 2) == 1) {
					lngarr[j]=a[i];
					//console.log(lngarr[j]);
					j++;
				}

			 }


			 let mymap = L.map("mapid");//fhmiourgia xarth
			 let osmUrl = "https://tile.openstreetmap.org/{z}/{x}/{y}.png"; //fortwnoume ta tiles
			 //gia na emfanistei o xarths
			 let osmAttrib =
			 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
			 let osm = new L.TileLayer(osmUrl, { attribution: osmAttrib });
			 mymap.addLayer(osm);

			 //orizoume apo pou ksekinaei o xarths
			 mymap.setView([38.246242, 21.7350847],2);


	     datapoints=[];
			 let testData = {
			 max: 8,
			 data: [
			 {lat: latarr[0], lng: lngarr[0], count:2}]
			 };
	     endofloop=latarr.length;
			 finalend=endofloop-1;
	     //let datapoint ={lat: 38.323343, lng: 21.865082, count:2};
			 for (var i = 1; i <finalend ; i++) {
				 let datapoint ={lat: latarr[i], lng: lngarr[i], count:2};
				 datapoints[i]=datapoint;
				 console.log(datapoints[i]);
			 }

	     //console.log(testData)

			 let cfg = {

			 "radius": 40,
			 "maxOpacity": 0.8,
			 "scaleRadius": false,
			 "useLocalExtrema": false,
			 latField: 'lat',
			 lngField: 'lng',
			 valueField: 'count'
			 };

			 let heatmapLayer =  new HeatmapOverlay(cfg);

			 mymap.addLayer(heatmapLayer);
			 heatmapLayer.setData(testData);
			 heatmapLayer.addData(datapoints);




	});
	  });
	});
	</script>
	<div class="sidenav">
     <button class="dropdown-btn"><a href="../index.php">Home Page</a></button>
  </div>
<div class="main">
	<button class="myBtn">Visualise Data</button>
<div id="mapid"></div>
</div>

</body>
</html>
