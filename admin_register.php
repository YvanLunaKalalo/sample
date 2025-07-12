<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS || Admin Register</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/sample/css/style.css"> -->
</head>

<body>
    <div>
        <h1>Admin Register</h1>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <label>Username: </label>
            <input type="text" name="username"><br><br>

            <label>Password: </label>
            <input type="password" name="password"><br><br>

            <input type="submit" name="register" value="Register"><br><br>

        </form>
    </div>
    
</body>

</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($username) && empty($password)) {
            echo "Please enter your username and password.";
        } 
        
        else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO admin (username, password)
                        VALUES ('$username', '$hash')";

            try {
                mysqli_query($conn, $sql);
                echo "Registration Successfully!";

            } catch (mysqli_sql_exception) {
                echo "Username Taken!";
            }
        }
    }

mysqli_close($conn);

?>