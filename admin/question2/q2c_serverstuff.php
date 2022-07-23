<?php
$db = mysqli_connect('localhost', 'root', '', 'webdatabase');
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

//prwto erwthma:
//ftiaxnoume table result1 me timings,startedDateTime,method 
$query1 = "CREATE TABLE result1 AS(
SELECT entries.timings,entries.startedDateTime,request.method FROM entries JOIN request ON entries.entrieconnection=request.entrieconnection_rq WHERE request.method!='' ORDER BY request.method);
";
 mysqli_query($db, $query1);


$sql1="SELECT  DISTINCT method FROM result1  ;";
$result1 = $db->query($sql1);

$k=0;
if ($result1->num_rows > 0) {
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    $method[$k]=$row["method"];

    if ($method[$k]!='multipart/form-data; boundary=----WebKitFormBounda') {
     $method[$k]=$row["method"];
     $k++;
    }

  }
} else {
  echo "0";
}
$w=0;
$lng=sizeof($method);
for ($i=0; $i <$lng ; $i++) {

$metv=$method[$i];

$sql2="SELECT Avg(timings),HOUR(startedDateTime) FROM result1 WHERE method='$metv' GROUP BY HOUR(startedDateTime) ;";
$result2 = $db->query($sql2);


if ($result2->num_rows > 0) {

  while($row = $result2->fetch_assoc()) {
    $avg[$w]=$row["Avg(timings)"];
    $time[$w]=$row["HOUR(startedDateTime)"];
    $time[$w]=$time[$w]+0;
    $type[$w]=$metv;
    //echo $avg[$w],'==>',$time[$w],'-->',$metv;

    //echo "<br>";
    $w++;
  }
} else {
  echo "0";
}


}

// creating json_structure...
class erwthma3 implements JsonSerializable
{
    protected $id;
    protected $name;
      protected $metho;

    public function __construct(array $data)
    {
        $this->avg = $data['avg'];
        $this->time = $data['time'];
        $this->method = $data['method'];
    }

    public function getavg()
    {
        return $this->avg;
    }

    public function gettime()
    {
        return $this->time;
    }
    public function getmethod()
    {
        return $this->method;
    }

    public function jsonSerialize()
    {
        return
        [
            'avg'   => $this->getavg(),
            'time' => $this->gettime(),
            'method' => $this->getmethod()
        ];
    }
}
$size=sizeof($avg);
for ($j=0; $j <$size ; $j++) {


$erwthma3[$j] = new erwthma3(array('avg' => $avg[$j], 'time' => $time[$j], 'method' => $type[$j]));

}
echo json_encode($erwthma3);

$query2 = " DROP TABLE result1 ;";
 mysqli_query($db, $query2);



mysqli_close($db);


 ?>
