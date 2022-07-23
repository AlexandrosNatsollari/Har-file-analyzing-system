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
      <button class="dropdown-btn"><a href="../../admin.php">Home Page</a></button>
    </div>
    <div class="main">
      <canvas id="ctx" width="800"></canvas>
      <br>
      <canvas id="ctx1" width="500"></canvas>
    </div>
  <script>



  $(document).ready(function(){
      $.get("serverstuff.php", function(data, status){
        obj = JSON.parse(data);
        console.log(obj);



        var chart = new Chart(ctx, {
         type: 'bar',
         data: {
            labels: ['Πλήθος Χρηστών', 'Request Method', 'Response Status', 'Domains','Πλήθος Παρόχων'], // responsible for how many bars are gonna show on the chart
            // create 12 datasets, since we have 12 items
            // data[0] = labels[0] (data for first bar - 'Standing costs') | data[1] = labels[1] (data for second bar - 'Running costs')
            // put 0, if there is no data for the particular bar
            datasets: [{//ερωτημα a
               label: 'Πλήθος Χρηστών',
               data: [obj.numofusers],
               backgroundColor: '#22853A'
            }, {//erwthma b
               label: ' Μεθοδος Αιτησης GET',
               data: [0, obj.rowcountGET, 0, 0, 0, 0],
               backgroundColor: '#000033'
            }, {
               label: ' Μεθοδος Αιτησης POST',
               data: [0, obj.rowcountPOST, 0, 0, 0, 0],
               backgroundColor: '#316390'
            },{
               label: ' Μεθοδος Αιτησης HEAD',
               data: [0, obj.rowcountHEAD, 0, 0, 0, 0],
               backgroundColor: '#66B2FF'
            },{
               label: ' Μεθοδος Αιτησης PUT',
               data: [0, obj.rowcountPUT, 0, 0, 0, 0],
               backgroundColor: '#00B2CC'
            },{
               label: ' Μεθοδος Αιτησης DELETE',
               data: [0, obj.rowcountDELETE, 0, 0, 0, 0],
               backgroundColor: '#21C6C3'
            },{
               label: ' Μεθοδος Αιτησης CONNECT',
               data: [0, obj.rowcountCONNECT, 0, 0, 0, 0],
               backgroundColor: '#83BBDF'
            }, {
               label: ' Μεθοδος Αιτησης OPTIONS',
               data: [0, obj.rowcountOPTIONS, 0, 0, 0, 0],
               backgroundColor: '#333FFF'
            },{
               label: ' Μεθοδος Αιτησης TRACE',
               data: [0, obj.rowcountTRACE, 0, 0, 0, 0],
               backgroundColor: '#6495ED'
            },{
               label: ' Μεθοδος Αιτησης PATCH',
               data: [0, obj.rowcountPATCH, 0, 0, 0, 0],
               backgroundColor: '#3163AA'
            },{//erwthma c
               label: 'Informational responses (100–199)',
               data: [0, 0, obj.status1, 0, 0, 0],
               backgroundColor: '#ffcccc'
            },{
               label: 'Successful responses (200–299)',
               data: [0, 0, obj.status2, 0, 0, 0],
               backgroundColor: '#ff6666'
            },{
               label: 'Redirects (300–399)',
               data: [0, 0, obj.status3, 0, 0, 0],
               backgroundColor: '#ff0000'
            },{
               label: 'Client errors (400–499)',
               data: [0, 0, obj.status4, 0, 0, 0],
               backgroundColor: '#800000'
            },{
               label: 'Server errors (500–599)',
               data: [0, 0, obj.status5, 0, 0, 0],
               backgroundColor: '#330000'
            }, {//erwthma d
               label: 'Πλήθος διφορετικών domains',
               data: [0, 0, 0, obj.numofdomains, 0, 0],
               backgroundColor: '#ffff00'
            }, {//erwthma e
               label: 'Πλήθος Παρόχων',
               data: [0, 0, 0, 0, obj.numofisp, 0],
               backgroundColor: '#ff6600'
            }]
         },
         options: {
            responsive: false,
            legend: {
               position: 'hidden' //place legend on the right side of chart
            },
            scales: {
               xAxes: [{
                  stacked: true // this should be set to make the bars stacked
               }],
               yAxes: [{
                  stacked: true // this also..
               }]
            }
         }
      });
//---------------------------------




var myDoughnutChart = new Chart(ctx1, {
    type: 'doughnut',
    data:{
      datasets:[{
        data:[obj.avg[0]],
        backgroundColor:['#cccccc']

      }],
      labels:[obj.type[0]]

    },
    options: {
       responsive: false,
       legend: {
          position: 'bottom' //place legend on the right side of chart
       }, title: {
            display: true,
            text: 'Μέση ηλικία ιστοαντικειμένων ανά CONTENT-TYPE'
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

var endoftime=obj.avg.length;

for (var i = 1; i < endoftime; i++) {
  r = Math.floor(Math.random() * 200);
g = Math.floor(Math.random() * 200);
b = Math.floor(Math.random() * 200);
color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
     addData(myDoughnutChart, obj.type[i], obj.avg[i],color);
     console.log(obj.type[i]);
    console.log(obj.avg[i]);
     console.log(color);
  }

//-------------------------------------
      });
  });

</script>

  </body>
</html>
