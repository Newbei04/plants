<?php
include('../constant/layout/head.php');
include('../constant/layout/header.php');
include('../constant/layout/sidebar.php');
include('../constant/connect.php');

$id = $_GET['id'];

$sql = "SELECT * FROM herbal_details WHERE id='$id'";
$result = mysqli_query($con, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($con);
}

?>

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Edit Herbal</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Edit Herbal</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8" style="margin-left: 10%;">
                <div class="card">
                    <div class="card-body">
                        <div class="input-states">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                                action="update_herbal.php">

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Scientific Name:</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <input type="text" name="scientificname" class="form-control"
                                                value="<?php echo $row['scientific_name']; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Meaning:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="meaning" class="form-control"
                                                value="<?php echo $row['meaning']; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">You can use to:</label>
                                        <div class="col-sm-9">
                                             <textarea name="canuseto" class="form-control"
                                                required><?php echo $row['can_use_to']; ?></textarea>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">You can use to:</label>
                                        <div class="col-sm-9">
                                            <div id="canuse-wrapper">
                                                <?php
                                                $uses = explode(',', $row['can_use_to']);
                                                foreach ($uses as $index => $use):
                                                ?>
                                                    <div class="canuse-item d-flex mb-2">
                                                        <input type="text" name="canuseto[]" class="form-control mr-2"
                                                            value="<?php echo htmlspecialchars(trim($use)); ?>" required>
                                                        <?php if ($index === 0): ?>
                                                            <button type="button" class="btn btn-success" onclick="addCanuseField()">+</button>
                                                        <?php else: ?>
                                                            <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">−</button>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">How to use:</label>
                                        <div class="col-sm-9">
                                            <textarea name="howtouse" class="form-control"
                                                required><?php echo $row['how_to_use']; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">Trivia:</label>
                                        <div class="col-sm-9">
                                            <textarea name="trivia" class="form-control"
                                                required><?php echo $row['trivia']; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="submit"
                                    class="btn btn-primary btn-flat m-b-30 m-t-30">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function addCanuseField() {
        const wrapper = document.getElementById('canuse-wrapper');
        const div = document.createElement('div');
        div.className = 'canuse-item d-flex mb-2';
        div.innerHTML = `
        <input type="text" name="canuseto[]" placeholder="You can use to:" class="form-control mr-2" required>
        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">−</button>
    `;
        wrapper.appendChild(div);
    }
</script>
<?php include('../constant/layout/footer.php'); ?>