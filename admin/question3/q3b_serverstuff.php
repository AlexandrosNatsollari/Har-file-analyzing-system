<?php
$db = mysqli_connect('localhost', 'root', '', 'webdatabase');
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}


$erwthma3b[]=0;
$ContentType_sta[]=0;
$Percentage_stale[]=0;
$ContentType_fre[]=0;
$Percentage_fresh[]=0;


//to number dhlwnei ton paroxo pou tha asxolithoume
$test = $_GET['number'];

//stale/fresh gia Vodafone
if ($test==1) {

$sql0="CREATE TABLE resultvod AS(SELECT CacheControl,ContentType,isp FROM headers WHERE isp LIKE '%oda%' OR isp LIKE '%hol%' OR isp LIKE '%ine%' AND CacheControl!='' AND ContentType!='' );";
$result0 = $db->query($sql0);

//Deutero erwthma:
//vriskoume to synolo twn CacheControl
$sql1="SELECT COUNT(CacheControl) FROM resultvod WHERE CacheControl
LIKE '%max-age%' OR CacheControl
LIKE '%max-stale%' OR CacheControl
LIKE '%min-fresh%' OR CacheControl
LIKE '%no-cache%' OR CacheControl
LIKE '%no-store%' OR CacheControl
LIKE '%no-transform%'
OR CacheControl
LIKE '%only-if-cached%';";
$result1 = $db->query($sql1);


if ($result1->num_rows > 0) {
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    //plithos request directive ana ContentType
    $hndpercent=$row["COUNT(CacheControl)"];
  }
} else {
  $erwthma3b[]=0;
  $ContentType_sta[]=0;
  $Percentage_stale[]=0;
  $ContentType_fre[]=0;
  $Percentage_fresh[]=0;
}





//vriskoume to synolo twn max-stale ana ContentType
$sql2="SELECT COUNT(CacheControl),ContentType FROM resultvod WHERE CacheControl LIKE '%max-stale%' GROUP BY ContentType;";
$result2 = $db->query($sql2);

$b=0;
if ($result2->num_rows > 0) {

  while($row = $result2->fetch_assoc()) {
    //plithos max-stale directive ana ContentType
    $cnt_max_stale[$b]=$row["COUNT(CacheControl)"];
    $ContentType_sta[$b]=$row["ContentType"];
    //vriskoume to pososto pou zhtaei
    $Percentage_stale[$b]=($cnt_max_stale[$b]/$hndpercent)*100;
    $b++;
  }
} else {
  $erwthma3b[]=0;
  $ContentType_sta[]=0;
  $Percentage_stale[]=0;
  $ContentType_fre[]=0;
  $Percentage_fresh[]=0;
}


$sql3="SELECT COUNT(CacheControl),ContentType FROM resultvod WHERE CacheControl LIKE '%min-fresh%' GROUP BY ContentType;";
$result3 = $db->query($sql3);

$c=0;
if ($result3->num_rows > 0) {

  while($row = $result3->fetch_assoc()) {
    //plithos min-fresh directive ana ContentType
    $cnt_min_fresh[$c]=$row["COUNT(CacheControl)"];
    $ContentType_fre[$c]=$row["ContentType"];
    $Percentage_fresh[$c]=($cnt_min_fresh[$c]/$hndpercent)*100;
    $c++;
  }
} else {
  $erwthma3b[]=0;
  $ContentType_sta[]=0;
  $Percentage_stale[]=0;
  $ContentType_fre[]=0;
  $Percentage_fresh[]=0;
}



// creating json_structure...
class erwthma3b implements JsonSerializable
{
    protected $ContentType_sta;
    protected $Percentage_stale;
    protected $ContentType_fre;
    protected $Percentage_fresh;

    public function __construct(array $data)
    {
        $this->ContentType_sta = $data['ContentType_sta'];
        $this->Percentage_stale = $data['stale_percentage'];
        $this->ContentType_fre = $data['ContentType_fre'];
        $this->Percentage_fresh = $data['fresh_percentage'];
    }

    public function getContentType_sta()
    {
        return $this->ContentType_sta;
    }

    public function getstale_percentage()
    {
        return $this->Percentage_stale;
    }

    public function getContentType_fre()
    {
        return $this->ContentType_fre;
    }

    public function getPercentage_fresh()
    {
        return $this->Percentage_fresh;
    }

    public function jsonSerialize()
    {
        return
        [
            'ContentType_sta'   => $this->getContentType_sta(),
            'stale_percentage' => $this->getstale_percentage(),
            'ContentType_fre' => $this->getContentType_fre(),
            'fresh_percentage' => $this->getPercentage_fresh()
        ];
    }
}

$size1=sizeof($ContentType_sta);
$size2=sizeof($ContentType_fre);
$size=0;

if ($size1>=$size2) {
  $size=$size1;
}else {
  $size=$size2;
}

for ($j=0; $j <$size ; $j++) {


$erwthma3b[$j] = new erwthma3b(array('ContentType_sta' => $ContentType_sta[$j], 'stale_percentage' => $Percentage_stale[$j],'ContentType_fre' => $ContentType_fre[$j], 'fresh_percentage' => $Percentage_fresh[$j]));
error_reporting(0);
}
echo json_encode($erwthma3b);

$querytr="TRUNCATE TABLE resultvod;";
mysqli_query($db, $querytr);

$querydr = " DROP TABLE resultvod ;";
 mysqli_query($db, $querydr);

mysqli_close($db);
//telos stale/fresh gia vodafone
}elseif ($test==2) {
  // arxh stale/fresh gia Cosmote
  $sql0="CREATE TABLE resultcos AS(SELECT CacheControl,ContentType,isp FROM headers WHERE isp LIKE '%ote%' OR isp LIKE '%OTE%' AND CacheControl!='' AND ContentType!='' );";
  $result0 = $db->query($sql0);

  //Deutero erwthma:
  $sql1="SELECT COUNT(CacheControl) FROM resultcos WHERE CacheControl
  LIKE '%max-age%' OR CacheControl
  LIKE '%max-stale%' OR CacheControl
  LIKE '%min-fresh%' OR CacheControl
  LIKE '%no-cache%' OR CacheControl
  LIKE '%no-store%' OR CacheControl
  LIKE '%no-transform%'
  OR CacheControl
  LIKE '%only-if-cached%';";
  $result1 = $db->query($sql1);


  if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
      //plithos request directive ana ContentType
      $hndpercent=$row["COUNT(CacheControl)"];
    }
  } else {
    $erwthma3b[]=0;
    $ContentType_sta[]=0;
    $Percentage_stale[]=0;
    $ContentType_fre[]=0;
    $Percentage_fresh[]=0;
  }






  $sql2="SELECT COUNT(CacheControl),ContentType FROM resultcos WHERE CacheControl LIKE '%max-stale%' GROUP BY ContentType;";
  $result2 = $db->query($sql2);

  $b=0;
  if ($result2->num_rows > 0) {

    while($row = $result2->fetch_assoc()) {
      //plithos max-stale directive ana ContentType
      $cnt_max_stale[$b]=$row["COUNT(CacheControl)"];
      $ContentType_sta[$b]=$row["ContentType"];
      $Percentage_stale[$b]=($cnt_max_stale[$b]/$hndpercent)*100;
      $b++;
    }
  } else {
    $erwthma3b[]=0;
    $ContentType_sta[]=0;
    $Percentage_stale[]=0;
    $ContentType_fre[]=0;
    $Percentage_fresh[]=0;
  }


  $sql3="SELECT COUNT(CacheControl),ContentType FROM resultcos WHERE CacheControl LIKE '%min-fresh%' GROUP BY ContentType;";
  $result3 = $db->query($sql3);

  $c=0;
  if ($result3->num_rows > 0) {

    while($row = $result3->fetch_assoc()) {
      //plithos max-stale directive ana ContentType
      $cnt_min_fresh[$c]=$row["COUNT(CacheControl)"];
      $ContentType_fre[$c]=$row["ContentType"];
      $Percentage_fresh[$c]=($cnt_min_fresh[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3b[]=0;
    $ContentType_sta[]=0;
    $Percentage_stale[]=0;
    $ContentType_fre[]=0;
    $Percentage_fresh[]=0;
  }



  // creating json_structure...
  class erwthma3b implements JsonSerializable
  {
      protected $ContentType_sta;
      protected $Percentage_stale;
      protected $ContentType_fre;
      protected $Percentage_fresh;

      public function __construct(array $data)
      {
          $this->ContentType_sta = $data['ContentType_sta'];
          $this->Percentage_stale = $data['stale_percentage'];
          $this->ContentType_fre = $data['ContentType_fre'];
          $this->Percentage_fresh = $data['fresh_percentage'];
      }

      public function getContentType_sta()
      {
          return $this->ContentType_sta;
      }

      public function getstale_percentage()
      {
          return $this->Percentage_stale;
      }

      public function getContentType_fre()
      {
          return $this->ContentType_fre;
      }

      public function getPercentage_fresh()
      {
          return $this->Percentage_fresh;
      }

      public function jsonSerialize()
      {
          return
          [
              'ContentType_sta'   => $this->getContentType_sta(),
              'stale_percentage' => $this->getstale_percentage(),
              'ContentType_fre' => $this->getContentType_fre(),
              'fresh_percentage' => $this->getPercentage_fresh()
          ];
      }
  }

  $size1=sizeof($ContentType_sta);
  $size2=sizeof($ContentType_fre);
  $size=0;

  if ($size1>=$size2) {
    $size=$size1;
  }else {
    $size=$size2;
  }

  for ($j=0; $j <$size ; $j++) {


  $erwthma3b[$j] = new erwthma3b(array('ContentType_sta' => $ContentType_sta[$j], 'stale_percentage' => $Percentage_stale[$j],'ContentType_fre' => $ContentType_fre[$j], 'fresh_percentage' => $Percentage_fresh[$j]));
  error_reporting(0);
  }
  echo json_encode($erwthma3b);

  $querytr="TRUNCATE TABLE resultcos;";
  mysqli_query($db, $querytr);

  $querydr = " DROP TABLE resultcos ;";
   mysqli_query($db, $querydr);

  mysqli_close($db);
  //telos stale/fresh gia Cosmote
}elseif ($test==3) {
  //arxh stale/fresh gia Wind
  $sql0="CREATE TABLE resultwind AS(SELECT CacheControl,ContentType,isp FROM headers WHERE isp LIKE '%win%' OR isp LIKE '%WIN%' OR isp LIKE '%Win%' AND CacheControl!='' AND ContentType!='' );";
  $result0 = $db->query($sql0);

  //Deutero erwthma:
  $sql1="SELECT COUNT(CacheControl) FROM resultwind WHERE CacheControl
  LIKE '%max-age%' OR CacheControl
  LIKE '%max-stale%' OR CacheControl
  LIKE '%min-fresh%' OR CacheControl
  LIKE '%no-cache%' OR CacheControl
  LIKE '%no-store%' OR CacheControl
  LIKE '%no-transform%'
  OR CacheControl
  LIKE '%only-if-cached%';";
  $result1 = $db->query($sql1);


  if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
      //plithos request directive ana ContentType
      $hndpercent=$row["COUNT(CacheControl)"];
    }
  } else {
    $erwthma3b[]=0;
    $ContentType_sta[]=0;
    $Percentage_stale[]=0;
    $ContentType_fre[]=0;
    $Percentage_fresh[]=0;
  }






  $sql2="SELECT COUNT(CacheControl),ContentType FROM resultwind WHERE CacheControl LIKE '%max-stale%' GROUP BY ContentType;";
  $result2 = $db->query($sql2);

  $b=0;
  if ($result2->num_rows > 0) {

    while($row = $result2->fetch_assoc()) {
      //plithos max-stale directive ana ContentType
      $cnt_max_stale[$b]=$row["COUNT(CacheControl)"];
      $ContentType_sta[$b]=$row["ContentType"];
      $Percentage_stale[$b]=($cnt_max_stale[$b]/$hndpercent)*100;
      $b++;
    }
  } else {
    $erwthma3b[]=0;
    $ContentType_sta[]=0;
    $Percentage_stale[]=0;
    $ContentType_fre[]=0;
    $Percentage_fresh[]=0;
  }


  $sql3="SELECT COUNT(CacheControl),ContentType FROM resultwind WHERE CacheControl LIKE '%min-fresh%' GROUP BY ContentType;";
  $result3 = $db->query($sql3);

  $c=0;
  if ($result3->num_rows > 0) {

    while($row = $result3->fetch_assoc()) {
      //plithos max-stale directive ana ContentType
      $cnt_min_fresh[$c]=$row["COUNT(CacheControl)"];
      $ContentType_fre[$c]=$row["ContentType"];
      $Percentage_fresh[$c]=($cnt_min_fresh[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3b[]=0;
    $ContentType_sta[]=0;
    $Percentage_stale[]=0;
    $ContentType_fre[]=0;
    $Percentage_fresh[]=0;
  }



  // creating json_structure...
  class erwthma3b implements JsonSerializable
  {
      protected $ContentType_sta;
      protected $Percentage_stale;
      protected $ContentType_fre;
      protected $Percentage_fresh;

      public function __construct(array $data)
      {
          $this->ContentType_sta = $data['ContentType_sta'];
          $this->Percentage_stale = $data['stale_percentage'];
          $this->ContentType_fre = $data['ContentType_fre'];
          $this->Percentage_fresh = $data['fresh_percentage'];
      }

      public function getContentType_sta()
      {
          return $this->ContentType_sta;
      }

      public function getstale_percentage()
      {
          return $this->Percentage_stale;
      }

      public function getContentType_fre()
      {
          return $this->ContentType_fre;
      }

      public function getPercentage_fresh()
      {
          return $this->Percentage_fresh;
      }

      public function jsonSerialize()
      {
          return
          [
              'ContentType_sta'   => $this->getContentType_sta(),
              'stale_percentage' => $this->getstale_percentage(),
              'ContentType_fre' => $this->getContentType_fre(),
              'fresh_percentage' => $this->getPercentage_fresh()
          ];
      }
  }

  $size1=sizeof($ContentType_sta);
  $size2=sizeof($ContentType_fre);
  $size=0;

  if ($size1>=$size2) {
    $size=$size1;
  }else {
    $size=$size2;
  }

  for ($j=0; $j <$size ; $j++) {


  $erwthma3b[$j] = new erwthma3b(array('ContentType_sta' => $ContentType_sta[$j], 'stale_percentage' => $Percentage_stale[$j],'ContentType_fre' => $ContentType_fre[$j], 'fresh_percentage' => $Percentage_fresh[$j]));
  error_reporting(0);
  }
  echo json_encode($erwthma3b);

  $querytr="TRUNCATE TABLE resultwind;";
  mysqli_query($db, $querytr);

  $querydr = " DROP TABLE resultwind ;";
   mysqli_query($db, $querydr);

  mysqli_close($db);
  //telos stale/fresh gia Wind
}elseif ($test==4) {
  //arxh stale/fresh gia Forthent
  $sql0="CREATE TABLE resultfor AS(SELECT CacheControl,ContentType,isp FROM headers WHERE isp LIKE '%forth%' OR isp LIKE '%For%' OR isp LIKE '%FOR%' AND CacheControl!='' AND ContentType!='' );";
  $result0 = $db->query($sql0);

  //Deutero erwthma:
  $sql1="SELECT COUNT(CacheControl) FROM resultfor WHERE CacheControl
  LIKE '%max-age%' OR CacheControl
  LIKE '%max-stale%' OR CacheControl
  LIKE '%min-fresh%' OR CacheControl
  LIKE '%no-cache%' OR CacheControl
  LIKE '%no-store%' OR CacheControl
  LIKE '%no-transform%'
  OR CacheControl
  LIKE '%only-if-cached%';";
  $result1 = $db->query($sql1);


  if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
      //plithos request directive ana ContentType
      $hndpercent=$row["COUNT(CacheControl)"];
    }
  } else {
    $erwthma3b[]=0;
    $ContentType_sta[]=0;
    $Percentage_stale[]=0;
    $ContentType_fre[]=0;
    $Percentage_fresh[]=0;
  }






  $sql2="SELECT COUNT(CacheControl),ContentType FROM resultfor WHERE CacheControl LIKE '%max-stale%' GROUP BY ContentType;";
  $result2 = $db->query($sql2);

  $b=0;
  if ($result2->num_rows > 0) {

    while($row = $result2->fetch_assoc()) {
      //plithos max-stale directive ana ContentType
      $cnt_max_stale[$b]=$row["COUNT(CacheControl)"];
      $ContentType_sta[$b]=$row["ContentType"];
      $Percentage_stale[$b]=($cnt_max_stale[$b]/$hndpercent)*100;
      $b++;
    }
  } else {
    $erwthma3b[]=0;
    $ContentType_sta[]=0;
    $Percentage_stale[]=0;
    $ContentType_fre[]=0;
    $Percentage_fresh[]=0;
  }


  $sql3="SELECT COUNT(CacheControl),ContentType FROM resultfor WHERE CacheControl LIKE '%min-fresh%' GROUP BY ContentType;";
  $result3 = $db->query($sql3);

  $c=0;
  if ($result3->num_rows > 0) {

    while($row = $result3->fetch_assoc()) {
      //plithos max-stale directive ana ContentType
      $cnt_min_fresh[$c]=$row["COUNT(CacheControl)"];
      $ContentType_fre[$c]=$row["ContentType"];
      $Percentage_fresh[$c]=($cnt_min_fresh[$c]/$hndpercent)*100;
      $c++;
    }
  } else {
    $erwthma3b[]=0;
    $ContentType_sta[]=0;
    $Percentage_stale[]=0;
    $ContentType_fre[]=0;
    $Percentage_fresh[]=0;
  }



  // creating json_structure...
  class erwthma3b implements JsonSerializable
  {
      protected $ContentType_sta;
      protected $Percentage_stale;
      protected $ContentType_fre;
      protected $Percentage_fresh;

      public function __construct(array $data)
      {
          $this->ContentType_sta = $data['ContentType_sta'];
          $this->Percentage_stale = $data['stale_percentage'];
          $this->ContentType_fre = $data['ContentType_fre'];
          $this->Percentage_fresh = $data['fresh_percentage'];
      }

      public function getContentType_sta()
      {
          return $this->ContentType_sta;
      }

      public function getstale_percentage()
      {
          return $this->Percentage_stale;
      }

      public function getContentType_fre()
      {
          return $this->ContentType_fre;
      }

      public function getPercentage_fresh()
      {
          return $this->Percentage_fresh;
      }

      public function jsonSerialize()
      {
          return
          [
              'ContentType_sta'   => $this->getContentType_sta(),
              'stale_percentage' => $this->getstale_percentage(),
              'ContentType_fre' => $this->getContentType_fre(),
              'fresh_percentage' => $this->getPercentage_fresh()
          ];
      }
  }

  $size1=sizeof($ContentType_sta);
  $size2=sizeof($ContentType_fre);
  $size=0;

  if ($size1>=$size2) {
    $size=$size1;
  }else {
    $size=$size2;
  }

  for ($j=0; $j <$size ; $j++) {


  $erwthma3b[$j] = new erwthma3b(array('ContentType_sta' => $ContentType_sta[$j], 'stale_percentage' => $Percentage_stale[$j],'ContentType_fre' => $ContentType_fre[$j], 'fresh_percentage' => $Percentage_fresh[$j]));
  error_reporting(0);
  }
  echo json_encode($erwthma3b);

  $querytr="TRUNCATE TABLE resultfor;";
  mysqli_query($db, $querytr);

  $querydr = " DROP TABLE resultfor ;";
   mysqli_query($db, $querydr);

  mysqli_close($db);
  //telos stale/fresh gia Forthnet
}




if ($test==5) {
//stale/fresh gia olous tous paroxous
$sql1="SELECT COUNT(CacheControl) FROM headers WHERE CacheControl
LIKE '%max-age%' OR CacheControl
LIKE '%max-stale%' OR CacheControl
LIKE '%min-fresh%' OR CacheControl
LIKE '%no-cache%' OR CacheControl
LIKE '%no-store%' OR CacheControl
LIKE '%no-transform%'
OR CacheControl
LIKE '%only-if-cached%';";
$result1 = $db->query($sql1);


if ($result1->num_rows > 0) {
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    //plithos request directive ana ContentType
    $hndpercent=$row["COUNT(CacheControl)"];
  }
} else {
  $erwthma3b[]=0;
  $ContentType_sta[]=0;
  $Percentage_stale[]=0;
  $ContentType_fre[]=0;
  $Percentage_fresh[]=0;
}






$sql2="SELECT COUNT(CacheControl),ContentType FROM headers WHERE CacheControl LIKE '%max-stale%' GROUP BY ContentType;";
$result2 = $db->query($sql2);

$b=0;
if ($result2->num_rows > 0) {

  while($row = $result2->fetch_assoc()) {
    //plithos max-stale directive ana ContentType
    $cnt_max_stale[$b]=$row["COUNT(CacheControl)"];
    $ContentType_sta[$b]=$row["ContentType"];
    $Percentage_stale[$b]=($cnt_max_stale[$b]/$hndpercent)*100;
    $b++;
  }
} else {
  $erwthma3b[]=0;
  $ContentType_sta[]=0;
  $Percentage_stale[]=0;
  $ContentType_fre[]=0;
  $Percentage_fresh[]=0;
}


$sql3="SELECT COUNT(CacheControl),ContentType FROM headers WHERE CacheControl LIKE '%min-fresh%' GROUP BY ContentType;";
$result3 = $db->query($sql3);

$c=0;
if ($result3->num_rows > 0) {

  while($row = $result3->fetch_assoc()) {
    //plithos max-stale directive ana ContentType
    $cnt_min_fresh[$c]=$row["COUNT(CacheControl)"];
    $ContentType_fre[$c]=$row["ContentType"];
    $Percentage_fresh[$c]=($cnt_min_fresh[$c]/$hndpercent)*100;
    $c++;
  }
} else {
  $erwthma3b[]=0;
  $ContentType_sta[]=0;
  $Percentage_stale[]=0;
  $ContentType_fre[]=0;
  $Percentage_fresh[]=0;
}



// creating json_structure...
class erwthma3b implements JsonSerializable
{
    protected $ContentType_sta;
    protected $Percentage_stale;
    protected $ContentType_fre;
    protected $Percentage_fresh;

    public function __construct(array $data)
    {
        $this->ContentType_sta = $data['ContentType_sta'];
        $this->Percentage_stale = $data['stale_percentage'];
        $this->ContentType_fre = $data['ContentType_fre'];
        $this->Percentage_fresh = $data['fresh_percentage'];
    }

    public function getContentType_sta()
    {
        return $this->ContentType_sta;
    }

    public function getstale_percentage()
    {
        return $this->Percentage_stale;
    }

    public function getContentType_fre()
    {
        return $this->ContentType_fre;
    }

    public function getPercentage_fresh()
    {
        return $this->Percentage_fresh;
    }

    public function jsonSerialize()
    {
        return
        [
            'ContentType_sta'   => $this->getContentType_sta(),
            'stale_percentage' => $this->getstale_percentage(),
            'ContentType_fre' => $this->getContentType_fre(),
            'fresh_percentage' => $this->getPercentage_fresh()
        ];
    }
}

$size1=sizeof($ContentType_sta);
$size2=sizeof($ContentType_fre);
$size=0;

if ($size1>=$size2) {
  $size=$size1;
}else {
  $size=$size2;
}

for ($j=0; $j <$size ; $j++) {


$erwthma3b[$j] = new erwthma3b(array('ContentType_sta' => $ContentType_sta[$j], 'stale_percentage' => $Percentage_stale[$j],'ContentType_fre' => $ContentType_fre[$j], 'fresh_percentage' => $Percentage_fresh[$j]));
error_reporting(0);
}
echo json_encode($erwthma3b);

mysqli_close($db);
}//telos stale/fresh gia olous tous paroxous

 ?>
