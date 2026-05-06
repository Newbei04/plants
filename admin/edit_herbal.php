<?php
include('../constant/layout/head.php');
include('../constant/layout/header.php');
include('../constant/layout/sidebar.php');
include('../constant/connect.php');

$id     = (int)$_GET['id'];
$sql    = "SELECT * FROM herbal_details WHERE id=?";
$stmt   = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row    = $result->fetch_assoc();

if (!$row) {
    die("Record not found.");
}

// Decode existing JSON pairs; fall back gracefully for old comma-separated data
$existingPairs = json_decode($row['can_use_to'], true);
if (!is_array($existingPairs)) {
    $existingPairs = array_map(fn($u) => [
        'category'   => trim($u),
        'can_use_to' => ''
    ], explode(',', $row['can_use_to']));
}

// Fetch categories for the dropdown
$catResult  = mysqli_query($con, "SELECT scientific_name FROM flucategories ORDER BY scientific_name");
$categories = [];
while ($c = mysqli_fetch_assoc($catResult)) {
    $categories[] = $c['scientific_name'];
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
                        <form class="form-horizontal" method="POST"
                            enctype="multipart/form-data"
                            action="update_herbal.php"
                            onsubmit="return buildJson()">

                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <!-- Scientific Name -->
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Scientific Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="scientificname" class="form-control"
                                            value="<?php echo htmlspecialchars($row['scientific_name']); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Meaning -->
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Meaning:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="meaning" class="form-control"
                                            value="<?php echo htmlspecialchars($row['meaning']); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Symptom + Remedy Instructions pairs -->
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Symptoms &amp; Remedy Instructions:</label>
                                    <div class="col-sm-9">
                                        <div id="pairs-wrapper"></div>
                                        <button type="button" class="btn btn-success btn-sm mt-2"
                                            onclick="addPair()">+ Add Symptom</button>
                                        <small class="form-text text-muted">
                                            Each symptom has its own remedy instructions.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden JSON field -->
                            <input type="hidden" name="pairs_json" id="pairs_json">

                            <!-- How to use — commented out for now -->
                            <!--
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">How to use:</label>
                                    <div class="col-sm-9">
                                        <textarea name="howtouse" class="form-control"
                                            rows="4" required><?php echo htmlspecialchars($row['how_to_use']); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            -->

                            <!-- Trivia -->
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Trivia:</label>
                                    <div class="col-sm-9">
                                        <textarea name="trivia" class="form-control"
                                            rows="3" required><?php echo htmlspecialchars($row['trivia']); ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const symptoms = <?php echo json_encode($categories); ?>;
    const existingPairs = <?php echo json_encode($existingPairs); ?>;

    let pairCount = 0;

    function buildOptions(selectedVal = '') {
        let opts = '<option value="">-- Select Category --</option>';
        symptoms.forEach(s => {
            const sel = s === selectedVal ? ' selected' : '';
            opts += `<option value="${s}"${sel}>${s}</option>`;
        });
        return opts;
    }

    function addPair(selectedVal = '', howto = '') {
        pairCount++;
        const id = pairCount;
        const wrapper = document.getElementById('pairs-wrapper');
        const div = document.createElement('div');
        div.id = 'pair-' + id;
        div.className = 'border rounded p-3 mb-2';
        div.style.background = '#f9f9f9';
        div.innerHTML = `
            <div class="form-group mb-2">
                <label class="control-label" style="font-size:13px;">Category</label>
                <select class="form-control pair-category">
                    ${buildOptions(selectedVal)}
                </select>
            </div>
            <div class="form-group mb-1">
                <label class="control-label" style="font-size:13px;">Remedy Instructions</label>
                <textarea class="form-control pair-howto" rows="2"
                    placeholder="Describe the remedy instructions for the selected category...">${howto}</textarea>
            </div>
            ${id > 1
                ? `<button type="button" class="btn btn-danger btn-sm mt-1"
                    onclick="document.getElementById('pair-${id}').remove()">− Remove</button>`
                : ''}
        `;
        wrapper.appendChild(div);
    }

    function buildJson() {
        const pairs = [];
        document.querySelectorAll('#pairs-wrapper > div').forEach(div => {
            const category = div.querySelector('.pair-category').value.trim();
            const can_use_to = div.querySelector('.pair-howto').value.trim();
            if (category) {
                pairs.push({
                    category,
                    can_use_to
                });
            }
        });

        // Validate — must have at least one valid pair
        if (pairs.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Category',
                text: 'Please add at least one symptom/category.'
            });
            return false; // stop form submission
        }

        // Validate — every selected category must have remedy instructions
        const missing = pairs.find(p => p.can_use_to === '');
        if (missing) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Remedy Instructions',
                text: `Please enter remedy instructions for: "${missing.category}"`
            });
            return false; // stop form submission
        }

        document.getElementById('pairs_json').value = JSON.stringify(pairs);
    }

    // Pre-fill with existing data on page load
    if (existingPairs.length > 0) {
        existingPairs.forEach(p => addPair(p.category, p.can_use_to));
    } else {
        addPair();
    }
</script>

<?php include('../constant/layout/footer.php'); ?>