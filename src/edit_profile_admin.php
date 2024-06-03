<?php
    include 'condb.php';

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $emp_username = $_POST['emp_username'];
        $emp_firstname = $_POST['emp_firstname'];
        $emp_lastname = $_POST['emp_lastname'];
        $emp_email = $_POST['emp_email'];
        $emp_tel = $_POST['emp_tel'];
        $emp_password = $_POST['emp_password'];

        // Check if a new picture is uploaded
        if(isset($_FILES['emp_picture']) && $_FILES['emp_picture']['error'] === UPLOAD_ERR_OK) {
            $emp_picture = $_FILES['emp_picture']['name'];
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["emp_picture"]["name"]);
            move_uploaded_file($_FILES["emp_picture"]["tmp_name"], $target_file);
        } else {
            // If no new picture is uploaded, use the current picture
            $emp_picture = $_POST['current_picture'];
        }

        // Prepare SQL statement with prepared statement
        $sql = "UPDATE employees SET 
                emp_firstname = ?,
                emp_lastname = ?,
                emp_email = ?,
                emp_tel = ?,
                emp_password = ?,
                emp_picture = ?
                WHERE emp_username = ?";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "sssssss", $emp_firstname, $emp_lastname, $emp_email, $emp_tel, $emp_password, $emp_picture, $emp_username);

        // Execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to the desired page after successful update
            header("Location: form_edit_profile.php");
            exit(); // Make sure to exit after header to stop further execution
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    // Close the database connection
    mysqli_close($conn);
?>
