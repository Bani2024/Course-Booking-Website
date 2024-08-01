<?php

Class Action {
    private $db;

    public function __construct() {
        ob_start();
        include 'db_connect.php';

        $this->db = $conn;
    }

    function __destruct() {
        $this->db->close();
        ob_end_flush();
    }

    public function login()
    {
        extract($_POST);
        $qry = $this->db->query("SELECT * FROM users where username = '" . $username . "' and password = '" . $password . "' ");
        if ($qry->num_rows > 0) {
            foreach ($qry->fetch_array() as $key => $value) {
                if ($key != 'password' && !is_numeric($key))
                    $_SESSION['login_' . $key] = $value;
            }
            $_SESSION['login_type'] = isset($_SESSION['login_type']) ? $_SESSION['login_type'] : 0; // Ensure login_type is set
            if ($_SESSION['login_type'] == 1)
                return 1;
            else
                return 2;
        } else {
            return 3;
        }
    }

    public function logout()
    {
        session_destroy();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        header("location:admin_login.php");
        return 1;
    }

    public function save_user()
    {
        extract($_POST);
        $data = " name = '$name' ";
        $data .= ", username = '$username' ";
        $data .= ", password = '$password' ";
        $data .= ", type = '$type' ";
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO users set " . $data);
        } else {
            $save = $this->db->query("UPDATE users set " . $data . " where id = " . $id);
        }
        if ($save) {
            return 1;
        }
    }

    public function get_courses()
    {
        $result = array();
        $qry = $this->db->query("SELECT * FROM courses");
        while ($row = $qry->fetch_assoc()) {
            $result[] = $row;
        }
        return $result;
    }
    public function save_course() {
        try {
            // Validate the inputs (you may add more validation as needed)
            $title = $_POST['title'];
            $description = $_POST['description'];

            if (empty($title) || empty($description)) {
                echo json_encode(['success' => false, 'message' => 'Title and Description are required.']);
                exit;
            }

            // Handle image upload (you may need to adjust the path and file handling based on your setup)
            $imagePath = 'course_img/uploads'; // Change this to your desired upload directory
            $imageName = uniqid() . '_' . $_FILES['image']['name'];
            $targetPath = $imagePath . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                // Image uploaded successfully, proceed to save the course details
                $title = $this->db->real_escape_string($title);
                $description = $this->db->real_escape_string($description);
                $category_id = $this->db->real_escape_string($_POST['category']); // Assuming the category comes from the form
                $imageName = $this->db->real_escape_string($imageName);

                $saveQuery = "INSERT INTO courses (title, description, image_url, category_id) VALUES ('$title', '$description', '$imageName', '$category_id')";
                $saveResult = $this->db->query($saveQuery);

                if ($saveResult) {
                    echo json_encode(['success' => true, 'message' => 'Course saved successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to save course.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to upload image.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }

    public function delete_course($course_id)
    {
        $course_id = $this->db->real_escape_string($course_id);
        $delete_query = "DELETE FROM courses WHERE id = $course_id";
        $delete_result = $this->db->query($delete_query);

        if ($delete_result) {
            return true;
        } else {
            return false;
        }
    }


    public function save_settings()
    {
        extract($_POST);

        // Sanitize and escape user inputs
        $email = $this->db->real_escape_string($email);
        $contact = $this->db->real_escape_string($contact);

        $data = "email = '$email', 
                 contact = '$contact'";

        $chk = $this->db->query("SELECT * FROM system_settings");

        if ($chk->num_rows > 0) {
            $save = $this->db->query("UPDATE system_settings SET $data");
        } else {
            $save = $this->db->query("INSERT INTO system_settings SET $data");
        }

        if ($save) {
            $query = $this->db->query("SELECT email, contact FROM system_settings LIMIT 1")->fetch_assoc();
            // Assuming that the column names in the system_settings table match your $_SESSION keys
            foreach ($query as $key => $value) {
                if (!is_numeric($key)) {
                    $_SESSION['setting_' . $key] = $value;
                }
            }
            return 1; // Success
        } else {
            return 0; // Failed
        }
    }



    public function get_categories()
    {
        $result = array();
        $qry = $this->db->query("SELECT * FROM categories");
        while ($row = $qry->fetch_assoc()) {
            $result[] = $row;
        }
        return $result;
    }

    public function save_category($new_category)
    {
        $new_category = $this->db->real_escape_string($new_category);
        $insert_query = "INSERT INTO categories (name) VALUES ('$new_category')";
        $insert_result = $this->db->query($insert_query);

        if ($insert_result) {
            return true;
        } else {
            return false;
        }
    }
    public function delete_category($category_id)
    {
        $delete_query = "DELETE FROM categories WHERE id = $category_id";
        $delete_result = $this->db->query($delete_query);

        if ($delete_result) {
            return true;
        } else {
            return false;
        }
    }
    public function update_category($category_id, $updated_category)
    {
        $category_id = $this->db->real_escape_string($category_id);
        $updated_category = $this->db->real_escape_string($updated_category);

        $update_query = "UPDATE categories SET name = '$updated_category' WHERE id = $category_id";
        $update_result = $this->db->query($update_query);

        if ($update_result) {
            return true;
        } else {
            return false;
        }
    }
    public function get_user_details($user_id)
    {
        $user_id = $this->db->real_escape_string($user_id);
        $query = $this->db->query("SELECT * FROM users WHERE id = $user_id");

        if ($query->num_rows > 0) {
            return $query->fetch_assoc();
        }

        return null;
    }

    public function delete_user($user_id)
    {
        $user_id = $this->db->real_escape_string($user_id);
        $delete_query = "DELETE FROM users WHERE id = $user_id";
        $delete_result = $this->db->query($delete_query);

        return $delete_result;
    }

    public function saveAdmissionForm($formData)
    {
        extract($formData);
    
        // Sanitize and escape user inputs
        $first_name = $this->db->real_escape_string($first_name);
        $last_name = $this->db->real_escape_string($last_name);
        $birth_date_month = $this->db->real_escape_string($birth_date_month);
        $birth_date_day = $this->db->real_escape_string($birth_date_day);
        $birth_date_year = $this->db->real_escape_string($birth_date_year);
        $gender = $this->db->real_escape_string($gender);
        $citizenship = $this->db->real_escape_string($citizenship);
        $phone = $this->db->real_escape_string($phone);
        $email = $this->db->real_escape_string($email);
        $address = $this->db->real_escape_string($address);
        $city = $this->db->real_escape_string($city);
        $zip_code = $this->db->real_escape_string($zip_code);
        $state = $this->db->real_escape_string($state);
        $high_school = $this->db->real_escape_string($high_school);
        $marks_10th = $this->db->real_escape_string($marks_10th);
        $marks_12th = $this->db->real_escape_string($marks_12th);
        $category = $this->db->real_escape_string($category);
        $course = $this->db->real_escape_string($course);
        // Insert form data into the admission_forms table
        $insertQuery = "INSERT INTO admission_forms (first_name, last_name, birth_date_month, birth_date_day, birth_date_year, gender, citizenship, phone, email, address, city, zip_code, state, high_school, marks_10th, marks_12th, category, course)
            VALUES ('$first_name', '$last_name', '$birth_date_month', '$birth_date_day', '$birth_date_year', '$gender', '$citizenship', '$phone', '$email', '$address', '$city', '$zip_code', '$state', '$high_school', '$marks_10th', '$marks_12th', '$category', '$course')";
    
        $insertResult = $this->db->query($insertQuery);
    
        if ($insertResult) {
            return ['success' => true, 'message' => 'Form data saved successfully.'];
        } else {
            return ['success' => false, 'message' => 'Failed to save form data.'];
        }
    }

    public function approveForm($admissionId)
    {
        $stmt = $this->db->prepare("UPDATE admission_forms SET status = 'Approved' WHERE id = ?");
        $stmt->bind_param("i", $admissionId);
        $update_result = $stmt->execute();
        $stmt->close();
    
        return $update_result;
    }
    
    public function rejectForm($admissionId)
    {
        $stmt = $this->db->prepare("UPDATE admission_forms SET status = 'Not Approved' WHERE id = ?");
        $stmt->bind_param("i", $admissionId);
        $update_result = $stmt->execute();
        $stmt->close();
    
        return $update_result;
    }




}
?>