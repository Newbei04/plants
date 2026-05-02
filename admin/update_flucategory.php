<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
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

    $id             = (int) $_POST['id'];
    $scientificname = mysqli_real_escape_string($con, $_POST['scientificname'] ?? '');
    $herbal_plant   = mysqli_real_escape_string($con, $_POST['herbal_plant']   ?? '');

    if (empty($scientificname)) {
        showError("Scientific name is required.");
    }

    if (empty($herbal_plant)) {
        showError("Please select a herbal plant.");
    }

    $updateQuery = "UPDATE flucategories 
                    SET scientific_name='$scientificname', herbal_plant='$herbal_plant' 
                    WHERE id=$id";

    $result = mysqli_query($con, $updateQuery);

    if ($result) {
        mysqli_close($con);
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
        showError("Update failed: " . mysqli_error($con));
    }
} else {
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    header("Location: edit_flucategory.php?id=$id");
    exit();
}
