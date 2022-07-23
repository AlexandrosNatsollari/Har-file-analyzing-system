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
	header('location: login.php');
}

// Logout button will destroy the session, and
// will unset the session variables
// User will be headed to 'login.php'
// after loggin out
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>HAR Process</title>
    <link rel="stylesheet" type="text/css" href="style2.css">

  </head>

  <body>

    <div class="sidenav">
      <button class="dropdown-btn"><a href="index.php">Home Page</a></button>
    </div>



    <div class="main">

      <form class="bor" action="FileReader.php" method="post">
       <img src="image2.jpg" alt="graph" class="image">


      <input  type="file" id="get_the_file" class="myBtn"></input>

      <div id="DIV" hidden>
        <button id="myBtn" class="myBtn">Download Processed Har!</button>
        <button  id="btn_submit" class="myBtn" >Upload to Server!</button>

      </div>

   </form>

  </div>


    <script type="text/javascript">


    /* vazoume eventlistener gia na doume pote ginetai eisagwgh arxeiou
		kai tote na ksekinhsei h diadikasia katharismou toy har-->
		*/
    document.getElementById("get_the_file").addEventListener("change", function() {
    var file_to_read = document.getElementById("get_the_file").files[0];
    var fileread = new FileReader();
    fileread.onload = function(e) {
    var content = e.target.result;
    var obj = JSON.parse(content); // convert text into a JavaScript object
    var counter=0;

		//funnction to edit har objects and keep data we want
    function editobjects(obj, key) {
    for (k in obj) {

      if (k==key && k=="headers") {
        for (var i = 0; i < obj[k].length; i+0) {

          var a1 = obj[k].findIndex(v => v.name === "Host");
          var a2 = obj[k].findIndex(v => v.name === "host");

          var b1 = obj[k].findIndex(v => v.name === "expires");
          var b2 = obj[k].findIndex(v => v.name === "Expires");

          var c1 = obj[k].findIndex(v => v.name === "content-type");
          var c2 = obj[k].findIndex(v => v.name === "Content-Type");

          var d1 = obj[k].findIndex(v => v.name === "cache-control");
          var d2 = obj[k].findIndex(v => v.name === "Cache-Control");

          var e1 = obj[k].findIndex(v => v.name === "pragma");
          var e2 = obj[k].findIndex(v => v.name === "Pragma");

          var f1 = obj[k].findIndex(v => v.name === "age");
          var f2 = obj[k].findIndex(v => v.name === "Age");

          var g1 = obj[k].findIndex(v => v.name === "last-modified");
          var g2 = obj[k].findIndex(v => v.name === "last-Modified");



          if (i==a1 || i==b1 || i==c1 || i==d1 || i==e1 || i==f1 || i==g1 ) {
            i++;

          }else if (i==a2 || i==b2 || i==c2 || i==d2 || i==e2 || i==f2 || i==g2) {
            i++;

          }else if(i>a1 && i>b1 && i>c1 && i>d1 && i>e1 && i>f1 && i>g1) {
            obj[k].splice(i,1);

          }else if(i>a2 && i>b2 && i>c2 && i>d2 && i>e2 && i>f2 && i>g2) {
            obj[k].splice(i,1);

          }else {
            obj[k].splice(i,1);

          }
        }

      }else if (k==key && k=="url") {
        obj[k] = obj[k].slice(8);
        obj[k] = obj[k].split('/')[0]
      }else if (k==key && k=="request") {
        validKeys2 = ['method','url','headers'];
        Object.keys(obj[k]).forEach((key) => validKeys2.includes(key) ||  delete obj[k][key]);//request cleaned

      }else if (k==key && k=="response") {
        validKeys3 = ['status','statusText','headers'];
        Object.keys(obj[k]).forEach((key) => validKeys3.includes(key) ||  delete obj[k][key]);//response cleaned


      }else if (k==key && k=="timings") {
        validKeys4 = ['wait'];
        Object.keys(obj[k]).forEach((key) => validKeys4.includes(key) ||  delete obj[k][key]);//timings cleaned

      }else if (k==key && k!="headers" && k!="response" && k!="timings") {
            delete obj[k];
        }else if (typeof obj[k] === 'object') {
            editobjects(obj[k], key);
        }
    }
}


    //data cleansing from log
    editobjects(obj, "creator");
    editobjects(obj, "pages");
    editobjects(obj, "version");


    //data cleansing from request
    editobjects(obj, "request");


    //data cleansing from response
    editobjects(obj, "response");


    //data cleansing from timings
    editobjects(obj, "timings");



    //data cleansing from headers
    editobjects(obj, "headers");

    //removing https:// from urls
    //editobjects(obj, "url");

    //data cleansing from entries
    validKeys = [ 'response', 'request','timings','serverIPAddress','startedDateTime'];
    for (var i = 0; i < obj.log.entries.length; i++) {

    Object.keys(obj.log.entries[i]).forEach((key) => validKeys.includes(key) ||  delete obj.log.entries[i][key]);

    }


      //ean den yparxei arxeio tote mhn emfaniseis ta koubia pou orizontai
			//sto div
      if (file_to_read !="") {
        document.getElementById("DIV").hidden = false;

      }

    console.log(obj);

		/*xrhshmopoioume to JSON.stringify gia na metrepsoume to epeksergasmena
		dedomena se string me domh har*/
    var a = JSON.stringify(obj,null,'\t')


    function download(w, filename){
    var blob = new Blob([w], {type: "text/plain"});
    var url = window.URL.createObjectURL(blob);
    var a = document.createElement("a");
    a.href = url;
    a.download = filename;
    a.click();
  }

      document.getElementById("myBtn").addEventListener('click', () =>download(a, "ProcessedFile.har"));



    /*kaloume thn insertNew me to ta epeksergasmena dedomena pou einai
		 apothikeumena sto obj gia na stalthoun sto UploadDataToServer.php
		 kai na epeksergastoun pereterw
		*/
    document.getElementById("btn_submit").onclick = function() {insertNew(obj)};

    };
    fileread.readAsText(file_to_read);
    });


    function insertNew(vara) {


  			var data = vara;
  			console.log(data);
  			var xhttp = new XMLHttpRequest();

  			// Set POST method and ajax file path
  			xhttp.open("POST", "UploadDataToServer.php", true);

  			// call on request changes state
  			xhttp.onreadystatechange = function() {
  			    if (this.readyState == 4 && this.status == 200) {


  			    }
  			};

  			// Content-type
  			xhttp.setRequestHeader("Content-Type", "application/json");

  			// Send request with data
  			xhttp.send(JSON.stringify(data));
  		}



    </script>

  </body>
</html>
