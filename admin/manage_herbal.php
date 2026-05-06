<?php
$base_path = file_exists('assets') ? './' : '../';
include('../constant/layout/head.php');
include('../constant/layout/header.php');
include('../constant/layout/sidebar.php');

$query  = "SELECT * FROM herbal_details WHERE value= '0'";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error executing query: " . mysqli_error($con));
}
?>
<style>
    .action-wrapper {
        display: inline-block;
        position: relative;
        margin: 2px;
    }

    .action-btn i {
        font-size: 14px;
    }

    .hover-text {
        position: absolute;
        bottom: 120%;
        left: 50%;
        transform: translateX(-50%);
        background: #333;
        color: #fff;
        padding: 4px 8px;
        font-size: 11px;
        border-radius: 4px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: 0.2s ease;
    }

    .action-wrapper:hover .hover-text {
        opacity: 1;
        bottom: 140%;
    }
</style>

<link href="<?php echo $base_path; ?>/assets/css/lib/sweetalert/sweetalert.css" rel="stylesheet">

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Herbal</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Manage Herbal</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Scientific Name</th>
                                <th>Meaning</th>
                                <th>Can Use To</th>
                                <!-- <th>How to Use</th> --> <!-- commented out for now -->
                                <th>Trivia</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sno = 1;
                            if (mysqli_num_rows($result) > 0):
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
                                    $pairs    = json_decode($row['can_use_to'], true);
                                    $hasPairs = is_array($pairs) && count($pairs) > 0;
                            ?>
                                    <tr>
                                        <!-- ID -->
                                        <td><?php echo $sno; ?></td>

                                        <!-- Image -->
                                        <td>
                                            <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>"
                                                width="100px">
                                        </td>

                                        <!-- Scientific Name -->
                                        <td><?php echo htmlspecialchars($row['scientific_name']); ?></td>

                                        <!-- Meaning -->
                                        <td><?php echo htmlspecialchars($row['meaning']); ?></td>

                                        <!-- Can Use To — category + remedy instructions -->
                                        <td>
                                            <?php if ($hasPairs): ?>
                                                <ul style="list-style-type: none; padding-left: 0; margin-bottom: 0;">
                                                    <?php foreach ($pairs as $p): ?>
                                                        <li style="margin-bottom: 8px;">
                                                            <strong><?php echo htmlspecialchars($p['category']); ?>:</strong><br>
                                                            <?php echo nl2br(htmlspecialchars($p['can_use_to'])); ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php else: ?>
                                                <?php echo htmlspecialchars($row['can_use_to']); ?>
                                            <?php endif; ?>
                                        </td>

                                        <!-- How to Use — commented out for now -->
                                        <!--
                                    <td><?php echo nl2br(htmlspecialchars($row['how_to_use'] ?? '')); ?></td>
                                    -->

                                        <!-- Trivia -->
                                        <td><?php echo htmlspecialchars($row['trivia']); ?></td>

                                        <!-- Actions -->
                                        <td style="text-align: center;">
                                            <div class="d-flex justify-content-center align-items-center" style="gap: 5px;">

                                                <div class="action-wrapper">
                                                    <a href="edit_herbal.php?id=<?php echo $row['id']; ?>" class="action-btn">
                                                        <button type="button" class="btn btn-primary">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <span class="hover-text">Edit</span>
                                                    </a>
                                                </div>

                                                <div class="action-wrapper">
                                                    <a href="javascript:void(0);"
                                                        class="action-btn delete-btn"
                                                        data-id="<?php echo $row['id']; ?>">
                                                        <button type="button" class="btn btn-warning">
                                                            <i class="fa fa-archive"></i>
                                                        </button>
                                                        <span class="hover-text">Archive</span>
                                                    </a>
                                                </div>

                                                <div class="action-wrapper">
                                                    <a href="display_qr.php?id=<?php echo $row['id']; ?>" class="action-btn">
                                                        <button type="button" class="btn btn-info">
                                                            <i class="fa fa-qrcode"></i>
                                                        </button>
                                                        <span class="hover-text">View QR</span>
                                                    </a>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                    $sno++;
                                endwhile;
                            else:
                                echo "<tr><td colspan='6'>No records found</td></tr>";
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this herbal record?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let id = this.getAttribute("data-id");

            Swal.fire({
                title: "Are you sure?",
                text: "This herbal record will be marked as archived.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, archive it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("del_herbal.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "id=" + id
                    }).then(() => {
                        Swal.fire({
                            title: "Archived!",
                            text: "Herbal record has been archived.",
                            icon: "success"
                        }).then(() => {
                            location.reload();
                        });
                    });
                }
            });
        });
    });
</script>

<?php include('../constant/layout/footer.php'); ?>