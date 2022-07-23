<?php
$db = mysqli_connect('localhost', 'root', '', 'webdatabase');
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

//Deutero erwthma:
//epilogh hmeras
$sql1="SELECT  DISTINCT DAYNAME(startedDateTime) FROM entries  ;";
$result1 = $db->query($sql1);

$k=0;
if ($result1->num_rows > 0) {
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    $day[$k]=$row["DAYNAME(startedDateTime)"];

     $k++;

  }
} else {
  echo "0";
}






$w=0;
$lng=sizeof($day);
for ($i=0; $i <$lng ; $i++) {

$daytocompare=$day[$i];
//epilogh Avg(timings),HOUR(startedDateTime)  me vash thn hmera
$sql2="SELECT Avg(timings),HOUR(startedDateTime) FROM entries WHERE DAYNAME(startedDateTime)='$daytocompare' GROUP BY HOUR(startedDateTime);";
$result2 = $db->query($sql2);


if ($result2->num_rows > 0) {

  while($row = $result2->fetch_assoc()) {
    $avg[$w]=$row["Avg(timings)"];
    $time[$w]=$row["HOUR(startedDateTime)"];
    $time[$w]=$time[$w]+0;
    $dayname[$w]=$daytocompare;

    //echo "<br>";
    $w++;
  }
} else {
  echo "0";
}

}


// creating json_structure...
class erwthma2 implements JsonSerializable
{
    protected $dayo;
    protected $timeo;
      protected $avgo;

    public function __construct(array $data)
    {
        $this->dayo = $data['day'];
        $this->timeo = $data['time'];
        $this->avgo = $data['avg'];
    }

    public function getday()
    {
        return $this->dayo;
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
            'day'   => $this->getday(),
            'time' => $this->gettime(),
            'avg' => $this->getavg()
        ];
    }
}
$size=sizeof($avg);
for ($j=0; $j <$size ; $j++) {


$erwthma2[$j] = new erwthma2(array('day' => $dayname[$j], 'time' => $time[$j], 'avg' => $avg[$j]));

}
echo json_encode($erwthma2);


mysqli_close($db);


 ?>
