<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'webdatabase');
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
$user = $_SESSION['username'];

$sql1 = "SELECT COUNT(entries_id) FROM entries WHERE user_username='$user'";
$result1 = $db->query($sql1);

$numofentries=0;
if ($result1->num_rows > 0) {
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    $numofentries=$row["COUNT(entries_id)"];

  }
} else {
$numofentries=0;
}
mysqli_free_result($result1);

//=======================================
$sql2 = "SELECT lastUpload FROM users WHERE username='$user'";
$result2 = $db->query($sql2);


if ($result2->num_rows > 0) {
  // output data of each row
  while($row = $result2->fetch_assoc()) {
    $lastUpload=$row["lastUpload"];

  }
} else {
$lastUpload=3;
}

mysqli_free_result($result2);

echo json_encode(['numofentries' => $numofentries, 'lastUpload' => $lastUpload]);
mysqli_close($db);

?>
