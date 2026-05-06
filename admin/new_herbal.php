<?php session_start(); ?>
<?php include('../constant/layout/head.php'); ?>
<?php include('../constant/layout/header.php'); ?>
<?php include('../constant/layout/sidebar.php'); ?>
<?php include('../constant/connect.php'); ?>

<div class="page-wrapper">
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8" style="margin-left: 10%;">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="connect1.php" method="post"
                            enctype="multipart/form-data" onsubmit="return buildJson()">

                            <!-- Image -->
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Image:</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="image" id="imageInput"
                                            class="form-control-file" accept="image/*" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Plant/Scientific Name -->
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Plant/Scientific Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="scientificname"
                                            placeholder="Enter Plant/Scientific Name"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Meaning -->
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Meaning:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="meaning"
                                            placeholder="Enter meaning"
                                            class="form-control" required>
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

                            <!-- Hidden JSON field — populated on submit -->
                            <input type="hidden" name="pairs_json" id="pairs_json">

                            <!-- How to use — commented out for now -->
                            <!--
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">How to use:</label>
                                    <div class="col-sm-9">
                                        <textarea name="howtouse" placeholder="Enter how to use"
                                            class="form-control" rows="4" required></textarea>
                                    </div>
                                </div>
                            </div>
                            -->

                            <!-- Trivia -->
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Trivia:</label>
                                    <div class="col-sm-9">
                                        <textarea name="trivia" placeholder="Enter trivia"
                                            class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" value="Submit"
                                class="btn btn-primary btn-flat m-b-30 m-t-30">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const symptoms = <?php
                        $symptomQuery  = "SELECT scientific_name FROM flucategories ORDER BY scientific_name";
                        $symptomResult = mysqli_query($con, $symptomQuery);
                        $names = [];
                        while ($row = mysqli_fetch_assoc($symptomResult)) {
                            $names[] = $row['scientific_name'];
                        }
                        echo json_encode($names);
                        ?>;

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
                ? `<button type="button" class="btn btn-danger btn-sm"
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

    // Start with one pair on load
    addPair();
</script>

<?php include('../constant/layout/footer.php'); ?>