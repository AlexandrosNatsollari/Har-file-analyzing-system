<?php
$db = mysqli_connect('localhost', 'root', '', 'webdatabase');
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

//Deutero erwthma:
//pairnoume diaforetika isps 
$sql1="SELECT  DISTINCT entries_isp FROM entries ;";
$result1 = $db->query($sql1);

$k=0;
if ($result1->num_rows > 0) {
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    $isp[$k]=$row["entries_isp"];

     $k++;

  }
} else {
  echo "0";
}






$w=0;
$lng=sizeof($isp);
for ($i=0; $i <$lng ; $i++) {

$paroxos=$isp[$i];

$sql2="SELECT Avg(timings),HOUR(startedDateTime) FROM entries WHERE entries_isp='$paroxos' GROUP BY HOUR(startedDateTime);";
$result2 = $db->query($sql2);


if ($result2->num_rows > 0) {

  while($row = $result2->fetch_assoc()) {
    $avg[$w]=$row["Avg(timings)"];
    $time[$w]=$row["HOUR(startedDateTime)"];
    $time[$w]=$time[$w]+0;
    $isp_prov[$w]=$paroxos;

    //echo "<br>";
    $w++;
  }
} else {
  echo "0";
}

}


// creating json_structure...
class erwthma4 implements JsonSerializable
{
    protected $ispo;
    protected $timeo;
    protected $avgo;

    public function __construct(array $data)
    {
        $this->ispo = $data['isp'];
        $this->timeo = $data['time'];
        $this->avgo = $data['avg'];
    }

    public function getisp()
    {
        return $this->ispo;
    }

    public function gettime()
    {
        return $this->timeo;
    }
    public function getavg()
    {
        return $this->avgo;
    }

    public function jsonSerialize()
    {
        return
        [
            'isp'   => $this->getisp(),
            'time' => $this->gettime(),
            'avg' => $this->getavg()
        ];
    }
}
$size=sizeof($avg);
for ($j=0; $j <$size ; $j++) {


$erwthma4[$j] = new erwthma4(array('isp' => $isp_prov[$j], 'time' => $time[$j], 'avg' => $avg[$j]));

}
echo json_encode($erwthma4);


mysqli_close($db);


 ?>
