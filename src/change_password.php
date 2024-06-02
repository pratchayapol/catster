<?php
    // Start session
    session_start();

    // Include database connection
    include 'condb.php';

    // Check database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if old password, new password, and confirm password are set
    if (isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['cf_password'])) {
        // Get username from session
        $username = $_SESSION['username'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $cf_password = $_POST['cf_password'];

        // SQL query to retrieve password from database
        $sql = "SELECT mem_password FROM members WHERE mem_username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['mem_password'];

            // Verify old password
            if ($old_password === $stored_password) {
                // Check if new password and confirm password match
                if ($new_password === $cf_password) {
                    // Update password in the database
                    $update_sql = "UPDATE members SET mem_password = ? WHERE mem_username = ?";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bind_param("ss", $new_password, $username);
                    
                    if ($update_stmt->execute()) {
                        echo "<script>alert('รหัสผ่านถูกเปลี่ยนแล้ว');</script>";
                        echo "<script>window.location='form_change_password.php';</script>";
                    } else {
                        echo "Error updating password: " . $conn->error;
                    }
                } else {
                    echo "<script>alert('รหัสผ่านใหม่และยืนยันรหัสผ่านไม่ตรงกัน');</script>";
                    echo "<script>window.location='form_change_password.php';</script>";
                }
            } else {
                echo "<script>alert('รหัสผ่านเดิมไม่ถูกต้อง');</script>";
                echo "<script>window.location='form_change_password.php';</script>";
            }
        } else {
            echo "<script>alert('ไม่พบผู้ใช้งาน');</script>";
        }
    }

    // Close database connection
    $conn->close();
?>
