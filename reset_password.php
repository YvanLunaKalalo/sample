<?php
    include("database.php");
    session_start();

    $error = "";
    $success = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        if (empty($email)){
            $error = "All fields are required.";
        }
        else{
            $sql = "SELECT username FROM employee WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['reset_username'] = $row['username']; // store for reset_form.php
                header("Location: reset_form.php");
                exit();
            } 
            else {
                $error = "Email not found.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EMS || Reset Password</title>
    <link rel="stylesheet" href="/sample/css/style.css">
</head>

<body>
    <div class="login-container1">
        <div class="login-box">
            <h1>Reset Password</h1>

            <form method="POST" action="">
                <label>Enter your email:</label>
                <input type="email" name="email" required>

                <input type="submit" value="Continue">

                <?php if (!empty($error)): ?>
                    <p style='color: red; margin-top: 10px;'><?php echo $error; ?></p>
                <?php endif; ?>
            </form>

            <a href="login.php">Go Back to Login</a>
        </div>
    </div>
</body>
</html>

<?php 
    mysqli_close($conn); 
?>
