<?php
    include("database.php");
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $error = "";
    $success = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $old_password = $_POST["old_password"];
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];

        $username = $_SESSION['username'];

        if (empty($old_password) || empty($new_password) || empty($confirm_password)){
            $error = "All fields are required.";
        }

        else{
            $sql = "SELECT password FROM employee WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            
            $row = mysqli_fetch_assoc($result);

            if (!password_verify($old_password, $row['password'])) {
                $error = "Old password is incorrect.";
            } 

            elseif ($new_password !== $confirm_password) {
                $error = "New passwords do not match.";
            } 

            elseif (strlen($new_password) < 6) {
                $error = "New password must be at least 6 characters.";
            } 

            else {
                $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_sql = "UPDATE employee SET password = '$new_hashed_password' WHERE username = '$username'";

                try{
                    mysqli_query($conn, $update_sql);
                    $success = true;
                }
                catch(mysqli_sql_exception){
                    $error = "Error updating password.";

                }
            }
        }    
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EMS || Change Password</title>
    <link rel="stylesheet" href="/sample/css/style.css">
</head>

<body>
    <div class="login-container1">
        <div class="login-box">
            <h1>Change Password</h1>

            <form method="POST" action="">
                <label>Old Password:</label>
                <input type="password" name="old_password" required>

                <label>New Password:</label>
                <input type="password" name="new_password" required>

                <label>Confirm New Password:</label>
                <input type="password" name="confirm_password" required>

                <input type="submit" value="Change Password">

                <a href="admin/admin_dashboard.php">Go Back to Dashboard</a>

                <?php
                    if (!empty($error)) {
                        echo "<p style='color: red; margin-top: 10px;'>$error</p>";
                    }
                ?>
            </form>

            <?php if ($success): ?>
                <script>
                    alert("Password updated successfully!");
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        window.location.href = "/sample/admin/admin_dashboard.php";
                    <?php else: ?>
                        window.location.href = "/sample/employee/user_dashboard.php";
                    <?php endif; ?>
                </script>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>

<?php 
    mysqli_close($conn); 
?>
