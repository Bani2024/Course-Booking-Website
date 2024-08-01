<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN-CourseBooker</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/fav/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />
    <!-- Add more stylesheets or resources as needed -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="admin_css/style.css">
    <style>
        body {
            margin: 0;
            font-family: 'Merriweather Sans', sans-serif;
            background-color: #f8f9fa;
        }


        /*admin navbar*/
.nav {
    height: 100%;
    width: 10%;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #002333;
    overflow-x: hidden;
    padding-top: 25px;
    box-shadow: 0px 0px 10px 0px #8888883d;
}

.nav a {
    padding: 15px 20px;
    text-decoration: none;
    font-size: 18px;
    color: #ffffff;
    display: block;
    transition: 0.3s;

}

.logo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    position: absolute;
    margin-top: 5px;
    margin-left: 25%;
}

.nav-item {
    padding: 10px;
    transition: background-color 0.3s ease;
    color: #fff;
}

.wew {
    padding: 10px;
    transition: background-color 0.3s ease;
    color: #fff;
}

.logout-link:hover {
    background-color: #ff5722;
    /* Change the hover background color as needed */
}

#nav-link.active {
    background-color: #ff5722; /* Change the active background color as needed */
    color: #ffffff;
}
.nav-link:hover {
    color: white; /* Change the hover text color as needed */
    background-color: #ff5722;
    border-radius: 5px;
}

.nav-link {
    text-decoration: none;
    color: #ffffff;
    /* Set the text color */
}

.nav-link i {
    margin-right: 8px;
    color: #fff;
}
.nav a:hover {
    
}

.logout-link {
    text-decoration: none;
    color: #ffffff;
    border-radius: 5px;
    background-color: #f34915;
}

.logout-link:hover {
    color: #ffffff;
    /* Underline the link on hover */
}

    </style>
</head>

<body>
    <ul class="nav flex-column">
    <img class="logo" src="assets/fav/admin.png" alt="Logo">
    <br>
    <br>
    <br>
    <br>
        <li class="nav-item">
            <a id="nav-home" class="nav-link" aria-current="page" href="index.php"><i class="fa fa-home"></i> Intro</a>
        </li>
        <li class="nav-item">
            <a id="nav-courses" class="nav-link" aria-current="page" href="course_manage.php"><i class="fa fa-book"></i> Courses</a>
        </li>
        <li class="nav-item">
            <a id="nav-category" class="nav-link" aria-current="page" href="Category_List.php"><i class="fa fa-list"></i> Category</a>
        </li>
        <li class="nav-item">
            <a id="nav-joined" class="nav-link" aria-current="page" href="registered.php?page=registered"><i class="fa fa-user-plus"></i> Joined</a>
        </li>
        <li class="nav-item">
            <a id="nav-user" class="nav-link" href="users.php"><i class="fa fa-users"></i> User</a>
        </li>
        <li class="nav-item">
            <a id="nav-settings" class="nav-link" aria-current="page" href="site_settings.php"><i class="fa fa-cogs"></i> Settings</a>
        </li>
        <li class="wew mt-auto">
        <a href="ajax.php?action=logout" class="logout-link"><i class="fa fa-power-off"></i> Logout</a>
        </li>
    </ul>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
 <script>
 $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>

    </script>
</body>

</html>