<?php
$db = mysqli_connect('localhost', 'root', '', 'webdatabase');
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

//Plhthos users
$sql1 = "SELECT username FROM users";
$result1 = $db->query($sql1);

$numofusers=0;
if ($result1->num_rows > 0) {
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    $numofusers=$numofusers+1;
  }
} else {
  echo "0";
}
//echo $numofusers;
mysqli_free_result($result1);

//------------------------
$rowcountGET=0;
$rowcountPOST=0;
$rowcountHEAD=0;
$rowcountPUT=0;
$rowcountDELETE=0;
$rowcountCONNECT=0;
$rowcountOPTIONS=0;
$rowcountPATCH=0;
$rowcountTRACE=0;
$sql2="SELECT method FROM request ";
$result2=mysqli_query($db,$sql2);

//mesa sthn while metrame poses fores emfanizetai to kathe method gia na
//to steiloume sto grafhma
if ($result2->num_rows > 0){
  while ($row = $result2 -> fetch_assoc() ) {
		 if ($row["method"]=='GET') {
       $rowcountGET+=1;
     }elseif ($row["method"]=='POST') {
       $rowcountPOST+=1;
     }elseif ($row["method"]=='HEAD') {
      $rowcountHEAD+=1;
     }elseif ($row["method"]=='PUT') {
       $rowcountPUT+=1;
     }elseif ($row["method"]=='DELETE') {
       $rowcountDELETE+=1;
     }elseif ($row["method"]=='CONNECT') {
       $rowcountCONNECT+=1;
     }elseif ($row["method"]=='OPTIONS') {
       $rowcountOPTIONS+=1;
     }elseif ($row["method"]=='TRACE') {
      $rowcountTRACE+=1;
     }elseif ($row["method"]=='PATCH') {
       $rowcountPATCH+=1;
     }
	}

  mysqli_free_result($result2);
  }
//----------------------------

$status1=0;
$status2=0;
$status3=0;
$status4=0;
$status5=0;
$sql3="SELECT status FROM response ";
$result3=mysqli_query($db,$sql3);
//mesa sthn while metrame poses fores emfanizetai to kathe status gia na
//to steiloume sto grafhma
if ($result3->num_rows > 0){
  while ($row = $result3 -> fetch_assoc() ) {
		 if ($row["status"]>=100 && $row["status"]<200) {
       $status1+=1;
     }elseif ($row["status"]>=200 && $row["status"]<300) {
       $status2+=1;
     }elseif ($row["status"]>=300 && $row["status"]<400) {
      $status3+=1;
    }elseif ($row["status"]>=400 && $row["status"]<500) {
       $status4+=1;
     }elseif ($row["status"]>=500 && $row["status"]<600) {
       $status5+=1;
     }
	}

  mysqli_free_result($result3);
  }
//-----------------------------------------------
$sql4 = "SELECT COUNT(DISTINCT url) FROM request";
$result4 = $db->query($sql4);

$numofdomains=0;
if ($result4->num_rows > 0) {
  // output data of each row
  while($row = $result4->fetch_assoc()) {
    $numofdomains=$row["COUNT(DISTINCT url)"];
  }
}
//echo $numofusers;
mysqli_free_result($result4);

//-----------------------------------------------
$sql5 = "SELECT COUNT(DISTINCT 	entries_isp) FROM entries";
$result5 = $db->query($sql5);

$numofisp=0;
if ($result5->num_rows > 0) {
  // output data of each row
  while($row = $result5->fetch_assoc()) {
    $numofisp=$row["COUNT(DISTINCT 	entries_isp)"];
  }
}

mysqli_free_result($result5);
//-------------------------------------------------------

//vriskoume thn mesh hlikia twn istoantikeimenwn thn stigmh pou anaktythikan
//ana content type
$sql6= "SELECT Avg(entries.startedDateTime-headers.LastModified+entries.timings) AS AV,headers.ContentType AS CT  FROM entries JOIN headers ON entries.entrieconnection=headers.entrieconnection_ct WHERE headers.LastModified!='' GROUP BY headers.ContentType;";
$result6 = $db->query($sql6);



//apothikeuoume ta average pou prokeiptoun ana content type
$avg=[];
$k=0;
if ($result6->num_rows > 0) {
  // output data of each row
  while($row = $result6->fetch_assoc()) {
    if ($row["AV"]!=0 &&  $row["CT"]!='' ) {
      $avg[$k]=$row["AV"];
      $type[$k]=$row["CT"];
       $k+=1;
    }
  }
}




//-------------------------------------------------
  //ftiaxnoume ta dedomena se mia domh json gia na stalthoun sto jsstuff.php
  echo json_encode(['numofusers' => $numofusers, 'rowcountGET' => $rowcountGET, 'rowcountPOST' => $rowcountPOST, 'rowcountHEAD' => $rowcountHEAD,
   'rowcountPUT' => $rowcountPUT, 'rowcountDELETE' => $rowcountDELETE, 'rowcountCONNECT' => $rowcountCONNECT, 'rowcountOPTIONS' => $rowcountOPTIONS, 'rowcountTRACE' => $rowcountTRACE, 'rowcountPATCH' => $rowcountPATCH,
    'status1' => $status1,'status2' => $status2, 'status3' => $status3, 'status4' => $status4, 'status5' => $status5, 'numofdomains' => $numofdomains, 'numofisp' => $numofisp,
     'avg' => $avg, 'type' => $type]);
mysqli_close($db);


 ?>
