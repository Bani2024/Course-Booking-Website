<?php

include('admin/db_connect.php');

// Fetch categories from the database
$categoryQuery = "SELECT * FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

?>
<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
    }

    .course-section {
        background-color: #f7f7f7;
        padding: 50px 20px;
        text-align: center;
        margin-top: -6%;
    }

    .category-container {
        display: flex;
        overflow-x: auto;
        padding: 10px 20px;
        margin-bottom: 20px;
        margin-left: 8%;
    }

    .category {
        font-size: 20px;
        margin-right: 50px;
        cursor: pointer;
        color: #333;
    }

    .category:hover {
        border-bottom: #FF5722 2px solid;

    }

    .course-container {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        justify-content: flex-start;
        padding: 0 154px;
    }

    .course-card {
        border-radius: 8px;
        position: relative;
        box-shadow: 0 4px 10px rgba(0, 0, 0, .2);
        background-color: #fff;
        width: 300px;
        height: 350px;
        transition: transform 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-bottom: 20px;
        margin-right: 25px;
    }

    .course-card:hover {
        transform: scale(1.01);
    }
    .course-image {
    min-height: 85%;
}
    .course-image img {
        width: 100%;
        height: auto;
        border-radius: 8px 8px 0 0;
    }
    .course-content {
        padding: 20px;
        text-align: left;
        position: absolute;
        top: 71%;
        left: 50%;
        bottom: 50%;
        transform: translate(-50%, -50%);
        width: 263px;
        height: 160px;
        line-height: 50px;
        background-color: white;
        border-radius: 8px;
    }

    .course-content h3 {
        margin: 0;
        color: black;
        text-transform: capitalize;
    }

    .course-content p {
        color: black;
        margin: 0;
        text-transform: capitalize;
    }

    .bnsm-3 {
        align-self: center;
        margin: 0 3px 20px 0;
        border-radius: 4px;
        padding: 12px 0;
        text-decoration: none;
        color: white;
        background-color: #FF5722;
        transition: background-color 0.3s ease;
        cursor: pointer;
        border: none;
        outline: none;
        font-size: 14px;
        width: 100%;
        max-width: 258px;
        display: block;
        text-align: center;
        z-index: 1;
    }

    .bnsm-3:hover {
        background-color: #c74114;
    }

    .iconist {
        font-style: normal;
        font-weight: 600;
        font-size: 40px;
        line-height: 120%;
        color: #222;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 5;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.88);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        border-radius: 8px;
        box-sizing: border-box;
        position: relative;
        /* Added for proper positioning of the close button */
    }

    .close {
        color: #f00;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<script>
    
    function showAdmissionModal(category, course) {
    var modal = document.getElementById('admissionModal');
    modal.style.display = 'block';

    // Set category and course values in the form
    document.getElementById('category').value = category;
    document.getElementById('course').value = course;
}

function closeModal() {
    var modal = document.getElementById('admissionModal');
    modal.style.display = 'none';
}

function showCourses(categoryId) {
    // Hide all course containers
    var courseContainers = document.querySelectorAll('.course-container');
    courseContainers.forEach(function (container) {
        container.style.display = 'none';
    });

    // Show the selected category's courses
    var selectedCategory = document.getElementById(categoryId);
    if (selectedCategory) {
        selectedCategory.style.display = 'flex';
        selectedCategory.scrollIntoView({ behavior: 'smooth' });
    }
}

</script>
<section class="course-section">
    <div class="category-container">
        <h2 class="iconist">Our Courses</h2>
    </div>
    <div class="category-container">

        <?php
        // Fetch categories from the database
        $categoryQuery = "SELECT * FROM categories";
        $categoryResult = mysqli_query($conn, $categoryQuery);

        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
            $categoryId = $categoryRow['id'];
            $categoryName = $categoryRow['name'];
            ?>
            <div class="category" onclick="showCourses('<?php echo strtolower(str_replace(' ', '-', $categoryName)); ?>')">
                <?php echo $categoryName; ?>
            </div>
            <?php
        }
        ?>
    </div>
    <br>
    <br>
    <?php
    // Reset the pointer of the category result set
    mysqli_data_seek($categoryResult, 0);

    while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
        $categoryId = $categoryRow['id'];
        $categoryName = $categoryRow['name'];

        // Fetch courses for each category
        $courseQuery = "SELECT * FROM courses WHERE category_id = $categoryId";
        $courseResult = mysqli_query($conn, $courseQuery);
        ?>
        <div id="<?php echo strtolower(str_replace(' ', '-', $categoryName)); ?>" class="course-container">
            <?php
            while ($courseRow = mysqli_fetch_assoc($courseResult)) {
                ?>
                <div class="course-card">
                    <div class="course-image">
                        <img src="<?php echo 'admin/course_img/uploads' . $courseRow['image_url']; ?>" alt="Course Image">
                    </div>
                    <div class="course-content">
                        <h3>
                            <?php echo $courseRow['title']; ?>
                        </h3>
                        <p>
                            <?php echo $courseRow['description']; ?>
                        </p>
                    </div>
                    <button class="bnsm-3"
                        onclick="showAdmissionModal('<?php echo $categoryName; ?>', '<?php echo $courseRow['title']; ?>')">Register
                        Now</button>

                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
</section>
<!-- Modal for the admission form -->
<div id="admissionModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <?php include('course_form.php'); ?>
    </div>
</div>

