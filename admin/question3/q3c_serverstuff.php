<?php
$db = mysqli_connect('localhost', 'root', '', 'webdatabase');
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}


$erwthma3c[]=0;
$ContentType_public[]=0;
$Percentage_public[]=0;
$ContentType_private[]=0;
$Percentage_private[]=0;
$ContentType_no_cache[]=0;
$Percentage_no_cache[]=0;
$ContentType_no_store[]=0;
$Percentage_no_store[]=0;



$test = $_GET['number'];



// gia Vodafone
if ($test==1) {
$sql0="CREATE TABLE resultvod AS(SELECT CacheControl,ContentType,isp FROM headers WHERE isp LIKE '%oda%' OR isp LIKE '%hol%' OR isp LIKE '%ine%' AND CacheControl!='' AND ContentType!='' );";
$result0 = $db->query($sql0);

//Deutero erwthma:
$sql1="SELECT COUNT(CacheControl) FROM resultvod WHERE CacheControl
LIKE '%must-revalidate%' OR CacheControl
LIKE '%no-cache%' OR CacheControl
LIKE '%no-store%' OR CacheControl
LIKE '%no-transform%' OR CacheControl
LIKE '%public%' OR CacheControl
LIKE '%private%' OR CacheControl
LIKE '%proxy-revalidate%' OR CacheControl
LIKE '%max-age%'
OR CacheControl
LIKE '%s-maxage%';";
$result1 = $db->query($sql1);


if ($result1->num_rows > 0) {
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    //plithos request directive ana ContentType
    $hndpercent=$row["COUNT(CacheControl)"];
  }
} else {
  $erwthma3c[]=0;
  $ContentType_public[]=0;
  $Percentage_public[]=0;
  $ContentType_private[]=0;
  $Percentage_private[]=0;
  $ContentType_no_cache[]=0;
  $Percentage_no_cache[]=0;
  $ContentType_no_store[]=0;
  $Percentage_no_store[]=0;
}






$sql2="SELECT COUNT(CacheControl),ContentType FROM resultvod WHERE CacheControl LIKE '%public%' GROUP BY ContentType;";
$result2 = $db->query($sql2);

$b=0;
if ($result2->num_rows > 0) {

  while($row = $result2->fetch_assoc()) {
    //plithos  directive ana ContentType
    $cnt_public[$b]=$row["COUNT(CacheControl)"];
    $ContentType_public[$b]=$row["ContentType"];
    $Percentage_public[$b]=($cnt_public[$b]/$hndpercent)*100;
    $b++;
  }
} else {
  $erwthma3c[]=0;
  $ContentType_public[]=0;
  $Percentage_public[]=0;
  $ContentType_private[]=0;
  $Percentage_private[]=0;
  $ContentType_no_cache[]=0;
  $Percentage_no_cache[]=0;
  $ContentType_no_store[]=0;
  $Percentage_no_store[]=0;


}


$sql3="SELECT COUNT(CacheControl),ContentType FROM resultvod WHERE CacheControl LIKE '%private%' GROUP BY ContentType;";
$result3 = $db->query($sql3);

$c=0;
if ($result3->num_rows > 0) {

  while($row = $result3->fetch_assoc()) {
    //plithos  directive ana ContentType
    $cnt_private[$c]=$row["COUNT(CacheControl)"];
    $ContentType_private[$c]=$row["ContentType"];
    $Percentage_private[$c]=($cnt_private[$c]/$hndpercent)*100;
    $c++;
  }
} else {
  $erwthma3c[]=0;
  $ContentType_public[]=0;
  $Percentage_public[]=0;
  $ContentType_private[]=0;
  $Percentage_private[]=0;
  $ContentType_no_cache[]=0;
  $Percentage_no_cache[]=0;
  $ContentType_no_store[]=0;
  $Percentage_no_store[]=0;
}



$sql4="SELECT COUNT(CacheControl),ContentType FROM resultvod WHERE CacheControl LIKE '%no-cache%' GROUP BY ContentType;";
$result4 = $db->query($sql4);

$c=0;
if ($result4->num_rows > 0) {

  while($row = $result4->fetch_assoc()) {
    //plithos  directive ana ContentType
    $cnt_no_cache[$c]=$row["COUNT(CacheControl)"];
    $ContentType_no_cache[$c]=$row["ContentType"];
    $Percentage_no_cache[$c]=($cnt_no_cache[$c]/$hndpercent)*100;
    $c++;
  }
} else {
  $erwthma3c[]=0;
  $ContentType_public[]=0;
  $Percentage_public[]=0;
  $ContentType_private[]=0;
  $Percentage_private[]=0;
  $ContentType_no_cache[]=0;
  $Percentage_no_cache[]=0;
  $ContentType_no_store[]=0;
  $Percentage_no_store[]=0;
}




$sql5="SELECT COUNT(CacheControl),ContentType FROM resultvod WHERE CacheControl LIKE '%no-store%' GROUP BY ContentType;";
$result5 = $db->query($sql5);

$c=0;
if ($result5->num_rows > 0) {

  while($row = $result5->fetch_assoc()) {
    //plithos  directive ana ContentType
    $cnt_no_store[$c]=$row["COUNT(CacheControl)"];
    $ContentType_no_store[$c]=$row["ContentType"];
    $Percentage_no_store[$c]=($cnt_no_store[$c]/$hndpercent)*100;
    $c++;
  }
} else {
  $erwthma3c[]=0;
  $ContentType_public[]=0;
  $Percentage_public[]=0;
  $ContentType_private[]=0;
  $Percentage_private[]=0;
  $ContentType_no_cache[]=0;
  $Percentage_no_cache[]=0;
  $ContentType_no_store[]=0;
  $Percentage_no_store[]=0;
}


// creating json_structure...
class erwthma3c implements JsonSerializable
{

    protected $ContentType_public;
    protected $Percentage_public;
    protected $ContentType_private;
    protected $Percentage_private;
    protected $ContentType_no_cache;
    protected $Percentage_no_cache;
    protected $ContentType_no_store;
    protected $Percentage_no_store;

    public function __construct(array $data)
    {

        $this->ContentType_public = $data['ContentType_public'];
        $this->Percentage_public = $data['Percentage_public'];
        $this->ContentType_private = $data['ContentType_private'];
        $this->Percentage_private = $data['Percentage_private'];
        $this->ContentType_no_cache = $data['ContentType_no_cache'];
        $this->Percentage_no_cache = $data['Percentage_no_cache'];
        $this->ContentType_no_store = $data['ContentType_no_store'];
        $this->Percentage_no_store = $data['Percentage_no_store'];
    }

    public function getContentType_public()
    {
        return $this->ContentType_public;
    }

    public function getPercentage_public()
    {
        return $this->Percentage_public;
    }

    public function getContentType_private()
    {
        return $this->ContentType_private;
    }

    public function getPercentage_private()
    {
        return $this->Percentage_private;
    }

    public function getContentType_no_cache()
    {
        return $this->ContentType_no_cache;
    }

    public function getPercentage_no_cache()
    {
        return $this->Percentage_no_cache;
    }

    public function getContentType_no_store()
    {
        return $this->ContentType_no_store;
    }

    public function getPercentage_no_store()
    {
        return $this->Percentage_no_store;
    }

    public function jsonSerialize()
    {
        return
        [
            'ContentType_public'   => $this->getContentType_public(),
            'Percentage_public' => $this->getPercentage_public(),

            'ContentType_private'   => $this->getContentType_private(),
            'Percentage_private' => $this->getPercentage_private(),

            'ContentType_no_cache'   => $this->getContentType_no_cache(),
            'Percentage_no_cache' => $this->getPercentage_no_cache(),

            'ContentType_no_store'   => $this->getContentType_no_store(),
            'Percentage_no_store' => $this->getPercentage_no_store(),
        ];
    }
}

$size1=sizeof($ContentType_public);
$size2=sizeof($ContentType_private);
$size3=sizeof($ContentType_no_cache);
$size4=sizeof($ContentType_no_store);
$size=0;

$size=max($size1,$size2,$size3,$size4);

for ($j=0; $j <$size ; $j++) {


$erwthma3c[$j] = new erwthma3c(array('ContentType_public' => $ContentType_public[$j], 'Percentage_public' => $Percentage_public[$j],'ContentType_private' => $ContentType_private[$j], 'Percentage_private' => $Percentage_private[$j],'ContentType_no_cache' => $ContentType_no_cache[$j], 'Percentage_no_cache' => $Percentage_no_cache[$j],'ContentType_no_store' => $ContentType_no_store[$j], 'Percentage_no_store' => $Percentage_no_store[$j]));
error_reporting(0);
}
echo json_encode($erwthma3c);

$querytr="TRUNCATE TABLE resultvod;";
mysqli_query($db, $querytr);

$querydr = " DROP TABLE resultvod ;";
 mysqli_query($db, $querydr);

mysqli_close($db);
//telos gia vodafone
}elseif ($test==2) {
  //arxh cosmote
  $sql0="CREATE TABLE resultcos AS(SELECT CacheControl,ContentType,isp FROM headers WHERE isp LIKE '%ote%' OR isp LIKE '%OTE%' AND CacheControl!='' AND ContentType!='' );";
  $result0 = $db->query($sql0);

  //Deutero erwthma:
  $sql1="SELECT COUNT(CacheControl) FROM resultcos WHERE CacheControl
  LIKE '%must-revalidate%' OR CacheControl
  LIKE '%no-cache%' OR CacheControl
  LIKE '%no-store%' OR CacheControl
  LIKE '%no-transform%' OR CacheControl
  LIKE '%public%' OR CacheControl
  LIKE '%private%' OR CacheControl
  LIKE '%proxy-revalidate%' OR CacheControl
  LIKE '%max-age%'
  OR CacheControl
  LIKE '%s-maxage%';";
  $result1 = $db->query($sql1);


  if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
      //plithos request directive ana ContentType
      $hndpercent=$row["COUNT(CacheControl)"];
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }






  $sql2="SELECT COUNT(CacheControl),ContentType FROM resultcos WHERE CacheControl LIKE '%public%' GROUP BY ContentType;";
  $result2 = $db->query($sql2);

  $b=0;
  if ($result2->num_rows > 0) {

    while($row = $result2->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_public[$b]=$row["COUNT(CacheControl)"];
      $ContentType_public[$b]=$row["ContentType"];
      $Percentage_public[$b]=($cnt_public[$b]/$hndpercent)*100;
      $b++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;


  }


  $sql3="SELECT COUNT(CacheControl),ContentType FROM resultcos WHERE CacheControl LIKE '%private%' GROUP BY ContentType;";
  $result3 = $db->query($sql3);

  $c=0;
  if ($result3->num_rows > 0) {

    while($row = $result3->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_private[$c]=$row["COUNT(CacheControl)"];
      $ContentType_private[$c]=$row["ContentType"];
      $Percentage_private[$c]=($cnt_private[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }



  $sql4="SELECT COUNT(CacheControl),ContentType FROM resultcos WHERE CacheControl LIKE '%no-cache%' GROUP BY ContentType;";
  $result4 = $db->query($sql4);

  $c=0;
  if ($result4->num_rows > 0) {

    while($row = $result4->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_no_cache[$c]=$row["COUNT(CacheControl)"];
      $ContentType_no_cache[$c]=$row["ContentType"];
      $Percentage_no_cache[$c]=($cnt_no_cache[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }




  $sql5="SELECT COUNT(CacheControl),ContentType FROM resultcos WHERE CacheControl LIKE '%no-store%' GROUP BY ContentType;";
  $result5 = $db->query($sql5);

  $e=0;
  if ($result5->num_rows > 0) {

    while($row = $result5->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_no_store[$c]=$row["COUNT(CacheControl)"];
      $ContentType_no_store[$c]=$row["ContentType"];
      $Percentage_no_store[$c]=($cnt_no_store[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }


  // creating json_structure...
  class erwthma3c implements JsonSerializable
  {

      protected $ContentType_public;
      protected $Percentage_public;
      protected $ContentType_private;
      protected $Percentage_private;
      protected $ContentType_no_cache;
      protected $Percentage_no_cache;
      protected $ContentType_no_store;
      protected $Percentage_no_store;

      public function __construct(array $data)
      {

          $this->ContentType_public = $data['ContentType_public'];
          $this->Percentage_public = $data['Percentage_public'];
          $this->ContentType_private = $data['ContentType_private'];
          $this->Percentage_private = $data['Percentage_private'];
          $this->ContentType_no_cache = $data['ContentType_no_cache'];
          $this->Percentage_no_cache = $data['Percentage_no_cache'];
          $this->ContentType_no_store = $data['ContentType_no_store'];
          $this->Percentage_no_store = $data['Percentage_no_store'];
      }

      public function getContentType_public()
      {
          return $this->ContentType_public;
      }

      public function getPercentage_public()
      {
          return $this->Percentage_public;
      }

      public function getContentType_private()
      {
          return $this->ContentType_private;
      }

      public function getPercentage_private()
      {
          return $this->Percentage_private;
      }

      public function getContentType_no_cache()
      {
          return $this->ContentType_no_cache;
      }

      public function getPercentage_no_cache()
      {
          return $this->Percentage_no_cache;
      }

      public function getContentType_no_store()
      {
          return $this->ContentType_no_store;
      }

      public function getPercentage_no_store()
      {
          return $this->Percentage_no_store;
      }

      public function jsonSerialize()
      {
          return
          [
              'ContentType_public'   => $this->getContentType_public(),
              'Percentage_public' => $this->getPercentage_public(),

              'ContentType_private'   => $this->getContentType_private(),
              'Percentage_private' => $this->getPercentage_private(),

              'ContentType_no_cache'   => $this->getContentType_no_cache(),
              'Percentage_no_cache' => $this->getPercentage_no_cache(),

              'ContentType_no_store'   => $this->getContentType_no_store(),
              'Percentage_no_store' => $this->getPercentage_no_store(),
          ];
      }
  }

  $size1=sizeof($ContentType_public);
  $size2=sizeof($ContentType_private);
  $size3=sizeof($ContentType_no_cache);
  $size4=sizeof($ContentType_no_store);
  $size=0;

  $size=max($size1,$size2,$size3,$size4);

  for ($j=0; $j <$size ; $j++) {


  $erwthma3c[$j] = new erwthma3c(array('ContentType_public' => $ContentType_public[$j], 'Percentage_public' => $Percentage_public[$j],'ContentType_private' => $ContentType_private[$j], 'Percentage_private' => $Percentage_private[$j],'ContentType_no_cache' => $ContentType_no_cache[$j], 'Percentage_no_cache' => $Percentage_no_cache[$j],'ContentType_no_store' => $ContentType_no_store[$j], 'Percentage_no_store' => $Percentage_no_store[$j]));
  error_reporting(0);
  }
  echo json_encode($erwthma3c);

  $querytr="TRUNCATE TABLE resultcos;";
  mysqli_query($db, $querytr);

  $querydr = " DROP TABLE resultcos ;";
   mysqli_query($db, $querydr);

  mysqli_close($db);
  //telos gia cosmote
}elseif ($test==3) {
  //arxh wind
  $sql0="CREATE TABLE resultwind AS(SELECT CacheControl,ContentType,isp FROM headers WHERE isp LIKE '%win%' OR isp LIKE '%WIN%' OR isp LIKE '%Win%' AND CacheControl!='' AND ContentType!='' );";
  $result0 = $db->query($sql0);

  //Deutero erwthma:
  $sql1="SELECT COUNT(CacheControl) FROM resultwind WHERE CacheControl
  LIKE '%must-revalidate%' OR CacheControl
  LIKE '%no-cache%' OR CacheControl
  LIKE '%no-store%' OR CacheControl
  LIKE '%no-transform%' OR CacheControl
  LIKE '%public%' OR CacheControl
  LIKE '%private%' OR CacheControl
  LIKE '%proxy-revalidate%' OR CacheControl
  LIKE '%max-age%'
  OR CacheControl
  LIKE '%s-maxage%';";
  $result1 = $db->query($sql1);


  if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
      //plithos request directive ana ContentType
      $hndpercent=$row["COUNT(CacheControl)"];
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }






  $sql2="SELECT COUNT(CacheControl),ContentType FROM resultwind WHERE CacheControl LIKE '%public%' GROUP BY ContentType;";
  $result2 = $db->query($sql2);

  $b=0;
  if ($result2->num_rows > 0) {

    while($row = $result2->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_public[$b]=$row["COUNT(CacheControl)"];
      $ContentType_public[$b]=$row["ContentType"];
      $Percentage_public[$b]=($cnt_public[$b]/$hndpercent)*100;
      $b++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;


  }


  $sql3="SELECT COUNT(CacheControl),ContentType FROM resultwind WHERE CacheControl LIKE '%private%' GROUP BY ContentType;";
  $result3 = $db->query($sql3);

  $c=0;
  if ($result3->num_rows > 0) {

    while($row = $result3->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_private[$c]=$row["COUNT(CacheControl)"];
      $ContentType_private[$c]=$row["ContentType"];
      $Percentage_private[$c]=($cnt_private[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }



  $sql4="SELECT COUNT(CacheControl),ContentType FROM resultwind WHERE CacheControl LIKE '%no-cache%' GROUP BY ContentType;";
  $result4 = $db->query($sql4);

  $c=0;
  if ($result4->num_rows > 0) {

    while($row = $result4->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_no_cache[$c]=$row["COUNT(CacheControl)"];
      $ContentType_no_cache[$c]=$row["ContentType"];
      $Percentage_no_cache[$c]=($cnt_no_cache[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }




  $sql5="SELECT COUNT(CacheControl),ContentType FROM resultwind WHERE CacheControl LIKE '%no-store%' GROUP BY ContentType;";
  $result5 = $db->query($sql5);

  $c=0;
  if ($result5->num_rows > 0) {

    while($row = $result5->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_no_store[$c]=$row["COUNT(CacheControl)"];
      $ContentType_no_store[$c]=$row["ContentType"];
      $Percentage_no_store[$c]=($cnt_no_store[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }


  // creating json_structure...
  class erwthma3c implements JsonSerializable
  {

      protected $ContentType_public;
      protected $Percentage_public;
      protected $ContentType_private;
      protected $Percentage_private;
      protected $ContentType_no_cache;
      protected $Percentage_no_cache;
      protected $ContentType_no_store;
      protected $Percentage_no_store;

      public function __construct(array $data)
      {

          $this->ContentType_public = $data['ContentType_public'];
          $this->Percentage_public = $data['Percentage_public'];
          $this->ContentType_private = $data['ContentType_private'];
          $this->Percentage_private = $data['Percentage_private'];
          $this->ContentType_no_cache = $data['ContentType_no_cache'];
          $this->Percentage_no_cache = $data['Percentage_no_cache'];
          $this->ContentType_no_store = $data['ContentType_no_store'];
          $this->Percentage_no_store = $data['Percentage_no_store'];
      }

      public function getContentType_public()
      {
          return $this->ContentType_public;
      }

      public function getPercentage_public()
      {
          return $this->Percentage_public;
      }

      public function getContentType_private()
      {
          return $this->ContentType_private;
      }

      public function getPercentage_private()
      {
          return $this->Percentage_private;
      }

      public function getContentType_no_cache()
      {
          return $this->ContentType_no_cache;
      }

      public function getPercentage_no_cache()
      {
          return $this->Percentage_no_cache;
      }

      public function getContentType_no_store()
      {
          return $this->ContentType_no_store;
      }

      public function getPercentage_no_store()
      {
          return $this->Percentage_no_store;
      }

      public function jsonSerialize()
      {
          return
          [
              'ContentType_public'   => $this->getContentType_public(),
              'Percentage_public' => $this->getPercentage_public(),

              'ContentType_private'   => $this->getContentType_private(),
              'Percentage_private' => $this->getPercentage_private(),

              'ContentType_no_cache'   => $this->getContentType_no_cache(),
              'Percentage_no_cache' => $this->getPercentage_no_cache(),

              'ContentType_no_store'   => $this->getContentType_no_store(),
              'Percentage_no_store' => $this->getPercentage_no_store(),
          ];
      }
  }

  $size1=sizeof($ContentType_public);
  $size2=sizeof($ContentType_private);
  $size3=sizeof($ContentType_no_cache);
  $size4=sizeof($ContentType_no_store);
  $size=0;

  $size=max($size1,$size2,$size3,$size4);

  for ($j=0; $j <$size ; $j++) {


  $erwthma3c[$j] = new erwthma3c(array('ContentType_public' => $ContentType_public[$j], 'Percentage_public' => $Percentage_public[$j],'ContentType_private' => $ContentType_private[$j], 'Percentage_private' => $Percentage_private[$j],'ContentType_no_cache' => $ContentType_no_cache[$j], 'Percentage_no_cache' => $Percentage_no_cache[$j],'ContentType_no_store' => $ContentType_no_store[$j], 'Percentage_no_store' => $Percentage_no_store[$j]));
  error_reporting(0);
  }
  echo json_encode($erwthma3c);

  $querytr="TRUNCATE TABLE resultwind;";
  mysqli_query($db, $querytr);

  $querydr = " DROP TABLE resultwind ;";
   mysqli_query($db, $querydr);

  mysqli_close($db);
  //telos gia wind
}elseif ($test==4) {
  //arxh forthnet
  $sql0="CREATE TABLE resultfor AS(SELECT CacheControl,ContentType,isp FROM headers WHERE isp LIKE '%forth%' OR isp LIKE '%For%' OR isp LIKE '%FOR%' AND CacheControl!='' AND ContentType!='' );";
  $result0 = $db->query($sql0);

  //Deutero erwthma:
  $sql1="SELECT COUNT(CacheControl) FROM resultfor WHERE CacheControl
  LIKE '%must-revalidate%' OR CacheControl
  LIKE '%no-cache%' OR CacheControl
  LIKE '%no-store%' OR CacheControl
  LIKE '%no-transform%' OR CacheControl
  LIKE '%public%' OR CacheControl
  LIKE '%private%' OR CacheControl
  LIKE '%proxy-revalidate%' OR CacheControl
  LIKE '%max-age%'
  OR CacheControl
  LIKE '%s-maxage%';";
  $result1 = $db->query($sql1);


  if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
      //plithos request directive ana ContentType
      $hndpercent=$row["COUNT(CacheControl)"];
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }






  $sql2="SELECT COUNT(CacheControl),ContentType FROM resultfor WHERE CacheControl LIKE '%public%' GROUP BY ContentType;";
  $result2 = $db->query($sql2);

  $b=0;
  if ($result2->num_rows > 0) {

    while($row = $result2->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_public[$b]=$row["COUNT(CacheControl)"];
      $ContentType_public[$b]=$row["ContentType"];
      $Percentage_public[$b]=($cnt_public[$b]/$hndpercent)*100;
      $b++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;


  }


  $sql3="SELECT COUNT(CacheControl),ContentType FROM resultfor WHERE CacheControl LIKE '%private%' GROUP BY ContentType;";
  $result3 = $db->query($sql3);

  $c=0;
  if ($result3->num_rows > 0) {

    while($row = $result3->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_private[$c]=$row["COUNT(CacheControl)"];
      $ContentType_private[$c]=$row["ContentType"];
      $Percentage_private[$c]=($cnt_private[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }



  $sql4="SELECT COUNT(CacheControl),ContentType FROM resultfor WHERE CacheControl LIKE '%no-cache%' GROUP BY ContentType;";
  $result4 = $db->query($sql4);

  $c=0;
  if ($result4->num_rows > 0) {

    while($row = $result4->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_no_cache[$c]=$row["COUNT(CacheControl)"];
      $ContentType_no_cache[$c]=$row["ContentType"];
      $Percentage_no_cache[$c]=($cnt_no_cache[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }




  $sql5="SELECT COUNT(CacheControl),ContentType FROM resultfor WHERE CacheControl LIKE '%no-store%' GROUP BY ContentType;";
  $result5 = $db->query($sql5);

  $c=0;
  if ($result5->num_rows > 0) {

    while($row = $result5->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_no_store[$c]=$row["COUNT(CacheControl)"];
      $ContentType_no_store[$c]=$row["ContentType"];
      $Percentage_no_store[$c]=($cnt_no_store[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }


  // creating json_structure...
  class erwthma3c implements JsonSerializable
  {

      protected $ContentType_public;
      protected $Percentage_public;
      protected $ContentType_private;
      protected $Percentage_private;
      protected $ContentType_no_cache;
      protected $Percentage_no_cache;
      protected $ContentType_no_store;
      protected $Percentage_no_store;

      public function __construct(array $data)
      {

          $this->ContentType_public = $data['ContentType_public'];
          $this->Percentage_public = $data['Percentage_public'];
          $this->ContentType_private = $data['ContentType_private'];
          $this->Percentage_private = $data['Percentage_private'];
          $this->ContentType_no_cache = $data['ContentType_no_cache'];
          $this->Percentage_no_cache = $data['Percentage_no_cache'];
          $this->ContentType_no_store = $data['ContentType_no_store'];
          $this->Percentage_no_store = $data['Percentage_no_store'];
      }

      public function getContentType_public()
      {
          return $this->ContentType_public;
      }

      public function getPercentage_public()
      {
          return $this->Percentage_public;
      }

      public function getContentType_private()
      {
          return $this->ContentType_private;
      }

      public function getPercentage_private()
      {
          return $this->Percentage_private;
      }

      public function getContentType_no_cache()
      {
          return $this->ContentType_no_cache;
      }

      public function getPercentage_no_cache()
      {
          return $this->Percentage_no_cache;
      }

      public function getContentType_no_store()
      {
          return $this->ContentType_no_store;
      }

      public function getPercentage_no_store()
      {
          return $this->Percentage_no_store;
      }

      public function jsonSerialize()
      {
          return
          [
              'ContentType_public'   => $this->getContentType_public(),
              'Percentage_public' => $this->getPercentage_public(),

              'ContentType_private'   => $this->getContentType_private(),
              'Percentage_private' => $this->getPercentage_private(),

              'ContentType_no_cache'   => $this->getContentType_no_cache(),
              'Percentage_no_cache' => $this->getPercentage_no_cache(),

              'ContentType_no_store'   => $this->getContentType_no_store(),
              'Percentage_no_store' => $this->getPercentage_no_store(),
          ];
      }
  }

  $size1=sizeof($ContentType_public);
  $size2=sizeof($ContentType_private);
  $size3=sizeof($ContentType_no_cache);
  $size4=sizeof($ContentType_no_store);
  $size=0;

  $size=max($size1,$size2,$size3,$size4);

  for ($j=0; $j <$size ; $j++) {


  $erwthma3c[$j] = new erwthma3c(array('ContentType_public' => $ContentType_public[$j], 'Percentage_public' => $Percentage_public[$j],'ContentType_private' => $ContentType_private[$j], 'Percentage_private' => $Percentage_private[$j],'ContentType_no_cache' => $ContentType_no_cache[$j], 'Percentage_no_cache' => $Percentage_no_cache[$j],'ContentType_no_store' => $ContentType_no_store[$j], 'Percentage_no_store' => $Percentage_no_store[$j]));
  error_reporting(0);
  }
  echo json_encode($erwthma3c);

  $querytr="TRUNCATE TABLE resultfor;";
  mysqli_query($db, $querytr);

  $querydr = " DROP TABLE resultfor ;";
   mysqli_query($db, $querydr);

  mysqli_close($db);
  //telos gia forthnet
}



//arxh gia olous tous paroxous
if ($test==5) {


  //Deutero erwthma:
  $sql1="SELECT COUNT(CacheControl) FROM headers WHERE CacheControl
  LIKE '%must-revalidate%' OR CacheControl
  LIKE '%no-cache%' OR CacheControl
  LIKE '%no-store%' OR CacheControl
  LIKE '%no-transform%' OR CacheControl
  LIKE '%public%' OR CacheControl
  LIKE '%private%' OR CacheControl
  LIKE '%proxy-revalidate%' OR CacheControl
  LIKE '%max-age%'
  OR CacheControl
  LIKE '%s-maxage%';";
  $result1 = $db->query($sql1);


  if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
      //plithos request directive ana ContentType
      $hndpercent=$row["COUNT(CacheControl)"];
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }






  $sql2="SELECT COUNT(CacheControl),ContentType FROM headers WHERE CacheControl LIKE '%public%' GROUP BY ContentType;";
  $result2 = $db->query($sql2);

  $b=0;
  if ($result2->num_rows > 0) {

    while($row = $result2->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_public[$b]=$row["COUNT(CacheControl)"];
      $ContentType_public[$b]=$row["ContentType"];
      $Percentage_public[$b]=($cnt_public[$b]/$hndpercent)*100;
      $b++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;


  }


  $sql3="SELECT COUNT(CacheControl),ContentType FROM headers WHERE CacheControl LIKE '%private%' GROUP BY ContentType;";
  $result3 = $db->query($sql3);

  $c=0;
  if ($result3->num_rows > 0) {

    while($row = $result3->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_private[$c]=$row["COUNT(CacheControl)"];
      $ContentType_private[$c]=$row["ContentType"];
      $Percentage_private[$c]=($cnt_private[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }



  $sql4="SELECT COUNT(CacheControl),ContentType FROM headers WHERE CacheControl LIKE '%no-cache%' GROUP BY ContentType;";
  $result4 = $db->query($sql4);

  $c=0;
  if ($result4->num_rows > 0) {

    while($row = $result4->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_no_cache[$c]=$row["COUNT(CacheControl)"];
      $ContentType_no_cache[$c]=$row["ContentType"];
      $Percentage_no_cache[$c]=($cnt_no_cache[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }




  $sql5="SELECT COUNT(CacheControl),ContentType FROM headers WHERE CacheControl LIKE '%no-store%' GROUP BY ContentType;";
  $result5 = $db->query($sql5);

  $c=0;
  if ($result5->num_rows > 0) {

    while($row = $result5->fetch_assoc()) {
      //plithos  directive ana ContentType
      $cnt_no_store[$c]=$row["COUNT(CacheControl)"];
      $ContentType_no_store[$c]=$row["ContentType"];
      $Percentage_no_store[$c]=($cnt_no_store[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3c[]=0;
    $ContentType_public[]=0;
    $Percentage_public[]=0;
    $ContentType_private[]=0;
    $Percentage_private[]=0;
    $ContentType_no_cache[]=0;
    $Percentage_no_cache[]=0;
    $ContentType_no_store[]=0;
    $Percentage_no_store[]=0;
  }


  // creating json_structure...
  class erwthma3c implements JsonSerializable
  {

      protected $ContentType_public;
      protected $Percentage_public;
      protected $ContentType_private;
      protected $Percentage_private;
      protected $ContentType_no_cache;
      protected $Percentage_no_cache;
      protected $ContentType_no_store;
      protected $Percentage_no_store;

      public function __construct(array $data)
      {

          $this->ContentType_public = $data['ContentType_public'];
          $this->Percentage_public = $data['Percentage_public'];
          $this->ContentType_private = $data['ContentType_private'];
          $this->Percentage_private = $data['Percentage_private'];
          $this->ContentType_no_cache = $data['ContentType_no_cache'];
          $this->Percentage_no_cache = $data['Percentage_no_cache'];
          $this->ContentType_no_store = $data['ContentType_no_store'];
          $this->Percentage_no_store = $data['Percentage_no_store'];
      }

      public function getContentType_public()
      {
          return $this->ContentType_public;
      }

      public function getPercentage_public()
      {
          return $this->Percentage_public;
      }

      public function getContentType_private()
      {
          return $this->ContentType_private;
      }

      public function getPercentage_private()
      {
          return $this->Percentage_private;
      }

      public function getContentType_no_cache()
      {
          return $this->ContentType_no_cache;
      }

      public function getPercentage_no_cache()
      {
          return $this->Percentage_no_cache;
      }

      public function getContentType_no_store()
      {
          return $this->ContentType_no_store;
      }

      public function getPercentage_no_store()
      {
          return $this->Percentage_no_store;
      }

      public function jsonSerialize()
      {
          return
          [
              'ContentType_public'   => $this->getContentType_public(),
              'Percentage_public' => $this->getPercentage_public(),

              'ContentType_private'   => $this->getContentType_private(),
              'Percentage_private' => $this->getPercentage_private(),

              'ContentType_no_cache'   => $this->getContentType_no_cache(),
              'Percentage_no_cache' => $this->getPercentage_no_cache(),

              'ContentType_no_store'   => $this->getContentType_no_store(),
              'Percentage_no_store' => $this->getPercentage_no_store(),
          ];
      }
  }

  $size1=sizeof($ContentType_public);
  $size2=sizeof($ContentType_private);
  $size3=sizeof($ContentType_no_cache);
  $size4=sizeof($ContentType_no_store);
  $size=0;

  $size=max($size1,$size2,$size3,$size4);

  for ($j=0; $j <$size ; $j++) {


  $erwthma3c[$j] = new erwthma3c(array('ContentType_public' => $ContentType_public[$j], 'Percentage_public' => $Percentage_public[$j],'ContentType_private' => $ContentType_private[$j], 'Percentage_private' => $Percentage_private[$j],'ContentType_no_cache' => $ContentType_no_cache[$j], 'Percentage_no_cache' => $Percentage_no_cache[$j],
  'ContentType_no_store' => $ContentType_no_store[$j], 'Percentage_no_store' => $Percentage_no_store[$j]));
  error_reporting(0);
  }
  echo json_encode($erwthma3c);


  mysqli_close($db);
  //telos gia olous tous paroxous
}
 ?>
