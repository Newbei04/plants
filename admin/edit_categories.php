<?php
session_start();
$base_path = file_exists('assets') ? './' : '../';
include(__DIR__ . '/../constant/layout/head.php');
include(__DIR__ . '/../constant/layout/header.php');
include(__DIR__ . '/../constant/layout/sidebar.php');
include(__DIR__ . '/../constant/connect.php');

if (isset($_GET['id'])) {
    $id   = (int) $_GET['id'];
    $sql  = "SELECT * FROM flucategories WHERE id=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row    = mysqli_fetch_assoc($result);

    if (!$row) {
        header("Location: manage_categories.php");
        exit();
    }

    $scientificName = $row['scientific_name'];

    // Trim each value after exploding to avoid space mismatch
    $savedPlants = array_map('trim', explode(',', $row['herbal_plant']));
} else {
    header("Location: manage_categories.php");
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
                            <form class="form-horizontal" action="update_flucategory.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Scientific Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="scientificname" class="form-control"
                                                value="<?php echo htmlspecialchars($scientificName); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Select Herbal Plant:</label>
                                        <div class="col-sm-9">

                                            <!-- Search box -->
                                            <input type="text" id="searchPlant" class="form-control mb-2"
                                                placeholder="Search plant...">

                                            <!-- Scrollable checkbox list -->
                                            <div id="plantCheckboxList"
                                                style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; border-radius: 4px; padding: 10px;">
                                                <?php
                                                $query         = "SELECT scientific_name FROM herbal_details ORDER BY scientific_name ASC";
                                                $result_herbal = mysqli_query($con, $query);

                                                if ($result_herbal && mysqli_num_rows($result_herbal) > 0) {
                                                    while ($row_herbal = mysqli_fetch_assoc($result_herbal)) {
                                                        $val     = htmlspecialchars($row_herbal['scientific_name']);
                                                        $checked = in_array(trim($row_herbal['scientific_name']), $savedPlants) ? 'checked' : '';
                                                        echo '
                                                        <div class="plant-item form-check mb-1">
                                                            <input class="form-check-input plant-checkbox" type="checkbox"
                                                                name="herbal_plant[]" value="' . $val . '"
                                                                id="plant_' . $val . '" ' . $checked . '>
                                                            <label class="form-check-label" for="plant_' . $val . '">'
                                                            . $val . '</label>
                                                        </div>';
                                                    }
                                                } else {
                                                    echo '<p class="text-muted">No herbal plants available.</p>';
                                                }
                                                ?>
                                            </div>

                                            <!-- Select All / Deselect All -->
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-sm btn-secondary"
                                                    id="selectAll">Select All</button>
                                                <button type="button" class="btn btn-sm btn-secondary"
                                                    id="deselectAll">Deselect All</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <input type="submit" value="Update"
                                    class="btn btn-primary btn-flat m-b-30 m-t-30">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../constant/layout/footer.php'); ?>

<script>
    // Search/filter checkboxes
    document.getElementById('searchPlant').addEventListener('keyup', function() {
        const search = this.value.toLowerCase();
        document.querySelectorAll('.plant-item').forEach(function(item) {
            const label = item.querySelector('label').textContent.toLowerCase();
            item.style.display = label.includes(search) ? '' : 'none';
        });
    });

    // Select All
    document.getElementById('selectAll').addEventListener('click', function() {
        document.querySelectorAll('.plant-checkbox').forEach(function(cb) {
            cb.checked = true;
        });
    });

    // Deselect All
    document.getElementById('deselectAll').addEventListener('click', function() {
        document.querySelectorAll('.plant-checkbox').forEach(function(cb) {
            cb.checked = false;
        });
    });
</script>