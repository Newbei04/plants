<?php
include('../constant/connect.php');

if (isset($_POST['id']) && isset($_POST['value'])) {

    $id = $_POST['id'];
    $value = $_POST['value'];

    $stmt = $con->prepare("UPDATE herbal_details SET value = ? WHERE id = ?");
    $stmt->bind_param("ii", $value, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}
