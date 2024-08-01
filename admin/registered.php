<?php
include('db_connect.php');
include('admin_header.php');
include('admin_navbar.php');
include('admin_class.php');
?>

<head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<style>
    table {
        border: var(--bs-border-width) solid var(--bs-border-color);
        border-radius: 5px
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
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
                                            <th class="text-center">First Name</th>
                                            <th class="text-center">Last Name</th>
                                            <th class="text-center">Birth Date</th>
                                            <th class="text-center">Gender</th>
                                            <th class="text-center">Country</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Course</th>
                                            <th class="text-center">Status</th> <!-- New column for status -->
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'db_connect.php';
                                        $admission_forms = $conn->query("SELECT * FROM admission_forms order by created_at desc");
                                        $i = 1;
                                        while ($row = $admission_forms->fetch_assoc()):
                                        ?>
                                        <tr>
                                             <td class="text-center">
                                                <?php echo $i++ ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['first_name'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['last_name'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['birth_date_month'] . '.' . $row['birth_date_day'] . '.' . $row['birth_date_year'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['gender'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['citizenship'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['phone'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['email'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['category'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['course'] ?>
                                            </td>
                                            <td class="text-center">
                                                
                                                    <?php
                                                    // Display status based on the value
                                                    $status = $row['status'];
                                                    if ($status == 'Approved') {
                                                        echo '<span class="badge bg-success">‎ </span>';
                                                    } elseif ($status == 'Not Approved') {
                                                        echo '<span class="badge bg-danger">‎ </span>';
                                                    } else {
                                                        echo '<span class="badge bg-warning ">‎ </span>';
                                                    }
                                                    ?>
                                                
                                            </td>
                                            <td class="text-center">
                                               
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            data-id='<?php echo $row['id'] ?>'
                                                            onclick="approveForm(<?php echo $row['id'] ?>)">Approve</button>

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-id='<?php echo $row['id'] ?>'
                                                            onclick="rejectForm(<?php echo $row['id'] ?>)">Reject</button>
                                                    </div>
                                            
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

<script>
    function approveForm(admissionId) {
        // AJAX request to update the approval status to 'Approved'
        $.ajax({
            url: 'ajax.php?action=approveform',
            method: 'POST',
            data: { id: admissionId, status: 'Approved' },
            success: function () {
                // Reload the page or update the admission forms list
                location.reload();
            }
        });
    }

    function rejectForm(admissionId) {
        // AJAX request to update the approval status to 'Not Approved'
        $.ajax({
            url: 'ajax.php?action=rejectform',
            method: 'POST',
            data: { id: admissionId, status: 'Not Approved' },
            success: function () {
                // Reload the page or update the admission forms list
                location.reload();
            }
        });
    }
</script>
