<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include('../phpqrcode/qrlib.php');

    // INPUTS
    $scientificName = $_POST['scientificname'];
    $meaning = $_POST['meaning'];
    $canUseTo = $_POST['canuseto'];
    $howToUse = $_POST['howtouse'];
    $trivia = $_POST['trivia'];

    // ✔ FIX: set default value to avoid SQL error
    $value = 0;

    // FILE UPLOAD
    $targetDirectory = "../uploads/";

    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // CHECK IMAGE
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    if ($_FILES["image"]["size"] > 5000000) {
        die("File is too large.");
    }

    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        die("Only JPG, JPEG, PNG & GIF allowed.");
    }

    // UPLOAD FILE
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        die("Upload failed.");
    }

    // DB CONNECTION
    $conn = new mysqli('localhost', 'root', '', 'herbalinformation');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ✔ CHECK DUPLICATE SCIENTIFIC NAME
    $checkStmt = $conn->prepare("SELECT id FROM herbal_details WHERE scientific_name = ?");
    $checkStmt->bind_param("s", $scientificName);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        die("Scientific name already exists!");
    }
    $checkStmt->close();

    // ✔ INSERT DATA
    $stmt = $conn->prepare("INSERT INTO herbal_details 
        (scientific_name, meaning, can_use_to, how_to_use, trivia, image, value) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "sssssss",
        $scientificName,
        $meaning,
        $canUseTo,
        $howToUse,
        $trivia,
        $targetFile,
        $value
    );

    if ($stmt->execute()) {

        $herbalId = $stmt->insert_id;

        // QR CODE PATH
        $qrFileName = "qr_" . $herbalId . ".png";
        $qrFilePath = "../qrcodes/" . $qrFileName;

        if (!is_dir("../qrcodes/")) {
            mkdir("../qrcodes/", 0777, true);
        }

        // GENERATE QR
        QRcode::png($herbalId, $qrFilePath, 'L', 4, 2);

        // UPDATE QR PATH
        $update = $conn->prepare("UPDATE herbal_details SET qr_code = ? WHERE id = ?");
        $update->bind_param("si", $qrFilePath, $herbalId);
        $update->execute();

        // REDIRECT
        header("Location: manage_herbal.php");
        exit();
    } else {
        echo "Insert error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
