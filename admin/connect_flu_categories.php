<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $scientificName = $_POST['scientificname'];
    $herbalPlants = $_POST['herbal_plant'] ?? "";

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'herbalinformation');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Prepare the SQL insert statement for flucategories
        $stmt = $conn->prepare("INSERT INTO flucategories (scientific_name, herbal_plant) VALUES (?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters to the prepared statement
        $stmt->bind_param("ss", $scientificName, $herbalPlants);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "Flucategories added successfully.";

            // Redirect to the desired page
            header("Location: manage_categories.php");
            exit(); // Make sure to exit after redirection
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
}
?>
