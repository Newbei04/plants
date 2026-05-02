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
            <h3 class="text-primary">Add Herbal</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Add Herbal</li>
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
                            <form class="form-horizontal" action="connect1.php" method="post"
                                enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Image:</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                                            <input type="file" id="imageInput" name="image" class="form-control-file" accept="image/*" required>
                                            <small class="text-muted">Maximum file size: 2MB</small>
                                            <div id="fileError" style="color: red; display: none; font-size: 12px;">File is too large! Max limit is 2MB.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Plant/Scientific Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="scientificname" placeholder="Enter Plant/Scientific Name"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Meaning:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="meaning" placeholder="Enter meaning"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">You can use to:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="canuseto" placeholder="You can use to:"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">How to use:</label>
                                        <div class="col-sm-9">
                                            <textarea name="howtouse" placeholder="Enter how to use"
                                                class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Trivia:</label>
                                        <div class="col-sm-9">
                                            <textarea name="trivia" placeholder="Enter trivia" class="form-control"
                                                required></textarea>
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
        <script>
            function myplandetail(str) {

                if (str == "") {
                    document.getElementById("plandetls").innerHTML = "";
                    return;
                } else {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("plandetls").innerHTML = this.responseText;

                        }
                    };

                    xmlhttp.open("GET", "plandetail.php?q=" + str, true);
                    xmlhttp.send();
                }

            }

            document.addEventListener("DOMContentLoaded", function() {
                // Image Size Validation
                const imageInput = document.getElementById('imageInput');
                const errorDiv = document.getElementById("fileError");

                imageInput.onchange = function() {
                    if (this.files && this.files[0]) {
                        // 2MB = 2097152 bytes
                        if (this.files[0].size > 2097152) {
                            errorDiv.style.display = "block";
                            this.value = ""; // Clear the input
                        } else {
                            errorDiv.style.display = "none";
                        }
                    }
                };
            });
        </script>

        <?php include('../constant/layout/footer.php'); ?>