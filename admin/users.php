<?php
include('admin_header.php');
include('admin_navbar.php');
?>
<style>
table{
  
    border: var(--bs-border-width) solid var(--bs-border-color);
    border-radius: 5px
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;}
    </style>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <br>
                    <div class="row">
                        <div>
                            <div class="card-body">
                                <table class="table-striped table-bordered col-md-12">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Password</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'db_connect.php';
                                        $users = $conn->query("SELECT * FROM users order by name asc");
                                        $i = 1;
                                        while ($row = $users->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $i++ ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $row['name'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $row['username'] ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $row['password'] ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm delete_user"
                                                            data-id='<?php echo $row['id'] ?>'>Delete</button>
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Form Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- User Form Section -->
                <form action="" id="manage-user">
                    <input type="hidden" name="id" id="user_id" value="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_user">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.edit_user').click(function () {
            var user_id = $(this).attr('data-id');

            // AJAX request to get user details
            $.ajax({
                url: 'users.php?action=get_user_details',
                method: 'POST',
                data: { id: user_id },
                dataType: 'json',
                success: function (response) {
                    // Populate the modal with user details
                    $('#user_id').val(response.id);
                    $('#name').val(response.name);
                    $('#username').val(response.username);
                    $('#password').val(''); // Clear the password field for security
                    $('#confirm_password').val('');
                    $('#userModalLabel').html('Edit User');
                    $('#userModal').modal('show');
                }
            });
        });

        $('.delete_user').click(function () {
            var user_id = $(this).attr('data-id');

            // Confirm deletion
            if (confirm("Are you sure you want to delete this user?")) {
                // AJAX request to delete the user
                $.ajax({
                    url: 'users.php?action=delete_user',
                    method: 'POST',
                    data: { id: user_id },
                    success: function () {
                        // Reload the page or update the user list
                        location.reload();
                    }
                });
            }
        });

        $('#save_user').click(function () {
            // Validate password and confirm password
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();

            if (password !== confirm_password) {
                alert("Passwords do not match");
                return;
            }

            // AJAX request to save user details
            $.ajax({
                url: 'users.php?action=save_user',
                method: 'POST',
                data: $('#manage-user').serialize(),
                success: function () {
                    // Reload the page or update the user list
                    location.reload();
                }
            });

            $('#userModal').modal('hide');
        });
    });
</script>
