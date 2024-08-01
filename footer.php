<!DOCTYPE html>
<html lang="en">

<?php
include('header.php');
include('admin/db_connect.php');

// Fetch data from the database
$query = "SELECT * FROM system_settings";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Set default values if the database is empty
$email = $row['email'] ?? '';
$contact = $row['contact'] ?? '';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-fnPc5U79Z3XDwys1WtIq0hW1Kadv6CfqlpgbLpScKv9URmyu5P/uHDl5fjF5NWgCfzLxiD5znO0R5caMSfTTvew=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh; /* Set minimum height to 100% of the viewport height */
            display: flex;
            flex-direction: column;
        }

        #footer-tall {
            background-color: #002333;
            padding: 60px 0;
            color: #dcdee1;
            flex-shrink: 0; /* Do not allow the footer to shrink */
        }

        .site-footer {
            min-width: auto;
        }

        .site-footer,
        .site-footer-mobile,
        .site-header,
        .site-header-mobile {
            background-color: #002333;
        }

        .site-footer {
            font-family: gt walsheim pro, helvetica, arial, sans-serif;
            min-width: 960px;
            padding: 30px 24px;
            line-height: 26px;
        }

        .flex-grid {
            max-width: 1190px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .flex-grid-wrapper {
            margin-bottom: 24px;
            padding: 0 30px;
        }

        .base-footer {
            font-size: 13px;
            line-height: 18px;
            display: flex;
            align-items: center;
            border-top: #FF5722 1px solid;
            padding: 10px 0;
        }

        .footer-logo {
            max-width: 160px;
            margin-right: 20px;
            margin-bottom: 9px;
        }

        #footer-tall .base-footer .footer-title {
            -ms-flex-positive: 1;
            flex-grow: 1;
            
        }

        #footer-tall .base-footer .footer-links a {
            color: #fff; /* Set color to white */
            margin-right: 20px;
            text-decoration: none;
        }

        #footer-tall .base-footer .social {
            margin-left: auto;
            display: flex;
            flex-wrap: wrap;
        }

        .social a {
            color: #fff;
            /* Adjust color based on your design */
            font-size: 20px;
            margin-right: 15px;
            text-decoration: none;
        }

        .social a:hover {
            color: #ffcc00;
        }

        .sv{
            margin-right: 3px;
            margin-left: 0;
        }
    </style>
</head>

<body>
<div class="content">
    <footer>
        <div class="footer-flex-grid site-footer" id="footer-tall">
            <div class="flex-grid">
                <div class="flex-grid-wrapper">

                    <div class="base-footer clear">
                        <img class="footer-logo" src="assets/logo/upgrad-logo.svg" alt="Your Logo">

                        <span class="footer-title footer-section">© Snehal, Rishita, Satya, Sarbani, Shreyasi, Co.
                            2023</span>

                        <span class="footer-links">
                            <a class="footer-section">Email:
                                <?php echo $email; ?>
                            </a>
                            <span class="footer-section">Phone:
                                <?php echo $contact; ?>
                            </span>
                        </span>

                        <div class="social clear">
                            <a href="https://www.facebook.com/" target="_blank" rel="noreferrer" class="fab fa-facebook sv" title="Facebook"></a>
                            <a href="https://www.instagram.com/" target="_blank" rel="noreferrer" class="fab fa-instagram sv" title="Instagram"></a>
                            <a href="https://twitter.com/login" target="_blank" rel="noreferrer" class="fab fa-twitter sv" title="Twitter"></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </footer>
    </div>
</body>

</html>
