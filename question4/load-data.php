<?php
include 'dbh.php';
session_start();
$user = $_SESSION['username'];
$b=[];


//query gia na lavoume thn ip me vash to ContentType tou header sto entrie pou anhkei
$sql = "SELECT entries.serverIPAddress,headers.ContentType FROM entries JOIN headers
ON entries.entrieconnection=headers.entrieconnection_ct
WHERE entries.user_username='$user' AND headers.ContentType LIKE '%text/html%' ";


//afou lavoume thn ip thn stelnoume sthn freegoip.app opou mas epistrefei tis
//syntetagmenes ths ip se morfh json
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)>0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $a = $row['serverIPAddress'];
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://freegeoip.app/json/$a",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "accept: application/json",
          "content-type: application/json"
        ),
      ));

      $b=$response = curl_exec($curl);
      $location=json_decode($b, true);
      echo $location['latitude']."\n";
      echo $location['longitude']."\n";




  }

}else {
  echo "There are no comments";
}



 ?>
