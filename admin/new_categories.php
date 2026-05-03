<?php session_start(); ?>
<?php include('../constant/layout/head.php'); ?>
<?php include('../constant/layout/header.php'); ?>
<?php include('../constant/layout/sidebar.php'); ?>
<link rel="stylesheet" href="popup_style.css">

<?php
include('../constant/connect.php');
?>

<div class="page-wrapper">
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8" style="margin-left: 10%;">
                <div class="card">
                    <div class="card-title"></div>
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
                                            <!-- Search box -->
                                            <input type="text" id="searchPlant" class="form-control mb-2" placeholder="Search plant...">

                                            <!-- Scrollable checkbox list -->
                                            <div id="plantCheckboxList" style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; border-radius: 4px; padding: 10px;">
                                                <?php
                                                $query = "SELECT scientific_name FROM herbal_details";
                                                $result = mysqli_query($con, $query);

                                                if ($result && mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $name = htmlspecialchars($row['scientific_name']);
                                                        echo '
                                                        <div class="plant-item form-check mb-1">
                                                            <input class="form-check-input plant-checkbox" type="checkbox" name="herbal_plant[]" value="' . $name . '" id="plant_' . $name . '">
                                                            <label class="form-check-label" for="plant_' . $name . '">' . $name . '</label>
                                                        </div>';
                                                    }
                                                } else {
                                                    echo '<p class="text-muted">No herbal plants available.</p>';
                                                }
                                                ?>
                                            </div>

                                            <!-- Select All / Deselect All -->
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-sm btn-secondary" id="selectAll">Select All</button>
                                                <button type="button" class="btn btn-sm btn-secondary" id="deselectAll">Deselect All</button>
                                            </div>
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
    </div>

    <?php include('../constant/layout/footer.php'); ?>
</div>

<script>
    document.getElementById('searchPlant').addEventListener('keyup', function() {
        const search = this.value.toLowerCase();
        document.querySelectorAll('.plant-item').forEach(function(item) {
            const label = item.querySelector('label').textContent.toLowerCase();
            item.style.display = label.includes(search) ? '' : 'none';
        });
    });

    document.getElementById('selectAll').addEventListener('click', function() {
        document.querySelectorAll('.plant-checkbox').forEach(function(cb) {
            cb.checked = true;
        });
    });

    document.getElementById('deselectAll').addEventListener('click', function() {
        document.querySelectorAll('.plant-checkbox').forEach(function(cb) {
            cb.checked = false;
        });
    });
</script>