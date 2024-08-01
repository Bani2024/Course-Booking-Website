<?php
// admin_login.php
include('admin_header.php');
include('db_connect.php');
$login = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $login = 1;
        session_start();
        $_SESSION['username'] = $username;
        header('location: index.php'); // Replace with the appropriate file
    } else {
        $invalid = 1;
        header('location: admin_login.php');
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- User Login Content -->
<!-- your code start -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin_css/style.css">
    <!-- Add your custom styles here -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            box-shadow: 0px 0px 10px 0px #8888883d;
            border-radius: 10px;
            padding: 30px;
            margin-top: 12%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="./assets/images/admin1.jpg" alt="image" class="img-fluid" width="100%">
            </div>
            <div class="col-lg-6">
                <div class="login-form">
                    <h2 class="text-center mb-4">Admin Login</h2>
                    <form action="admin_login.php" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $('#login-form').submit(function(e){
        e.preventDefault();
        $('#login-form button[type="submit"]').attr('disabled', true).html('Logging in...');
        if ($(this).find('.alert-danger').length > 0)
            $(this).find('.alert-danger').remove();

        $.ajax({
            url: 'ajax.php?action=login',
            method: 'POST', // Change this to POST
            data: $(this).serialize(),
            dataType: 'json', // Add this line
            error: function(err){
                console.log(err);
                $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
            },
            success: function(resp){
                if (resp == 1) {
                    location.href ='index.php?page=home';
                } else if (resp == 2) {
                    location.href ='index.php';
                } else {
                    $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
                    $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
                }
            }
        });
    });
</script>
</html>



















<!-- your code end -->
<!-- User Login Content -->
