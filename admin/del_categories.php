<?php
include(__DIR__ . '/../constant/connect.php');

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = $con->prepare("DELETE FROM flucategories WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<!DOCTYPE html><html><head><meta charset='UTF-8'></head><body>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({ icon:'success', title:'Deleted!', text:'Category has been deleted.' })
            .then(() => { window.location.href = 'manage_categories.php'; });
        </script></body></html>";
    } else {
        echo "<!DOCTYPE html><html><head><meta charset='UTF-8'></head><body>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({ icon:'error', title:'Error', text:'Failed to delete category.' })
            .then(() => { history.back(); });
        </script></body></html>";
    }

    $stmt->close();
} else {
    header('Location: manage_categories.php');
    exit();
}
