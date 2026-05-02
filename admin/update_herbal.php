<?php
include('../constant/connect.php');

$id = $_POST['id'];
$scientificName = $_POST['scientificname'];
$meaning = $_POST['meaning'];
$canUseTo = $_POST['canuseto'];
$howToUse = $_POST['howtouse'];
$trivia = $_POST['trivia'];

$query = "UPDATE herbal_details SET scientific_name=?, meaning=?, can_use_to=?, how_to_use=?, trivia=? WHERE id=?";
$stmt = $con->prepare($query);
$stmt->bind_param("sssssi", $scientificName, $meaning, $canUseTo, $howToUse, $trivia, $id);

if ($stmt->execute()) {
    echo "<html><head><script>alert('Updated Successfully');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=manage_herbal.php'>";
} else {
    echo "<html><head><script>alert('ERROR! Update Operation Unsuccessful');</script></head></html>";
    echo "Error: " . $stmt->error;
}

$stmt->close();
?>