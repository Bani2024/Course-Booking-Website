<?php
ob_start();

$action = isset($_GET['action']) ? $_GET['action'] : '';

include 'admin_class.php';
$crud = new Action();

// Set headers for JSON response
header('Content-Type: application/json');

if ($action == 'login') {
    $login = $crud->login();
    echo json_encode(['result' => $login]);
} elseif ($action == 'logout') {
    $logout = $crud->logout();
    echo json_encode(['result' => $logout]);
} elseif ($action == 'save_user') {
    $save = $crud->save_user();
    echo json_encode(['result' => $save]);
} elseif ($action == 'save_settings') {
    $save = $crud->save_settings();
    echo json_encode(['result' => $save]);
} elseif ($action == 'get_courses') {
    $courses = $crud->get_courses();
    echo json_encode($courses);
} elseif ($action == 'delete_course') {
    $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : '';
    $result = $crud->delete_course($course_id);
    echo json_encode(['success' => $result]);
} elseif ($action == 'save_course') {
    $crud->save_course();
} elseif ($action == 'submit_form') {
    // Handle form submission
    $submit_form_result = $crud->saveAdmissionForm($_POST);
    echo json_encode($submit_form_result);
} elseif ($action == 'get_categories') {
    $categories = $crud->get_categories();
    echo json_encode($categories);
} elseif ($action == 'add_category') {
    $new_category = isset($_POST['new_category']) ? $_POST['new_category'] : '';
    if (!empty($new_category)) {
        $save_category_result = $crud->save_category($new_category);
        echo json_encode(['result' => $save_category_result]);
    } else {
        echo json_encode(['error' => 'Failed to add the category']);
    }
} elseif ($action == 'update_category') {
    $category_id_update = isset($_POST['category_id_update']) ? $_POST['category_id_update'] : '';
    $updated_category = isset($_POST['updated_category']) ? $_POST['updated_category'] : '';
    $result = $crud->update_category($category_id_update, $updated_category);
    echo json_encode(['result' => $result]);
} elseif ($action == 'delete_category') {
    $category_id_delete = isset($_POST['category_id_delete']) ? $_POST['category_id_delete'] : '';
    $result = $crud->delete_category($category_id_delete);
    echo json_encode(['result' => $result]);
} elseif ($action == 'approveform') {
    $admissionId = isset($_POST['id']) ? $_POST['id'] : '';
    $approve_result = $crud->approveForm($admissionId);
    echo json_encode(['result' => $approve_result]);
} elseif ($action == 'rejectform') {
    $admissionId = isset($_POST['id']) ? $_POST['id'] : '';
    $reject_result = $crud->rejectForm($admissionId);
    echo json_encode(['result' => $reject_result]);
} else {
    echo json_encode(['error' => 'Invalid action']);
}

// Add other cases as needed
?>
