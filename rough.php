<?php
include('db.php');  // Includes the database connection file to establish a connection to the database.

$popupMsg = "";  // Initializes an empty string for the popup message to display feedback to the user.
$popupType = "";  // Initializes an empty string for the popup type (e.g., "success" or "error") to style the message.

if (isset($_POST['register'])) {  // Checks if the form was submitted with the 'register' button (POST request).
    $roll_no  = trim($_POST['roll_no']);  // Retrieves and trims whitespace from the 'roll_no' input field.
    $name     = trim($_POST['name']);  // Retrieves and trims whitespace from the 'name' input field.
    $class    = trim($_POST['class']);  // Retrieves and trims whitespace from the 'class' input field.
    $section  = trim($_POST['section']);  // Retrieves and trims whitespace from the 'section' input field.
    $sem      = $_POST['sem'];  // Retrieves the 'sem' (semester) value from the select dropdown.
    $email    = trim($_POST['email']);  // Retrieves and trims whitespace from the 'email' input field.
    $dob      = trim($_POST['dob']);  // Retrieves and trims whitespace from the 'dob' (date of birth) input field.
    $password = trim($_POST['password']);  // Retrieves and trims whitespace from the 'password' input field.
    $cpassword= trim($_POST['cpassword']);  // Retrieves and trims whitespace from the 'cpassword' (confirm password) input field.
    $phone    = trim($_POST['phone']);  // Retrieves and trims whitespace from the 'phone' input field.
    $profile  = NULL;  // Initializes the profile variable to NULL (no image by default).

    // Profile picture
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {  // Checks if a profile picture file was uploaded without errors.
        $profile = addslashes(file_get_contents($_FILES['profile']['tmp_name']));  // Reads the uploaded file content and escapes special characters for database insertion.
    }

    // Validation
    if (!preg_match("/^[0-9]+$/", $roll_no)) {  // Validates that roll_no contains only digits.
        $popupMsg = "Enter a valid Roll Number.";  // Sets error message.
        $popupType = "error";  // Sets popup type to error.
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {  // Validates that name contains only letters and spaces.
        $popupMsg = "Invalid name. Only letters and spaces allowed.";  // Sets error message.
        $popupType = "error";  // Sets popup type to error.
    } elseif (empty($class)) {  // Checks if class is empty.
        $popupMsg = "Class is required.";  // Sets error message.
        $popupType = "error";  // Sets popup type to error.
    } elseif (empty($section)) {  // Checks if section is empty.
        $popupMsg = "Section is required.";  // Sets error message.
        $popupType = "error";  // Sets popup type to error.
    } elseif (empty($sem)) {  // Checks if semester is not selected.
        $popupMsg = "Select a semester.";  // Sets error message.
        $popupType = "error";  // Sets popup type to error.
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  // Validates email format.
        $popupMsg = "Enter a valid email.";  // Sets error message.
        $popupType = "error";  // Sets popup type to error.
    } elseif (empty($dob) || strtotime($dob) >= strtotime(date('Y-m-d'))) {  // Checks if DOB is empty or in the future.
        $popupMsg = "Enter a valid Date of Birth.";  // Sets error message.
        $popupType = "error";  // Sets popup type to error.
    } elseif (strlen($password) < 8) {  // Checks if password is less than 8 characters.
        $popupMsg = "Password must be at least 8 characters.";  // Sets error message.
        $popupType = "error";  // Sets popup type to error.
    } elseif ($password !== $cpassword) {  // Checks if password and confirm password match.
        $popupMsg = "Passwords do not match.";  // Sets error message.
        $popupType = "error";  // Sets popup type to error.
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {  // Validates that phone is exactly 10 digits.
        $popupMsg = "Enter a valid 10-digit phone number.";  // Sets error message.
        $popupType = "error";  // Sets popup type to error.
    } else {
        // Check duplicate
        $check = mysqli_query($conn, "SELECT * FROM users WHERE roll_no='$roll_no' OR email='$email'");  // Queries the database to check for existing roll_no or email.
        if (mysqli_num_rows($check) > 0) {  // If a duplicate is found.
            $popupMsg = "Roll Number or Email already exists.";  // Sets error message.
            $popupType = "error";  // Sets popup type to error.
        } else {
            // Insert
            $sql = "INSERT INTO users 
                   (roll_no, name, class, section, sem, email, dob, password, phone, profile) 
                   VALUES ('$roll_no', '$name', '$class', '$section', '$sem', '$email', '$dob', '$password', '$phone', '$profile')";  // Prepares the SQL insert statement.
            
            if (mysqli_query($conn, $sql)) {  // Executes the insert query.
                $popupMsg = "Registration Successful!";  // Sets success message.
                $popupType = "success";  // Sets popup type to success.
            } else {
                $popupMsg = "Registration Failed!";  // Sets error message if insert fails.
                $popupType = "error";  // Sets popup type to error.
            }
        }
    }
}
?>