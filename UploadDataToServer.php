<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'webdatabase');

//apothikeuoume to session variable username sthn metavlhth user
$user = $_SESSION['username'];
//----------------------
//Vriskoume ton arithmo toy teleuaiou entrie me enan counter pou
//exoume fitaksei wste sto epomeno arxeio na h arithmish na synexisei
//ekei pou meiname sto prohgoumeno
$sql = "SELECT MAX(entrieconnection) FROM entries";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
		$entriescounter=$row["MAX(entrieconnection)"];
  }
}

mysqli_free_result($result4);
//------------------------------------

$request = 2;
// Read $_GET value
if(isset($_GET['request'])){
	$request = $_GET['request'];
}


//
$curl = curl_init();//initialize a cURL session

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://ip-api.com/json/?fields=city,isp",
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

$response = curl_exec($curl);//apothikeuoume thn apanthsh ths selidas
$err = curl_error($curl);
$hostname = '';
curl_close($curl);

//elegxoume gia errors kai an den yparxei kanoume json_decode
//kai apothikeuoume ton isp kai thn polh toy xrhsth sthn vash
if ($err) {
  echo "cURL Error #:" . $err;
} else {
   $temp =json_decode($response,true);
   $hostname = $temp['isp'];
   $queryisp ="UPDATE users SET isp = '$hostname' WHERE username = '$user';";
   mysqli_query($db, $queryisp);
   $city=$temp['city'];
   $querycity ="UPDATE users SET city = '$city' WHERE username = '$user';";
   mysqli_query($db, $querycity);

}


	// Read POST data
	$json=file_get_contents("php://input");

  //apothikeuoume san associative arrays to json sth metavlhth data
	$data = json_decode($json,true);

  //me tis foreach kanoume inception kata mia ennoia stoo vathos tou har
  //kai bainoume kathe fora sthn domh pou theloume gia na ftasoume sto
  //associative array pou xreiazomaste

  //me thn prwth foreach bainei sta etnries
	foreach ($data as $log =>$entries) {
    //me thn deuterh foreach exoume prosvash sto periexomeno kathe entrie ksexwrista
	  foreach ($entries as $u=> $z) {
      //me trith foreach apoktoume prosvash sthn kathe grammh enos entrie
	    foreach ($z as $n => $line) {
        //arxikopooihsh counter pou xrhsimopoioume sthn synexeia gia na vlepoume
        //se poio entrie eimaste
				$entriescounter++;

        $tempcontenttype='';

        //me auth thn foreach elegxoume to value ths kathe grammhs meso switch
	      foreach ($line as $key => $value){
	        switch ($key) {

	          case 'serverIPAddress':
	            $serverIPAddress = $value;
	            break;

	          case 'startedDateTime':
	            $startedDateTime = $value;
	            break;

	          case 'request':
              //me auth thn foreach bainoume pio vathia sto inception na doume
              //an einai method,url
	            foreach ($value as $reqkeys => $reqvalues) {
	              switch ($reqkeys) {

	                case 'method':
	                  $method = $reqvalues;
	                  break;

	                case 'url':
                    //apothikeush mono domain kai elegxos extension kathws kai apothikeush
                    //an anhkei se auta pou theloyme na apothikeusoume
                    $tempurl=$reqvalues;
                    if (strpos($tempurl, 'html') !== false || strpos($tempurl, 'php') !== false || strpos($tempurl, 'asp') !== false || strpos($tempurl, 'jsp') !== false) {
                        $tempcontenttype='text/html';
                    }
                    $domain = parse_url('http://' . str_replace(array('https://', 'http://'), '', $tempurl), PHP_URL_HOST);
	                  $url = $domain;
	                  break;
	              }
	            }

	          case 'response':
               //me auth thn foreach bainoume pio vathia sto inception na doume
                //an einai status,statusText,headers
	              foreach ($value as $respkeys => $respvalues) {
	                switch ($respkeys) {

	                  case 'status':
	                    $status = $respvalues;
	                    break;

	                  case 'statusText':
	                    $statusText = $respvalues;
	                    break;

	                  case 'headers':

                      //srxikopoihsh headersnames ws kena wste se kathe epanalipsh
                      //na kratienai mono h timh pou diavasthke an diavastike
                      //alliws apothikeuete sthn vash keno
											$contenttype='';
											$cachecontrol='';
											$pragma='';
											$expires='';
											$age='';
											$lastmodified='';
											$host='';

                      //me auth thn foreach vlepoume to kathe header ksexwrista
	                    foreach ($respvalues as $headerskeys => $headersvalues) {
                        //me auth thn foreach vlepoume thn timh header ksexwrista
                        //wste na doume an einai ta headervalues pou psaxnoume
	                      foreach ($headersvalues as $zhtoumenaheaders => $zhtoumenanames) {

	                        if ( $zhtoumenanames == 'Host' || $zhtoumenanames == 'host') {
	                          $host = $headersvalues['value'];


	                        }elseif ($zhtoumenanames == 'content-type' || $zhtoumenanames == 'Content-Type' ) {
                            //elgxoume an to content type einai keno
                            //an den einai pernei timh text/html pou theloume gia to erwthma 4
                            if ($headersvalues['value']=='') {
                              $contenttype=$tempcontenttype;
                            }elseif ($headersvalues['value']!='') {
                              $contenttype = $headersvalues['value'];
                            }



	                        }elseif ($zhtoumenanames == 'cache-control' || $zhtoumenanames == 'Cache-Control' ) {
	                          $cachecontrol = $headersvalues['value'];


	                        }elseif ($zhtoumenanames == 'pragma' || $zhtoumenanames == 'Pragma' ) {
	                          $pragma = $headersvalues['value'];

	                        }elseif ($zhtoumenanames == 'expires' || $zhtoumenanames == 'Expires' ) {
	                          $expires = $headersvalues['value'];


	                        }elseif ($zhtoumenanames == 'age' || $zhtoumenanames == 'Age' ) {
	                          $age = $headersvalues['value'];

	                        }elseif ($zhtoumenanames == 'last-modified' || $zhtoumenanames == 'Last-Modified' ) {
	                           $datelm = $headersvalues['value'];
                             $lastmodified = date('Y-m-d H:i:s', strtotime($datelm));

	                        }


	                      }

	                    }
	                  $query4 = "INSERT INTO headers( ContentType,CacheControl,Pragma,Expires,Age,LastModified,Host,entrieconnection_ct,isp )  VALUES('$contenttype','$cachecontrol','$pragma','$expires','$age','$lastmodified','$host','$entriescounter','$hostname');";
										 mysqli_query($db, $query4);
	                }

	           }
	          case 'timings':
	            foreach ($value as $timingskeys => $timingsvalues) {
	              switch ($timingskeys) {

	                case 'wait':
	                  $wait = $timingsvalues;
	                break;
	              }
	           }
	           break;
	      }
	    }

	    $query1 = "INSERT INTO entries( serverIPAddress,timings,startedDateTime,user_username,entrieconnection,entries_isp )  VALUES('$serverIPAddress','$wait','$startedDateTime','$user','$entriescounter','$hostname');";
	    mysqli_query($db, $query1);

	    $query2 = "INSERT INTO request( method,url,entrieconnection_rq )  VALUES('$method','$url','$entriescounter');";
	    mysqli_query($db, $query2);

	    $query3 = "INSERT INTO response( status,statusText,entrieconnection_re )  VALUES('$status','$statusText','$entriescounter');";
	    mysqli_query($db, $query3);




	  }
	}

	}

  //apothikeuoume hmeromhnia teleutaiou upload sthn vash
	$date=date("Y-m-d H:i:s");
	$query5 = "UPDATE users SET lastUpload='$date' WHERE username='$user';";
	mysqli_query($db, $query5);

  //metrame ta arxeia pou anevhkan kai to apothikeuoume sthn vash
	$query6 = "UPDATE users SET uploadNumber=uploadNumber+1 WHERE username = '$user'; ";
	mysqli_query($db, $query6);



   exit;

?>
