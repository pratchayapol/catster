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

        // Check if a new picture is uploaded
        if(isset($_FILES['emp_picture']) && $_FILES['emp_picture']['error'] === UPLOAD_ERR_OK) {
            // Get file details
            $emp_picture = $_FILES['emp_picture']['name'];
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["emp_picture"]["name"]);

            // Move uploaded file to target directory
            if(move_uploaded_file($_FILES["emp_picture"]["tmp_name"], $target_file)) {
                // Update database with new picture filename
                $sql = "UPDATE employees SET 
                        emp_picture = ?
                        WHERE emp_username = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $emp_picture, $emp_username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                // Handle error if file upload fails
                echo "Error uploading file.";
            }
        }

        // Prepare SQL statement for updating other employee details
        $sql = "UPDATE employees SET 
                emp_firstname = ?,
                emp_lastname = ?,
                emp_email = ?,
                emp_tel = ?
                WHERE emp_username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $emp_firstname, $emp_lastname, $emp_email, $emp_tel, $emp_username);
        
        // Execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to the desired page after successful update
            header("Location: admin.php");
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
