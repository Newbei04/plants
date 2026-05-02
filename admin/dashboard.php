<?php include('../constant/layout/head.php'); ?>
<?php include('../constant/layout/header.php'); ?>
<?php include('../constant/layout/sidebar.php'); ?>

<!-- Page wrapper  -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row">
            <!-- HERBAL PLANT -->
            <div class="col-md-3 d-flex">
                <div class="card bg-success p-20 w-100 d-flex flex-column justify-content-center text-center">

                    <div class="media widget-ten justify-content-center">

                        <div class="media-left meida media-middle">
                            <span><i class="ti-archive f-s-40"></i></span>
                        </div>

                        <div class="media-body">

                            <h2 class="color-white">
                                <?php
                                $query = "SELECT COUNT(*) FROM herbal_details";
                                $result = mysqli_query($con, $query);

                                if (mysqli_affected_rows($con) != 0) {
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo $row['COUNT(*)'];
                                    }
                                }
                                ?>
                            </h2>
                            <a href="manage_herbal.php">
                                <h2 class="color-white">Herbal <br> Plant</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FLU CATEGORIES -->
            <div class="col-md-3 d-flex">
                <div class="card bg-danger p-20 w-100 d-flex flex-column justify-content-center text-center">
                    <div class="media widget-ten justify-content-center">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-archive f-s-40"></i></span>
                        </div>
                        <div class="media-body">
                            <h2 class="color-white">
                                <?php
                                $query = "SELECT COUNT(*) FROM flucategories";
                                $result = mysqli_query($con, $query);

                                if (mysqli_affected_rows($con) != 0) {
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo $row['COUNT(*)'];
                                    }
                                }
                                ?>
                            </h2>
                            <a href="manage_categories.php">
                                <h2 class="color-white">Flu Categories</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- NOT HERBAL PLANT -->
            <div class="col-md-3 d-flex">
                <div class="card bg-warning p-20 w-100 d-flex flex-column justify-content-center text-center">
                    <div class="media widget-ten justify-content-center">
                        <div class="media-left meida media-middle">
                            <span><i class="ti-archive f-s-40"></i></span>
                        </div>
                        <div class="media-body">
                            <h2 class="color-white">
                                <?php
                                $query = "SELECT COUNT(*) FROM not_herbal_details";
                                $result = mysqli_query($con, $query);

                                if (mysqli_affected_rows($con) != 0) {
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo $row['COUNT(*)'];
                                    }
                                }
                                ?>
                            </h2>
                            <a href="manage_not_herbal.php">
                                <h2 class="color-white">Not Herbal Plant</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
</div>

<?php include('../constant/layout/footer.php'); ?>