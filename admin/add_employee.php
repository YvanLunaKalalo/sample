<?php
    include("../database.php");
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: /sample/login.php");
    }

    $success = false;
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = filter_input(INPUT_POST, "fullname", FILTER_SANITIZE_SPECIAL_CHARS);
        $position = filter_input(INPUT_POST, "position", FILTER_SANITIZE_SPECIAL_CHARS);
        $department = filter_input(INPUT_POST, "department", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $contact = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_SPECIAL_CHARS);
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if (
            empty($fullname) || empty($position) || empty($department) ||
            empty($email) || empty($contact) || empty($username)
        ) {
            $error = "All fields except password are required.";
        }
        
        else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO employee (fullname, position, department, email, contact_number, username, password)
                    VALUES ('$fullname', '$position', '$department', '$email', '$contact', '$username', '$hash')";
            
            try {
                mysqli_query($conn, $sql);
                $success = true;
            } 
        
            catch (mysqli_sql_exception) {
                echo "An unexpected error occurred.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS || Add Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/sample/css/style.css">
</head>

<body>

    <!-- <input type="checkbox" id="checkbox"> -->

    <div class="header">
        <h2 class="u-name"><b>E </b> <b>M</b> <b>S</b>
            <!-- <label for="checkbox">
                <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
            </label> -->
        </h2> 
        <!-- <i class="fa fa-user" aria-hidden="true"></i> -->
    </div>

    <div class="body">
        <div class="side-bar">
            <div class="user-p">
                <img src="/sample/img/bubu2.jpg">

                <?php
                    echo "<h4>{$_SESSION['username']}</h4> <br><br>";
                ?>

            </div>
            <ul>

                <li>
                    <a href="/sample/admin/admin_dashboard.php">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="/sample/admin/admin_employee.php">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <span>Employee</span>
                    </a>
                <!-- </li>

                <li>
                    <a href="#">
                        <i class="fa fa-comment-o" aria-hidden="true"></i>
                        <span>Comment</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        <span>About</span>
                    </a>
                </li> -->

                <li>
                    <a href="/sample/change_password.php">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                
                <li>

                    <form action="" method="post">
                        <button type="submit" name="logout" class="logout-btn">
                            <i class="fa fa-power-off" aria-hidden="true"></i>
                            <span>Logout</span>
                        </button>
                    </form>

                </li>
            </ul>
        </div>

        <div class="section-1">
            <h1>Add Employee</h1>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

                <?php 
                    if (!empty($error)){
                        echo "<p class='margin-bottom: 20px';>{$error}</p>";

                        echo"<script>";
                        echo"   alert('Please complete all required fields before submitting.');";
                        echo"   window.location.href = '/sample/admin/admin_employee.php'";
                        echo"</script>";
                    }      
                ?>

                <label>Full Name:</label>
                <input type="text" name="fullname">

                <label>Position:</label>
                <input type="text" name="position">
                
                <label>Department:</label>
                <input type="text" name="department">

                <label>Email:</label>
                <input type="email" name="email">

                <label>Contact:</label>
                <input type="text" name="contact">

                <label>Username:</label>
                <input type="text" name="username">

                <label>Password:</label>
                <input type="password" name="password">

                <input type="submit" name="add" value="Add">
            </form>
        
            <a href="../admin/admin_employee.php" class="back">Go Back</a>
        </div>

    </div>

    <?php if ($success): ?>
        <script>
            alert("Employee registered successfully!");
            window.location.href = "/sample/admin/admin_employee.php";
        </script>
    <?php endif; ?>
    
</body>

</html>

<?php
    if (isset($_POST["logout"])) {
        session_destroy();

        header("Location: /sample/login.php");
    }

    mysqli_close($conn);
?>
