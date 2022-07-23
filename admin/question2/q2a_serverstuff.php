<?php
$db = mysqli_connect('localhost', 'root', '', 'webdatabase');
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

//prwto erwthma:

$query1 = "CREATE TABLE result AS(
SELECT entries.timings,entries.startedDateTime,headers.ContentType FROM entries JOIN headers ON entries.entrieconnection=headers.entrieconnection_ct WHERE headers.ContentType!='' ORDER BY headers.ContentType);
";
 mysqli_query($db, $query1);


$sql1="SELECT  DISTINCT ContentType FROM result  ;";
$result1 = $db->query($sql1);

$k=0;
if ($result1->num_rows > 0) {
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    $contentype[$k]=$row["ContentType"];

    if ($contentype[$k]!='multipart/form-data; boundary=----WebKitFormBounda') {
     $contentype[$k]=$row["ContentType"];
     $k++;
    }

  }
} else {
  echo "0";
}
$w=0;
$lng=sizeof($contentype);
for ($i=0; $i <$lng ; $i++) {

$metv=$contentype[$i];

$sql2="SELECT Avg(timings),HOUR(startedDateTime) FROM result WHERE ContentType='$metv' GROUP BY HOUR(startedDateTime) ;";
$result2 = $db->query($sql2);


if ($result2->num_rows > 0) {

  while($row = $result2->fetch_assoc()) {
    $avg[$w]=$row["Avg(timings)"];
    $time[$w]=$row["HOUR(startedDateTime)"];
    $time[$w]=$time[$w]+0;
    $type[$w]=$metv;


    
    $w++;
  }
} else {
  echo "0";
}


}

// creating json_structure...
class Person implements JsonSerializable
{
    protected $id;
    protected $name;
      protected $Ctype;

    public function __construct(array $data)
    {
        $this->id = $data['avg'];
        $this->name = $data['time'];
        $this->Ctype = $data['ContentType'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getCtype()
    {
        return $this->Ctype;
    }

    public function jsonSerialize()
    {
        return
        [
            'avg'   => $this->getId(),
            'time' => $this->getName(),
            'ContentType' => $this->getCtype()
        ];
    }
}
$size=sizeof($avg);
for ($j=0; $j <$size ; $j++) {


$person[$j] = new Person(array('avg' => $avg[$j], 'time' => $time[$j], 'ContentType' => $type[$j]));

}
echo json_encode($person);

$query2 = " DROP TABLE result ;";
 mysqli_query($db, $query2);



mysqli_close($db);


 ?>
