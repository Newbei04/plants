<?php
$base_path = file_exists('assets') ? './' : '../';

include('../constant/layout/head.php');
include('../constant/layout/header.php');
include('../constant/layout/sidebar.php');

$query = "SELECT * FROM not_herbal_details WHERE value= '0'";
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
            <h3 class="text-primary">Not Herbal</h3>
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
                                <th>Description</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sno = 1;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $sno; ?>
                                        </td>
                                        <td><img src="../uploads/<?php echo $row['image']; ?>" width="100px"
                                                alt="Product Image">
                                        </td>
                                        <td>
                                            <?php echo $row['scientific_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['description']; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="d-flex justify-content-center align-items-center" style="gap: 10px;">

                                                <div class="action-wrapper">
                                                    <a href="edit_notherbal.php?id=<?php echo $row['id']; ?>" class="action-btn">
                                                        <button type="button" class="btn btn-primary">
                                                            <i class="fa fa-pencil fa-fw"></i>
                                                        </button>
                                                        <span class="hover-text">Edit</span>
                                                    </a>
                                                </div>

                                                <div class="action-wrapper">
                                                    <a href="javascript:void(0);"
                                                        class="action-btn delete-btn"
                                                        data-id="<?php echo $row['id']; ?>">
                                                        <button type="button" class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <span class="hover-text">Delete</span>
                                                    </a>
                                                </div>

                                                <div class="action-wrapper">
                                                    <a href="display_qrnotherbal.php?id=<?php echo $row['id']; ?>" class="action-btn">
                                                        <button type="button" class="btn btn-info">
                                                            <i class="fa fa-qrcode fa-fw"></i>
                                                        </button>
                                                        <span class="hover-text">Generate QR</span>
                                                    </a>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                    $sno++;
                                }
                            } else {
                                echo "<tr><td colspan='8'>No records found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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
                text: "This herbal record will be marked as deleted.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {

                if (result.isConfirmed) {

                    fetch("del_notherbal.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: "id=" + id
                        })
                        .then(() => {

                            Swal.fire({
                                title: "Deleted!",
                                text: "Herbal record has been removed.",
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