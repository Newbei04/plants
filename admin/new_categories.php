<?php session_start(); ?>
<?php include('../constant/layout/head.php'); ?>
<?php include('../constant/layout/header.php'); ?>
<?php include('../constant/layout/sidebar.php'); ?>
<link rel="stylesheet" href="popup_style.css">
<?php
//session_start();
//error_reporting(0);
include('../constant/connect.php');
?>
<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Add Flu Category</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Add Flu Category</li>
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
                            <form class="form-horizontal" action="connect_flu_categories.php" method="post"
                                enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Flu:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="scientificname" placeholder="Enter Flu"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Select Herbal Plant:</label>
                                        <div class="col-sm-9">
                                            <select name="herbal_plant" class="form-control" required>
                                                <option value="">-- Select Plant --</option>
                                                <?php
                                                $query = "SELECT scientific_name FROM herbal_details";
                                                $result = mysqli_query($con, $query);

                                                if ($result && mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['scientific_name'] . '">' . $row['scientific_name'] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="" disabled>No herbal plants available</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" value="Submit" class="btn btn-primary btn-flat m-b-30 m-t-30">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../constant/layout/footer.php'); ?>