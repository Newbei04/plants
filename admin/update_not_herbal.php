<?php
include('../constant/connect.php');

// Assuming you have the necessary security checks in place (commented out for now)
// page_protect();

$id = $_POST['id'];
$scientificName = $_POST['scientificname'];
$description = $_POST['description'];

$query = "UPDATE not_herbal_details SET scientific_name=?, description=? WHERE id=?";
$stmt = $con->prepare($query);
$stmt->bind_param("ssi", $scientificName, $description, $id);

if ($stmt->execute()) {
    echo "<html><head><script>alert('Updated Successfully');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=edit_notherbal.php'>";
} else {
    echo "<html><head><script>alert('ERROR! Update Operation Unsuccessful');</script></head></html>";
    echo "Error: " . $stmt->error;
}

$stmt->close();
?>