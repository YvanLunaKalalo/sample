<?php
    include("database.php");
    session_start();

    if (!isset($_SESSION['reset_username'])) {
        header("Location: /sample/reset_password.php");
        exit();
    }

    $error = "";
    $success = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];
        $username = $_SESSION['reset_username'];

        if (empty($new_password) && empty($confirm_password)) {
            $error = "All fields are required.";
        } 

        elseif ($new_password !== $confirm_password) {
            $error = "Passwords do not match.";
        } 

        elseif (strlen($new_password) < 6) {
            $error = "Password must be at least 6 characters.";
        } 

        else {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE employee SET password = '$hashed_password' WHERE username = '$username'";
            
            if (mysqli_query($conn, $sql)) {
                $success = true;
                unset($_SESSION['reset_username']);
            } 
            else {
                $error = "Error updating password.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EMS || Set New Password</title>
    <link rel="stylesheet" href="/sample/css/style.css">
</head>

<body>
    <div class="login-container1">
        <div class="login-box">
            <h1>Set New Password</h1>

            <form method="POST" action="">
                <label>New Password:</label>
                <input type="password" name="new_password" required>

                <label>Confirm New Password:</label>
                <input type="password" name="confirm_password" required>

                <input type="submit" value="Reset Password">

                <?php if (!empty($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </form>

            <a href="reset_password.php">Go Back to Form</a>

            <?php if ($success): ?>
                <script>
                    alert("Password has been reset successfully!");
                    window.location.href = "/sample/login.php";
                </script>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php 
    mysqli_close($conn); 
?>
