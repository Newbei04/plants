<?php
include('../constant/connect.php');

$id             = $_POST['id'];
$scientificName = trim($_POST['scientificname'] ?? '');
$meaning        = trim($_POST['meaning']        ?? '');
$howToUse       = trim($_POST['howtouse']       ?? '');
$trivia         = trim($_POST['trivia']         ?? '');

// Decode the JSON pairs sent from the edit form
$pairsRaw = $_POST['pairs_json'] ?? '[]';
$pairs    = json_decode($pairsRaw, true);

$cleanPairs = [];
if (is_array($pairs)) {
    foreach ($pairs as $p) {
        $cleanPairs[] = [
            'category'   => trim($p['category']   ?? ''),
            'can_use_to' => trim($p['can_use_to']  ?? '')
        ];
    }
}

$canUseTo = json_encode($cleanPairs, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

$query = "UPDATE herbal_details SET scientific_name=?, meaning=?, can_use_to=?, how_to_use=?, trivia=? WHERE id=?";
$stmt  = $con->prepare($query);
$stmt->bind_param("sssssi", $scientificName, $meaning, $canUseTo, $howToUse, $trivia, $id);

if ($stmt->execute()) {
    echo "<!DOCTYPE html><html><head><meta charset='UTF-8'></head><body>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    Swal.fire({ icon:'success', title:'Success', text:'Herbal updated successfully!' })
        .then(() => { window.location.href = 'manage_herbal.php'; });
    </script></body></html>";
} else {
    echo "<!DOCTYPE html><html><head><meta charset='UTF-8'></head><body>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    Swal.fire({ icon:'error', title:'Error', text:'Update failed: " . addslashes($stmt->error) . "' })
        .then(() => { history.back(); });
    </script></body></html>";
}

$stmt->close();
