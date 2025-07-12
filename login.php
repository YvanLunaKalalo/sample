<?php
    include("database.php");
    session_start();

    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($username) && (empty($password))){
            $error = "Please enter your username and password.";
        }

        else{ 
            $sql = "SELECT * FROM employee WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);

                if (password_verify($password, $row['password'])) {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role'] = $row['role'];

                    if ($row['role'] === 'admin') {
                        header("Location: admin/admin_dashboard.php");
                    } 

                    else {
                        header("Location: employee/user_dashboard.php");
                    }
                } 

                else{
                    $error = "Incorrect password. Please try again.";
                }

            }
            else{
                $error = "No account found.";
            }
              
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS || Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/sample/css/style.css">
</head>

<body>
    <div class="login-container1">
        <div class="login-box">
            <h1>Login</h1>

            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                <label>Username:</label>
                <input type="text" name="username">

                <label>Password:</label>
                <input type="password" name="password">

                <input type="submit" name="login" value="Login">

                <a href="/sample/reset_password.php">Reset Password</a>

                <?php 
                    if (!empty($error)){
                        echo "<p style='color: #ff6b6b; font-size: 14px; margin-top: 10px;'>{$error}</p>";
                    }      
                ?>
            </form>

            <!-- <a href="register.php">Don't have an account? Register</a> -->
        </div>
    </div>
    
</body>
</html>

<?php
    mysqli_close($conn);
?>