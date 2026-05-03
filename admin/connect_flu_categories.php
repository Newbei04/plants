<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include(__DIR__ . '/../constant/connect.php');

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
        window.location.href = 'add_flucategory.php';
    });
</script>
</body>
</html>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $scientificName = trim($_POST['scientificname'] ?? '');
    $herbalPlants   = $_POST['herbal_plant'] ?? [];

    if (empty($scientificName)) {
        showError("Scientific name is required.");
    }

    if (empty($herbalPlants) || !is_array($herbalPlants)) {
        showError("Please select at least one herbal plant.");
    }

    if (!$con) {
        showError("Database connection failed.");
    }

    // CHECK DUPLICATE
    $checkStmt = $con->prepare("SELECT id FROM flucategories WHERE scientific_name = ?");
    if (!$checkStmt) {
        showError("Query preparation failed.");
    }
    $checkStmt->bind_param("s", $scientificName);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        showError("Scientific name already exists!");
    }
    $checkStmt->close();

    // Implode array into comma-separated string
    $herbalPlantString = implode(',', $herbalPlants);

    // INSERT
    $stmt = $con->prepare("INSERT INTO flucategories (scientific_name, herbal_plant) VALUES (?, ?)");
    if (!$stmt) {
        showError("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("ss", $scientificName, $herbalPlantString);

    if (!$stmt->execute()) {
        showError("Insert failed: " . $stmt->error);
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
        text: 'Flu category added successfully!'
    }).then(function() {
        window.location.href = 'manage_categories.php';
    });
</script>
</body>
</html>";
}
