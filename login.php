<?php
include('header.php');
include('admin/db_connect.php');

$login = 0;
$invalid = 0;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('admin/db_connect.php');
    $identifier = $_POST['identifier']; // This can be either username or email
    $password = $_POST['password'];

    // Update the SQL query to check both username and email
    $sql = "SELECT * FROM signup WHERE (username='$identifier' OR email='$identifier') AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);

        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['username'] = $row['username'];
        

            $login = 1;
            header('location:index.php');
            exit();
        } else {
            $invalid = 1;
            $error_message = 'Invalid username or password';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
        }

        .login-container {
            border-radius: 5px;
            background-color: #fff;
            max-width: 70%;
            margin: 0 auto;
            margin-bottom: 10%;
            padding: 5%;
            transition: all 0.3s ease;
        }

        .login-image {
            max-width: 100%;
            height: auto;
            margin-top: -30px;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container mt-5">
        <div class="login-container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="./assets/images/login.png" alt="image" class="login-image" width="800" height="600">
                </div>
                <div class="col-lg-6">
                    <div class="login-form">
                        <h2 class="text-center">Login</h2>
                        <form action="login.php" method="post">
                            <div class="mb-3">
                                <label for="identifier" class="form-label">Firstname or Email</label>
                                <input type="text" class="form-control" id="identifier" name="identifier" required>
                                <?php
                                if ($invalid == 1) {
                                    echo '<div class="text-danger">' . $error_message . '</div>';
                                }
                                ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                            <br>
                            <div>
                                <br>
                                <p>Not yet a member? <a href="register.php">Signup</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
