<?php
session_start();
include('../constant/connect.php');

function showError($message)
{
    $safe = htmlspecialchars($message, ENT_QUOTES);
    echo "<!DOCTYPE html>
<html>
<head><meta charset='UTF-8'></head>
<body>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{$safe}'
    }).then(function() {
        window.history.back();
    });
</script>
</body>
</html>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id             = (int) ($_POST['id'] ?? 0);
    $scientificName = trim($_POST['scientificname'] ?? '');
    $herbalPlants   = $_POST['herbal_plant'] ?? [];

    if (!$id) {
        showError("Invalid record ID.");
    }

    if (empty($scientificName)) {
        showError("Scientific name is required.");
    }

    if (empty($herbalPlants) || !is_array($herbalPlants)) {
        showError("Please select at least one herbal plant.");
    }

    // CHECK DUPLICATE — exclude current record from duplicate check
    $checkStmt = $con->prepare("SELECT id FROM flucategories WHERE scientific_name = ? AND id != ?");
    if (!$checkStmt) {
        showError("Query preparation failed.");
    }
    $checkStmt->bind_param("si", $scientificName, $id);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        showError("Scientific name already exists!");
    }
    $checkStmt->close();

    // Implode array into comma-separated string
    $herbalPlantString = implode(',', $herbalPlants);

    // UPDATE
    $stmt = $con->prepare("UPDATE flucategories SET scientific_name = ?, herbal_plant = ? WHERE id = ?");
    if (!$stmt) {
        showError("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("ssi", $scientificName, $herbalPlantString, $id);

    if (!$stmt->execute()) {
        showError("Update failed: " . $stmt->error);
    }

    $stmt->close();
    $con->close();

    echo "<!DOCTYPE html>
<html>
<head><meta charset='UTF-8'></head>
<body>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Flu category updated successfully!'
    }).then(function() {
        window.location.href = 'manage_categories.php';
    });
</script>
</body>
</html>";
} else {
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    header("Location: edit_flucategory.php?id=$id");
    exit();
}
