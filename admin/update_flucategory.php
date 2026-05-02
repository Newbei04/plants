<?php
session_start();
include('../constant/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $scientificname = mysqli_real_escape_string($con, $_POST['scientificname']);
    $herbal_plants = isset($_POST['herbal_plant']) ? $_POST['herbal_plant'] : [];

    // Convert the array of selected herbal plants into a comma-separated string
    $herbal_plants_str = implode(",", $herbal_plants);

    // Update the data in the database
    $updateQuery = "UPDATE flucategories SET scientific_name='$scientificname', herbal_plant='$herbal_plants_str' WHERE id=$id";

    $result = mysqli_query($con, $updateQuery);

    if ($result) {
        echo "Data updated successfully.";
        header("Location: edit_categories.php?id=$id");
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
} else {
    // If the form is not submitted, redirect to the edit page
    header("Location: edit_categories.php?id=$id");
    exit();
}
?>