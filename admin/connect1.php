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
    window.location.href = 'new_herbal.php';
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
    $meaning        = $_POST['meaning'] ?? '';
    // $canUseTo       = $_POST['canuseto'] ?? '';
    $canUseTo = isset($_POST['canuseto']) ? implode(',', array_filter(array_map('trim', $_POST['canuseto']))) : '';
    $howToUse       = $_POST['howtouse'] ?? '';
    $trivia         = $_POST['trivia'] ?? '';
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
        showError("File is too large (max 5MB).");
    }

    if (!in_array($ext, ["jpg", "jpeg", "png", "gif"])) {
        showError("Only JPG, JPEG, PNG & GIF allowed.");
    }

    // 🔥 UNIQUE FILE NAME (IMPORTANT FIX)
    $fileName = uniqid("herbal_", true) . "." . $ext;

    $serverPath = $uploadDir . $fileName;
    $webImagePath = "uploads/" . $fileName;

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $serverPath)) {
        showError("Failed to upload image.");
    }

    /* =========================
       CHECK DUPLICATE
    ========================= */
    $check = $con->prepare("SELECT id FROM herbal_details WHERE scientific_name = ?");
    $check->bind_param("s", $scientificName);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        showError("Scientific name already exists!");
    }
    $check->close();

    /* =========================
       INSERT DATA
    ========================= */
    $stmt = $con->prepare("
        INSERT INTO herbal_details 
        (scientific_name, meaning, can_use_to, how_to_use, trivia, image, value) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        showError("Prepare failed: " . $con->error);
    }

    $stmt->bind_param(
        "ssssssi",
        $scientificName,
        $meaning,
        $canUseTo,
        $howToUse,
        $trivia,
        $webImagePath,   // ✅ FIXED: store WEB PATH not server path
        $value
    );

    if (!$stmt->execute()) {
        showError("Insert failed: " . $stmt->error);
    }

    $herbalId = $stmt->insert_id;

    /* =========================
       QR CODE GENERATION
    ========================= */
    $qrDir = __DIR__ . "/../qrcodes/";

    if (!is_dir($qrDir)) {
        mkdir($qrDir, 0777, true);
    }

    $qrFileName = "qr_" . $herbalId . ".png";

    $qrServerPath = $qrDir . $qrFileName;
    $qrWebPath    = "qrcodes/" . $qrFileName;

    QRcode::png((string)$herbalId, $qrServerPath, 'L', 4, 2);

    /* =========================
       UPDATE QR PATH
    ========================= */
    $update = $con->prepare("UPDATE herbal_details SET qr_code = ? WHERE id = ?");
    if ($update) {
        $update->bind_param("si", $qrWebPath, $herbalId);
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
    text: 'Herbal added successfully!'
}).then(() => {
    window.location.href = 'manage_herbal.php';
});
</script>
</body>
</html>";
}
