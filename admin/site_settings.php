<?php
include('admin_header.php');
include('admin_navbar.php');
?>

<!-- Site Settings Content -->
<!-- your code start -->

<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * from system_settings limit 1");
if ($qry->num_rows > 0) {
    foreach ($qry->fetch_array() as $k => $val) {
        $meta[$k] = $val;
    }
}
?>
<!-- Site Settings Content -->
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" id="manage-settings">
                            <div class="form-group">
                                <label for="email" class="control-label">Site Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo isset($meta['email']) ? $meta['email'] : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contact" class="control-label">Site Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact"
                                    value="<?php echo isset($meta['contact']) ? $meta['contact'] : '' ?>" required>
                            </div>
                            <center>
                                <button type="button" class="btn btn-info btn-primary btn-block col-md-2"
                                    id="save-settings">
                                    <span id="save-settings-spinner" style="display:none;">
                                        <i class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></i>
                                        Saving...
                                    </span>
                                    <span id="save-settings-text">Save</span>
                                </button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #about {
        width: 100%;
        height: 150px;
    }

    #save-settings {
        background-color: #FF5722;
        color: white;
        text-decoration: none;
        border: none;
    }

    #save-settings:hover {
        background-color: #ef4611;
        text-decoration: none;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="javascript/custom.js"></script>
<script>
    // Define the start_load function
    function start_load() {
        // Show loading spinner
        $('#save-settings-text').hide();
        $('#save-settings-spinner').show();
    }

    // AJAX request
    $('#save-settings').click(function () {
        start_load();
        $.ajax({
            url: 'ajax.php?action=save_settings',
            data: $('#manage-settings').serialize(),
            method: 'POST',
            success: function (resp) {
                if (resp.result == 1) {
                    // Data successfully saved, reload the page
                    location.reload();
                } else {
                    // Failed to save data
                    alert('Failed to save data.');
                }

                // Hide the loading spinner only
                $('#save-settings-spinner').hide();
                $('#save-settings-text').show();
            },
            complete: function () {
                // Hide the loading spinner only
                $('#save-settings-spinner').hide();
                $('#save-settings-text').show();
            }
        });
    });
</script>
</div>
<!-- your code end -->
<!-- Site Settings Content -->