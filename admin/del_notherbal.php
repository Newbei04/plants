<?php
include('../constant/connect.php');

if (isset($_POST['id'])) {

    $msgid = $_POST['id'];

    $stmt = $con->prepare("UPDATE not_herbal_details SET value = 1 WHERE id = ?");
    $stmt->bind_param("i", $msgid);
    $stmt->execute();

    echo "success";
}
