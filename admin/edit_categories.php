<?php
session_start();
include('../constant/layout/head.php');
include('../constant/layout/header.php');
include('../constant/layout/sidebar.php');
include('../constant/connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM flucategories WHERE id=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    // Redirect to the page where you list all the records if no ID is provided.
    header("Location: list_flucategories.php");
    exit();
}

?>

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Edit Flu Category</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Edit Flu Category</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8" style="margin-left: 10%;">
                <div class="card">
                    <div class="card-body">
                        <div class="input-states">
                            <form class="form-horizontal" action="update_flucategory.php" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">

                                <!-- Add fields relevant to your flu categories -->
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Scientific Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="scientificname" class="form-control"
                                                value="<?php echo $row['scientific_name']; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Select Herbal Plant:</label>
                                        <div class="col-sm-9">
                                            <select name="herbal_plant" class="form-control" required>
                                                <option value="">-- Select Herbal Plant --</option>

                                                <?php
                                                $query = "SELECT scientific_name FROM herbal_details";
                                                $result_herbal = mysqli_query($con, $query);

                                                if ($result_herbal && mysqli_num_rows($result_herbal) > 0) {
                                                    while ($row_herbal = mysqli_fetch_assoc($result_herbal)) {

                                                        $selected = ($row_herbal['scientific_name'] == $row['herbal_plant']) ? 'selected' : '';

                                                        echo '<option value="' . $row_herbal['scientific_name'] . '" ' . $selected . '>'
                                                            . $row_herbal['scientific_name'] .
                                                            '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="" disabled>No herbal plants available</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add other fields as needed -->

                                <input type="submit" value="Update" class="btn btn-primary btn-flat m-b-30 m-t-30">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../constant/layout/footer.php'); ?>