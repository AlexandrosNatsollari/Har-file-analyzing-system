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
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" type="text/css" href="../../style2.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <meta charset="utf-8">
    <title>CHARTS</title>

  </head>

  <body>
    <div class="sidenav">
        <button class="dropdown-btn" onclick="typeFunction()">CONTENT TYPE </button>
        <button class="dropdown-btn" onclick="dayFunction()">Ημέρα της εβδομάδας</button>
        <button class="dropdown-btn" onclick="methodFunction()">HTTP μέθοδος</button>
        <button class="dropdown-btn" onclick="ispFunction()">Πάροχος σύνδεσης</button>
      <button class="dropdown-btn"><a href="../../admin.php">Home Page</a></button>
    </div>
    <div class="main">

      <div id="DIV" hidden>
        <canvas id="chart" height="250" ></canvas>
      </div>

      <div id="DIV1" hidden>
        <canvas id="chart1" height="150"></canvas>
      </div>

      <div id="DIV2" hidden>
        <canvas id="chart2" height="250" ></canvas>
      </div>

      <div id="DIV3" hidden>
        <canvas id="chart3" height="150" ></canvas>
      </div>

    </div>

  <script>

//prwto erwthma:----------------------------------------------------------------

  function  typeFunction(){

    document.getElementById("DIV").hidden = false;
    document.getElementById("DIV1").hidden = true;
    document.getElementById("DIV2").hidden = true;
		document.getElementById("DIV3").hidden = true;

  $(document).ready(function(){
      $.get("q2a_serverstuff.php", function(data, status){
        obj = JSON.parse(data);
        console.log(obj);


        var obj1 = {};

        $.each(obj, function(idx, item) {
            if (obj1[item.ContentType] ) {
                obj1[item.ContentType].push(item.time,item.avg);

            } else {
                obj1[item.ContentType] = [item.time,item.avg];

            }
        });

        var result = [];

        for(var prop in obj1) {
            result.push({
                ContentType: prop,
                shmeia: obj1[prop],

            });
        }

        console.log(result);

       var ctx = document.getElementById('chart').getContext('2d');
       var chart = new Chart(ctx, {
       type: 'line',
       data: {
             labels: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23]

            },
            options: {  legend: {

                 position: 'bottom' //place legend on the right side of chart
              }}
      });

    function addData(label,color, xp1, yp1) {
    //chart.data.labels.push(label);
    chart.data.datasets.push({ label: label, fill: false,borderColor: color,backgroundColor: color, data: [ {x: xp1, y: yp1} ] });
    //chart.data.datasets[0].data.push(   {x:xp1, y:yp1} ,{x:xp2, y:yp2}      );
    chart.update();
    }

     for (var i = 0; i < result.length; i++) {
       if(result[i].ContentType){
         r = Math.floor(Math.random() * 200);
       g = Math.floor(Math.random() * 200);
       b = Math.floor(Math.random() * 200);
       color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
         var loopa=result[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(result[i].ContentType,color,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);
         }
       }

     }





});
  });
};
//telos prwtou erwthmatos-------------------------------------------------------




//Deutero erwthma:--------------------------------------------------------------

function  dayFunction(){

  document.getElementById("DIV").hidden = true;
  document.getElementById("DIV1").hidden = false;
  document.getElementById("DIV2").hidden = true;
	document.getElementById("DIV3").hidden = true;

  $(document).ready(function(){
      $.get("q2b_serverstuff.php", function(data2, status){
        obj2 = JSON.parse(data2);
        console.log(obj2);


        var obj1 = {};

        $.each(obj2, function(idx, item) {
            if (obj1[item.day] ) {
                obj1[item.day].push(item.time,item.avg);

            } else {
                obj1[item.day] = [item.time,item.avg];

            }
        });

        var result2 = [];

        for(var prop in obj1) {
            result2.push({
                day: prop,
                shmeia: obj1[prop],

            });
        }

        console.log(result2);

       var ctx = document.getElementById('chart1').getContext('2d');
       var chart = new Chart(ctx, {
       type: 'line',
       data: {
             labels: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
             datasets: [{
                label: 'Monday',
                fill: false,
                data: [],
                backgroundColor: '#22853A',
                borderColor: '#22853A'
             }, {
                label: 'Tuesday',
                fill: false,
                data: [],
                backgroundColor: '#000033',
                borderColor: '#000033'
             }, {
                label: ' Wednesday',
                fill: false,
                data: [],
                backgroundColor: '#ff8000',
                borderColor: '#ff8000'
             },{
                label: ' Thursday',
                fill: false,
                data: [],
                backgroundColor: '#bf00ff',
                borderColor: '#bf00ff'
             },{
                label: ' Friday',
                fill: false,
                data: [],
                backgroundColor: '#ff0000',
                borderColor: '#ff0000'
             },
             {
                label: ' Saturday ',
                fill: false,
                data: [],
                backgroundColor: '#ffff00',
                borderColor: '#ffff00'
             },{
                label: 'Sunday',
                fill: false,
                data: [],
                backgroundColor: '#21C6C3',
                borderColor: '#21C6C3'
             }]
          },
            options: {  legend: {

                 position: 'bottom' //place legend on the right side of chart
              }}
      });

    function addData(i, xp1, yp1) {
    //chart.data.labels.push(label);
    chart.data.datasets[i].data.push({x: xp1, y: yp1});
    //chart.data.datasets[0].data.push(   {x:xp1, y:yp1} ,{x:xp2, y:yp2}      );
    chart.update();
    }

     for (var i = 0; i < result2.length; i++) {
       if(result2[i].day=='Monday'){

         var loopa=result2[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(0,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);
         }
       }else if (result2[i].day=='Tuesday') {
         var loopa=result2[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(1,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       }}else if (result2[i].day=='Wednesday') {
         var loopa=result2[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(2,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       }}else if (result2[i].day=='Thursday') {
         var loopa=result2[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(3,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       }}else if (result2[i].day=='Friday') {
         var loopa=result2[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(4,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       }}else if (result2[i].day=='Saturday') {
         var loopa=result2[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(5,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       }}else if (result2[i].day=='Sunday') {
         var loopa=result2[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(6,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       } }

};
})
})
};
//telos deyterou erwthmatos-----------------------------------------------------




//arxh tritou erwthmatos:-------------------------------------------------------
function  methodFunction(){

  document.getElementById("DIV").hidden = true;
  document.getElementById("DIV1").hidden = true;
  document.getElementById("DIV2").hidden = false;
	document.getElementById("DIV3").hidden = true;

$(document).ready(function(){
    $.get("q2c_serverstuff.php", function(data, status){
      obj = JSON.parse(data);
      console.log(obj);


      var obj1 = {};

      $.each(obj, function(idx, item) {
          if (obj1[item.method] ) {
              obj1[item.method].push(item.time,item.avg);

          } else {
              obj1[item.method] = [item.time,item.avg];

          }
      });

      var result = [];

      for(var prop in obj1) {
          result.push({
              method: prop,
              shmeia: obj1[prop],

          });
      }

      console.log(result);

     var ctx = document.getElementById('chart2').getContext('2d');
     var chart = new Chart(ctx, {
     type: 'line',
     data: {
           labels: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
           datasets: [{
              label: 'GET',
              fill: false,
              data: [],
              backgroundColor: '#22853A',
              borderColor: '#22853A'
           }, {
              label: 'POST',
              fill: false,
              data: [],
              backgroundColor: '#000033',
              borderColor: '#000033'
           }, {
              label: 'HEAD',
              fill: false,
              data: [],
              backgroundColor: '#ff8000',
              borderColor: '#ff8000'
           },{
              label: 'PUT',
              fill: false,
              data: [],
              backgroundColor: '#bf00ff',
              borderColor: '#bf00ff'
           },{
              label: 'DELETE',
              fill: false,
              data: [],
              backgroundColor: '#ff0000',
              borderColor: '#ff0000'
           },
           {
              label: 'CONNECT ',
              fill: false,
              data: [],
              backgroundColor: '#ffff00',
              borderColor: '#ffff00'
           },{
              label: 'OPTIONS',
              fill: false,
              data: [],
              backgroundColor: '#21C6C3',
              borderColor: '#21C6C3'
           },{
              label: 'TRACE',
              fill: false,
              data: [],
              backgroundColor: '#808080',
              borderColor: '#808080'
           },{
              label: 'PATCH',
              fill: false,
              data: [],
              backgroundColor: '#663300',
              borderColor: '#663300'
           }]


          },
          options: {  legend: {

               position: 'bottom' //place legend on the right side of chart
            }}
    });

    function addData(i, xp1, yp1) {
    //chart.data.labels.push(label);
    chart.data.datasets[i].data.push({x: xp1, y: yp1});
    //chart.data.datasets[0].data.push(   {x:xp1, y:yp1} ,{x:xp2, y:yp2}      );
    chart.update();
    }

     for (var i = 0; i < result.length; i++) {
       if(result[i].method=='GET'){

         var loopa=result[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(0,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);
         }
       }else if (result[i].method=='POST') {
         var loopa=result[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(1,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       }}else if (result[i].method=='HEAD') {
         var loopa=result[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(2,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       }}else if (result[i].method=='PUT') {
         var loopa=result[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(3,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       }}else if (result[i].method=='DELETE') {
         var loopa=result[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(4,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       }}else if (result[i].method=='CONNECT') {
         var loopa=result[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(5,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       }}else if (result[i].method=='OPTIONS') {
         var loopa=result[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(6,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       } }else if (result[i].method=='TRACE') {
         var loopa=result[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(7,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       } }else if (result[i].method=='PATCH') {
         var loopa=result[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(8,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);

       } }

};

});
});
};
//telos tritou erwthmatos-----------------------------------------------------



//tetarto erwthma:----------------------------------------------------------------

  function  ispFunction(){

    document.getElementById("DIV").hidden = true;
    document.getElementById("DIV1").hidden = true;
    document.getElementById("DIV2").hidden = true;
    document.getElementById("DIV3").hidden = false;

  $(document).ready(function(){
      $.get("q2d_serverstuff.php", function(data, status){
        obj = JSON.parse(data);
        console.log(obj);


        var obj1 = {};

        $.each(obj, function(idx, item) {
            if (obj1[item.isp] ) {
                obj1[item.isp].push(item.time,item.avg);

            } else {
                obj1[item.isp] = [item.time,item.avg];

            }
        });

        var result3 = [];

        for(var prop in obj1) {
            result3.push({
                isp: prop,
                shmeia: obj1[prop],

            });
        }

        console.log(result3);

       var ctx = document.getElementById('chart3').getContext('2d');
       var chart = new Chart(ctx, {
       type: 'line',
       data: {
             labels: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23]

            },
            options: {  legend: {

                 position: 'bottom' //place legend on the right side of chart
              }}
      });

    function addData(label,color, xp1, yp1) {
    //chart.data.labels.push(label);
    chart.data.datasets.push({ label: label, fill: false,borderColor: color,backgroundColor: color, data: [ {x: xp1, y: yp1} ] });
    //chart.data.datasets[0].data.push(   {x:xp1, y:yp1} ,{x:xp2, y:yp2}      );
    chart.update();
    }

     for (var i = 0; i < result3.length; i++) {
       if(result3[i].isp){
         r = Math.floor(Math.random() * 200);
       g = Math.floor(Math.random() * 200);
       b = Math.floor(Math.random() * 200);
       color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
         var loopa=result3[i].shmeia;
         for (var j = 0; j < loopa.length; j+=2) {
           addData(result3[i].isp,color,loopa[j], loopa[j+1]);
           console.log(loopa[j], loopa[j+1]);
         }
       }

     }





});
  });
};
//telos tetartou erwthmatos-------------------------------------------------------





</script>

  </body>
</html>
