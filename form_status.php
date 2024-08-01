<?php
session_start();
include('admin/db_connect.php'); 
include('header.php'); 

// Fetch the username from the session
$username = $_SESSION['username'];

// Fetch user forms from the database
$query = "SELECT * FROM admission_forms WHERE username = '$username'";
$result = mysqli_query($conn, $query);

$forms = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $forms[] = $row;
    }
} else {
    echo "No forms found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Status</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        .row {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .form-status {
            text-align: center;
            width: 300px; /* Adjust width as needed */
            margin: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-status .is-complete {
            display: block;
            border-radius: 50%;
            height: 30px;
            width: 30px;
            background-color: #f7be16;
            transition: background-color 0.25s linear;
            margin-bottom: 10px;
        }

        .form-status.accepted .is-complete {
            background-color: #27aa80;
        }

        .form-status.rejected .is-complete {
            background-color: #ff5555;
        }

        .form-status p {
            color: #A4A4A4;
            font-size: 16px;
            margin-top: 8px;
            margin-bottom: 0;
            line-height: 20px;
        }

        .form-status p span {
            font-size: 14px;
        }

        .form-status.accepted p {
            color: #27aa80;
        }

        .form-status.rejected p {
            color: #ff5555;
        }

        .form-status::before {
            /* Styles for the line */
        }

        .form-status:first-child:before {
            display: none;
        }

        .form-status.accepted:before {
            background-color: #27aa80;
        }

        .form-status.rejected:before {
            background-color: #ff5555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <?php
            foreach ($forms as $form) {
                // Determine the class based on the form status
                $statusClass = strtolower($form['status']);
                ?>

                <div class="form-status <?php echo $statusClass; ?>">
                    <span class="is-complete"></span>
                    <p><?php echo $form['status']; ?><br><span><?php echo $form['created_at']; ?></span></p>
                    <p>Course: <?php echo $form['course']; ?><br>Category: <?php echo $form['category']; ?></p>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>
