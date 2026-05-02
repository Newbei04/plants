<?php 
session_start();
include('../constant/connect.php');
?>
<?php include('../constant/layout/head.php'); ?>
<?php include('../constant/layout/header.php'); ?>
<?php include('../constant/layout/sidebar.php'); ?>
<link rel="stylesheet" href="popup_style.css">
<?php
//session_start();
//error_reporting(0);
include('../constant/connect.php');
?>
<style>
    .qr-container {
        border-radius: 10px;
        text-align: center;
    }

    .qr-container img {
        width: 250px;
        height: auto;
    }

    .error-message {
        color: #ff0000;
        font-weight: bold;
    }
</style>
<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Herbal Qr Code</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Herbal Qr Code</li>
            </ol>
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <!-- /# row -->
        <div class="row">
            <div class="col-lg-8" style="margin-left: 10%;">
                <div class="card">
                    <div class="card-title">
                    </div>
                    <div class="card-body">
                        <div class="input-states">
                            <div class="qr-container">
                                <?php
                                if (isset($_GET['id'])) {
                                    // $conn = mysqli_connect("localhost", "root", "", "herbalinformation");

                                    // if (!$conn) {
                                    //     die("Connection failed: " . mysqli_connect_error());
                                    // }

                                    $id = $_GET['id'];
                                    $sql = "SELECT qr_code FROM herbal_details WHERE id = $id";
                                    $result = mysqli_query($con, $sql);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        $qrPath = $row['qr_code'];

                                        echo '<img src="' . $qrPath . '" alt="QR Code">';
                                    } else {
                                        echo "Error fetching QR code path: " . mysqli_error($con);
                                    }

                                    mysqli_close($con);
                                } else {
                                    echo "Herbal ID not provided.";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../constant/layout/footer.php'); ?>