<?php
session_start();

include('header.php');
include('admin/db_connect.php');
include('navbar.php');

?>
<head>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        /* New style for hero image slider */
        .swiper-container {
            margin-top: 3.62%;
            width: 100%;
            height: 320px;
            overflow: hidden;
            position: relative;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper-pagination {
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
            z-index: 2;
        }

        .swiper-pagination-bullet {
            background-color: #fff;
            margin: 0 5px;
        }

        .swiper-pagination-bullet-active {
            background-color: #FF5722;
        }

        /* New style for the "Popular Courses" button */
        .popular-courses-button {
            display: inline-block;
            margin: 20px auto;
            /* Center horizontally and provide some top margin */
            padding: 15px 30px;
            /* Adjust padding as needed */
            background-color: #FF5722;
            color: #fff;
            font-size: 18px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            /* Add box shadow */
            transition: background-color 0.3s ease;
            /* Smooth transition on hover */
        }

        .popular-courses-button:hover {
            background-color: #ef4611;
            /* Darker color on hover */
            text-decoration: none;
        }

        .course-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
            box-sizing: border-box;
        }

        .course {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            width: 300px;
        }

        .course img {
            width: 100%;
            height: auto;
            border-radius: 8px 8px 0 0;
        }

        .course-content {
            padding: 20px;
        }

        .course h3 {
            margin: 0;
            color: #333;
        }

        .course p {
            color: #666;
        }

        .swiper-universe {
            margin-top: 60px;
            max-width: 80%;
            margin-left: auto;
            margin-right: auto;
            position: relative;
        }

        .swiper-sli img {
            width: 80%;
            object-fit: cover;
        }

        .IconList_icon__nyW14 {
            width: auto;
            height: 65px;
            padding: 8px 5px;
            margin: 0 8px;
            background-color: #fff;
            box-shadow: 0 4px 10px hsla(0, 0%, 54%, .24);
            border-radius: 10px;
        }

        .icon {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            transition: transform 0.3s ease-in-out;
        }

        .icon:hover {
            transform: scale(1.1);
        }


        .iconist {

            font-style: normal;
            font-weight: 600;
            font-size: 40px;
            line-height: 120%;
            color: #222;

        }

        .cour {
            background-color:#f3f3f3; 
        }
    </style>
</head>

<body>
    <!-- Hero Image Slider Section -->
    <section class="swiper-container">
        <div class="swiper-wrapper">
            <!-- Banner 1 -->
            <div class="swiper-slide">
                <img src="assets/banners/banner1.png" alt="Banner 1">
            </div>

            <!-- Banner 2 -->
            <div class="swiper-slide">
                <img src="assets/banners/banner2.png" alt="Banner 2">
            </div>

            <!-- Banner 3 -->
            <div class="swiper-slide">
                <img src="assets/banners/banner3.png" alt="Banner 3">
            </div>
            <!-- Add more banners as needed -->
        </div>
        <!-- Add Pagination outside swiper-wrapper -->
        <div class="swiper-pagination"></div>
    </section>


    <!-- Courses Section -->
    <section class="cour" style="text-align: center;">
        <!-- "EXPLORE OUR COURSES" button -->
        <a href="#course-section" class="popular-courses-button" onclick="scrollToCourses()">EXPLORE OUR COURSES</a>
        <div class="course-container" id="course-container">
            <!-- Courses will be dynamically added here -->
        </div>
    </section>
    <br>
    <br>

    <section class="swiper-universe">
        <div class="container">
            <h2 class="iconist">Our Top University Partners</h2>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="  swiper-sli">
                        <img class="IconList_icon__nyW14" src="assets/banners/university (1).png" alt="University 1"
                            style="width: 196.154px;">
                    </div>
                    <div class="   swiper-sli">
                        <img class="IconList_icon__nyW14" src="assets/banners/university (2).png" alt="University 2"
                            style="width: 196.154px;">
                    </div>
                    <div class="   swiper-sli">
                        <img class="IconList_icon__nyW14" src="assets/banners/university (3).png" alt="University 3"
                            style="width: 196.154px;">
                    </div>
                    <div class="   swiper-sli">
                        <img class="IconList_icon__nyW14" src="assets/banners/university (4).png" alt="University 4"
                            style="width: 196.154px;">
                    </div>
                    <div class="   swiper-sli">
                        <img class="IconList_icon__nyW14" src="assets/banners/university (5).png" alt="University 5"
                            style="width: 196.154px;">
                    </div>
                    <div class="   swiper-sli">
                        <img class="IconList_icon__nyW14" src="assets/banners/university (6).png" alt="University 6"
                            style="width: 196.154px;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="course-section">
        <?php include('course.php'); ?>
    </section>



    <!-- Footer -->
    <?php
    include('footer.php');
    ?>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="javascript/scripts.js"></script>
    <script>

        var mainSwiper = new Swiper('.swiper-container', {
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 3000,
            },
        });

        function scrollToCourses() {
            var targetElement = document.getElementById('course-section');
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }

        // Fetch and display courses dynamically
        function fetchCourses() {
            // Use AJAX to fetch data from the server
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Parse the JSON response
                    var courses = JSON.parse(xhr.responseText);

                    // Get the course container
                    var courseContainer = document.getElementById("course-container");

                    // Clear existing content
                    courseContainer.innerHTML = "";

                    // Iterate through the courses and create course cards
                    courses.forEach(function (course) {
                        var courseCard = document.createElement("div");
                        courseCard.className = "course";

                        var courseImage = document.createElement("div");
                        courseImage.className = "course-image";
                        var img = document.createElement("img");
                        img.src = course.image_url;
                        img.alt = course.title;
                        courseImage.appendChild(img);

                        var courseContent = document.createElement("div");
                        courseContent.className = "course-content";
                        var h3 = document.createElement("h3");
                        h3.textContent = course.title;
                        var p = document.createElement("p");
                        p.textContent = course.description;

                        courseContent.appendChild(h3);
                        courseContent.appendChild(p);

                        courseCard.appendChild(courseImage);
                        courseCard.appendChild(courseContent);

                        courseContainer.appendChild(courseCard);
                    });
                }
            };

            // Open a GET request to fetch courses.php
            xhr.open("GET", "courses.php", true);
            xhr.send();
        }

        // Call fetchCourses when the page loads
        window.onload = fetchCourses;

    </script>
</body>

</html>