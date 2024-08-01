<?php
include('db_connect.php');
include('admin_header.php');
include('admin_navbar.php');
include('admin_class.php');
?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4">
                            <form id="manage-category" onsubmit="saveCourse(event)">
                                <div class="card-body">
                                    <div class="card-header">
                                        Course Management Form
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="id">
                                        <div class="form-group">
                                            <label class="control-label">Course Title</label>
                                            <input type="text" class="form-control" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Categories </i></label>
                                            <select id="category" class="form-control" name="category">
                                                <?php
                                                // Fetch categories from the database
                                                $categoryQuery = "SELECT * FROM categories";
                                                $categoryResult = mysqli_query($conn, $categoryQuery);

                                                while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                                                    $categoryId = $categoryRow['id'];
                                                    $categoryName = $categoryRow['name'];
                                                    ?>
                                                    <option value="<?php echo $categoryId; ?>">
                                                        <?php echo $categoryName; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Course Description</label>
                                            <textarea class="form-control" name="description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label">Image</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button
                                                    class="btn btn-sm btn-primary col-sm-3 offset-md-3">Save</button>
                                                <button class="btn btn-sm btn-default col-sm-3" type="button"
                                                    onclick="$('#manage-category').get(0).reset()"> Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-8">
                            <div class="card-body">
                                <div>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Title</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Image URL</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $all_courses = $conn->query("SELECT * FROM courses order by id asc");
                                            while ($row = $all_courses->fetch_assoc()):
                                                ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $i++ ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['title'] ?>
                                                    </td>
                                                    <td class="text-center description-cell">
                                                        <?php echo $row['description'] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['category_id'] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <img class="course-image"
                                                            src="<?php echo 'course_img/uploads' . $row['image_url']; ?>"
                                                            alt="Course Image">
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-danger delete_cat" type="button"
                                                            data-id="<?php echo $row['id'] ?>">Delete</button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-body">
                                    <p id="notificationMessage"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .description-cell {
        max-width: 400px;
        /* Adjust the max-width as needed */
        overflow: hidden;
        white-space: normal;
        /* Allow line breaks */
        padding: 5px;
        /* Add padding for better appearance */
        border: 1px solid #ddd;
        /* Add a border for better visibility */
    }

    .course-image {
        max-width: 30%;
        /* Ensure the image doesn't exceed its container width */
        height: auto;
        /* Maintain the aspect ratio of the image */
        display: block;
        /* Remove any extra spacing around the image */
        margin: 0 auto;
        /* Center the image horizontally within the cell */
    }

    img #cimg,
    .cimg {
        max-height: 10vh;
        max-width: 8vw;
    }

    td {
        vertical-align: middle !important;
    }

    
</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function saveCourse(event) {
        event.preventDefault();

        var form = $('#manage-category')[0];
        var formData = new FormData(form);

        // Additional validation before sending the AJAX request
        var title = formData.get('title');
        var description = formData.get('description');
        var category_id = formData.get('category');

        if (!title || !description || !category_id) {
            alert('Title, Description, and Category are required.');
            return;
        }

        $.ajax({
            url: 'ajax.php?action=save_course',
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                if (response.success) {
                    $('#notificationMessage').text('Course saved successfully.');
                    $('#notificationModal').modal('show');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                    location.reload();
                } else {
                    alert('Error saving course: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                alert('AJAX request failed: ' + status + ', ' + error);
            }
        });
    }


    $('.delete_cat').click(function () {
        var course_id = $(this).data('id');

        $.ajax({
            url: 'ajax.php?action=delete_course',
            method: 'POST',
            data: { course_id: course_id },
            success: function (response) {
                if (response.success) {
                    $('#notificationMessage').text('Course deleted successfully.');
                    $('#notificationModal').modal('show');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    alert('Error deleting course: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                alert('AJAX request failed: ' + status + ', ' + error);
            }
        });
    });

</script>