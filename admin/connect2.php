<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include(__DIR__ . '/../constant/connect.php');
include(__DIR__ . '/../phpqrcode/qrlib.php');

/* =========================
   ERROR HANDLER
========================= */
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
}).then(() => {
    window.location.href = 'new_not_herbal.php';
});
</script>
</body>
</html>";
    exit();
}

/* =========================
   MAIN PROCESS
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $scientificName = $_POST['scientificname'] ?? '';
    $description    = $_POST['description'] ?? '';
    $value          = 0;

    if (!$con) {
        showError("Database connection failed.");
    }

    /* =========================
       IMAGE UPLOAD
    ========================= */
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        showError("No image uploaded.");
    }

    $uploadDir = __DIR__ . "/../uploads/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $ext = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

    if (!getimagesize($_FILES["image"]["tmp_name"])) {
        showError("File is not an image.");
    }

    if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
        showError("File is too large.");
    }

    if (!in_array($ext, ["jpg", "jpeg", "png", "gif"])) {
        showError("Only JPG, JPEG, PNG & GIF allowed.");
    }

    // 🔥 UNIQUE FILE NAME (FIX)
    $fileName = uniqid("plant_", true) . "." . $ext;

    $serverPath = $uploadDir . $fileName;
    $webImagePath = "uploads/" . $fileName;

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $serverPath)) {
        showError("Upload failed.");
    }

    /* =========================
       CHECK DUPLICATE
    ========================= */
    $checkStmt = $con->prepare("SELECT id FROM not_herbal_details WHERE scientific_name = ?");
    $checkStmt->bind_param("s", $scientificName);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        showError("Plant name already exists!");
    }
    $checkStmt->close();

    /* =========================
       INSERT DATA
    ========================= */
    $stmt = $con->prepare("
        INSERT INTO not_herbal_details 
        (scientific_name, description, image, value) 
        VALUES (?, ?, ?, ?)
    ");

    if (!$stmt) {
        showError("Insert prepare failed: " . $con->error);
    }

    $stmt->bind_param(
        "sssi",
        $scientificName,
        $description,
        $webImagePath,  // ✅ FIXED: store WEB PATH
        $value
    );

    if (!$stmt->execute()) {
        showError("Insert failed: " . $stmt->error);
    }

    $notHerbalId = $stmt->insert_id;

    /* =========================
       QR CODE GENERATION
    ========================= */
    $qrDir = __DIR__ . "/../qrcodes/";

    if (!is_dir($qrDir)) {
        mkdir($qrDir, 0777, true);
    }

    $qrFileName = "qr_" . $notHerbalId . ".png";

    $qrServerPath = $qrDir . $qrFileName;
    $qrWebPath    = "qrcodes/" . $qrFileName;

    QRcode::png((string)$notHerbalId, $qrServerPath, 'L', 4, 2);

    /* =========================
       UPDATE QR PATH
    ========================= */
    $update = $con->prepare("UPDATE not_herbal_details SET qrcode = ? WHERE id = ?");
    if ($update) {
        $update->bind_param("si", $qrWebPath, $notHerbalId);
        $update->execute();
    }

    /* =========================
       SUCCESS
    ========================= */
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
}).then(() => {
    window.location.href = 'manage_not_herbal.php';
});
</script>
</body>
</html>";
}
