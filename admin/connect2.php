<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include('../phpqrcode/qrlib.php');

    $scientificName = $_POST['scientificname'];
    $description = $_POST['description'];

    // DEFAULT VALUE (ACTIVE)
    $value = 0;

    // File upload handling
    $targetDirectory = "../uploads/";
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    // File size check
    if ($_FILES["image"]["size"] > 2000000) {
        die("Sorry, file is too large.");
    }

    // File type check
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        die("Only JPG, JPEG, PNG & GIF allowed.");
    }

    // Upload file
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        die("Upload failed.");
    }

    // DB connection
    $conn = new mysqli('localhost', 'root', '', 'herbalinformation');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // INSERT DATA (WITH value = 0)
    $stmt = $conn->prepare("INSERT INTO not_herbal_details 
        (scientific_name, description, image, value) 
        VALUES (?, ?, ?, ?)");

    $stmt->bind_param("sssi", $scientificName, $description, $targetFile, $value);

    if ($stmt->execute()) {

        $notHerbalId = $stmt->insert_id;

        // QR CODE GENERATION
        $qrFileName = "qr_" . $notHerbalId . ".png";
        $qrFilePath = "../qrcodes/" . $qrFileName;

        QRcode::png($notHerbalId, $qrFilePath, 'L', 4, 2);

        // UPDATE QR PATH
        $stmt2 = $conn->prepare("UPDATE not_herbal_details SET qrcode = ? WHERE id = ?");
        $stmt2->bind_param("si", $qrFilePath, $notHerbalId);
        $stmt2->execute();

        $stmt2->close();

        // redirect
        header("Location: manage_not_herbal.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
