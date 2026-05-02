<?php
include('../constant/connect.php');
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "checkin";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);
// // Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }


$qrcode = $_POST['qrcode'];
$timein = date('h:i:s A');

$date = date('Y-m-d');

$sql = "SELECT * FROM timein WHERE qrcode = '$qrcode' AND timein != '' AND date = '$date' ORDER BY id DESC";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {


  $sql = "UPDATE timein SET timeout = '$timein' WHERE qrcode = '$qrcode' ORDER BY id DESC";
  mysqli_query($con, $sql);
}else{





$sql = "INSERT INTO timein (qrcode, timein)
VALUES ('$qrcode', '$timein')";

if (mysqli_query($con, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
}
mysqli_close($con);
?>