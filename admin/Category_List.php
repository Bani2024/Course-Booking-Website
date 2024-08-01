<?php
include('admin_class.php');
include('admin_header.php');
include('admin_navbar.php');
include('db_connect.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include DataTables script -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container-fluid {
            padding: 20px;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            margin-left: 12%;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1.25rem;
            margin-left: 1%;
        }


        .card-title {
            color: #4c4b4b;
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
            
        }

        .btn {
            margin-top: 10px;
        }

        .list-group {
            max-height: 60vh;
            overflow-y: auto;
            border: 1px solid #dee2e6;
        }

        .list-group-item {
            cursor: pointer;
        }

        /* Add this style to position the forms and categories side by side */
        .manage-categories {
            display: flex;
            justify-content: space-between;
            margin-right: 8%;
        }

        /* Add this style to adjust the width of the forms */
        .manage-categories-forms {
            width: 48%;

        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="">
            <!-- Existing Categories and Manage Categories Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body manage-categories">
                        <!-- Existing Categories Panel -->
                        <div class="existing-categories">
                            <h5 class="card-title">Existing Categories</h5>
                            <ul id="categories-list" class="list-group">
                                <!-- Categories will be loaded here using Ajax -->
                            </ul>
                        </div>

                        <!-- Manage Categories Panel -->
                        <div class="manage-categories-forms">
                            <!-- Add Category Form -->
                            <form id="add-category-form" action="" method="post">
                                <h5 class="card-title">Add Category</h5>
                                <div class="form-group">
                                    <label for="new_category">New Category:</label>
                                    <input type="text" class="form-control" id="new_category" name="new_category"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="add_category">Add Category</button>
                            </form>

                            <br>

                            <!-- Update Category Form -->
                            <form id="update-category-form" action="" method="post">
                                <h5 class="card-title">Update Category</h5>
                                <div class="form-group">
                                    <label for="category_id_update">Select Category:</label>
                                    <select name="category_id_update" class="form-control" required>
                                        <!-- Categories will be loaded here using Ajax -->
                                    </select>
                                    <br>
                                    <input type="text" class="form-control" name="updated_category" required>
                                </div>
                                <button type="submit" class="btn btn-success" name="update_category">Update
                                    Category</button>
                            </form>

                            <br>

                            <!-- Delete Category Form -->
                            <form id="delete-category-form" action="" method="post">
                                <h5 class="card-title">Delete Category</h5>
                                <div class="form-group">
                                    <label for="category_id_delete">Select Category:</label>
                                    <select name="category_id_delete" class="form-control" required>
                                        <!-- Categories will be loaded here using Ajax -->
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-danger" name="delete_category">Delete
                                    Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Existing Categories and Manage Categories Panel -->
        </div>
    </div>

    <script>
        $(document).ready(function () {
            loadCategories();

            $('#add-category-form').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php?action=add_category',
                    data: {
                        new_category: $('#new_category').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        updateCategoriesList(data);
                        updateSelectOptions($('select[name="category_id_update"]'), data);
                        updateSelectOptions($('select[name="category_id_delete"]'), data);
                        location.reload(); // Reload the page
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#update-category-form').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php?action=update_category',
                    data: {
                        category_id_update: $('select[name="category_id_update"]').val(),
                        updated_category: $('input[name="updated_category"]').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        updateCategoriesList(data);
                        updateSelectOptions($('select[name="category_id_update"]'), data);
                        updateSelectOptions($('select[name="category_id_delete"]'), data);
                        location.reload(); // Reload the page
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#delete-category-form').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php?action=delete_category',
                    data: {
                        category_id_delete: $('select[name="category_id_delete"]').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        updateCategoriesList(data);
                        updateSelectOptions($('select[name="category_id_update"]'), data);
                        updateSelectOptions($('select[name="category_id_delete"]'), data);
                        location.reload(); // Reload the page
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        function loadCategories() {
            $.ajax({
                type: 'GET',
                url: 'ajax.php?action=get_categories',
                dataType: 'json',
                success: function (data) {
                    updateCategoriesList(data);
                    updateSelectOptions($('select[name="category_id_update"]'), data);
                    updateSelectOptions($('select[name="category_id_delete"]'), data);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function updateCategoriesList(categories) {
            var categoriesList = $('#categories-list');
            categoriesList.empty();

            if (categories !== undefined && Array.isArray(categories)) {
                $.each(categories, function (index, category) {
                    if (category !== undefined && category.name !== undefined) {
                        categoriesList.append('<li class="list-group-item">' + category.name + '</li>');
                    } else {
                        console.error("Invalid category data:", category);
                    }
                });
            } else {
                console.error("Invalid categories data:", categories);
                categoriesList.append('<li class="list-group-item">No categories available</li>');
            }
        }

        function updateSelectOptions(selectElement, categories) {
            selectElement.empty();

            if (categories !== undefined && Array.isArray(categories)) {
                $.each(categories, function (index, category) {
                    if (category !== undefined && category.name !== undefined) {
                        selectElement.append('<option value="' + category.id + '">' + category.name + '</option>');
                    } else {
                        console.error("Invalid category data:", category);
                    }
                });
            } else {
                console.error("Invalid categories data:", categories);
            }
        }
    </script>
</body>

</html>


<?php
// Close the database connection
mysqli_close($conn);
?>