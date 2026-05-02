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
        window.location.href = 'new_not_herbal.php';
    });
</script>
</body>
</html>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include(__DIR__ . '/../phpqrcode/qrlib.php');

    // INPUTS
    $scientificName = $_POST['scientificname'] ?? '';
    $description    = $_POST['description']    ?? '';

    $value = 0;

    // DB CHECK
    if (!$con) {
        showError("Database connection failed.");
    }

    // FILE UPLOAD
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        showError("No image uploaded.");
    }

    $targetDirectory = __DIR__ . "/../uploads/";

    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    $targetFile    = $targetDirectory . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // VALIDATION
    if (!getimagesize($_FILES["image"]["tmp_name"])) {
        showError("File is not an image.");
    }

    if ($_FILES["image"]["size"] > 5000000) {
        showError("File is too large.");
    }

    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        showError("Only JPG, JPEG, PNG & GIF allowed.");
    }

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        showError("Upload failed.");
    }

    // CHECK DUPLICATE
    $checkStmt = $con->prepare("SELECT id FROM not_herbal_details WHERE scientific_name = ?");
    if (!$checkStmt) {
        showError("Query preparation failed.");
    }

    $checkStmt->bind_param("s", $scientificName);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        showError("Plant name already exists!");
    }
    $checkStmt->close();

    // INSERT
    $stmt = $con->prepare("INSERT INTO not_herbal_details 
        (scientific_name, description, image, value) 
        VALUES (?, ?, ?, ?)");

    if (!$stmt) {
        showError("Insert prepare failed: " . $con->error);
    }

    $stmt->bind_param("sssi", $scientificName, $description, $targetFile, $value);

    if (!$stmt->execute()) {
        showError("Insert failed: " . $stmt->error);
    }

    $notHerbalId = $stmt->insert_id;

    // QR
    $qrDir = __DIR__ . "/../qrcodes/";
    if (!is_dir($qrDir)) {
        mkdir($qrDir, 0777, true);
    }

    $qrFileName = "qr_" . $notHerbalId . ".png";
    $qrFilePath = $qrDir . $qrFileName;

    QRcode::png($notHerbalId, $qrFilePath, 'L', 4, 2);

    // SAVE QR PATH (relative)
    $dbQrPath = "qrcodes/" . $qrFileName;

    $update = $con->prepare("UPDATE not_herbal_details SET qrcode = ? WHERE id = ?");
    if ($update) {
        $update->bind_param("si", $dbQrPath, $notHerbalId);
        $update->execute();
    }

    // SUCCESS
    echo "<!DOCTYPE html>
<html>
<head><meta charset='UTF-8'></head>
<body>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Plant added successfully!'
    }).then(function() {
        window.location.href = 'manage_not_herbal.php';
    });
</script>
</body>
</html>";
}
