<?php
    include("../database.php");
    session_start();
    
    if (!isset($_SESSION['username'])) {
        header("Location: /sample/login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS || Admin Dashboard</title>
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
                </li>

                <!-- <li>
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
            <h1 class="dashboard-title">Admin Dashboard</h1>

            <?php
                $sql = "SELECT COUNT(*) AS total FROM employee";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result);
                $total_employees = $row['total'];
            ?>

            <div class="dashboard-wrapper">
                <div class="dashboard-card">
                    <h2 class="dashboard-label">Total Employees</h2>
                    <p class="dashboard-count"><?php echo $total_employees; ?></p>
                </div>
            </div>
        </div>

    </div>

</body>

</html>

<?php
    if (isset($_POST["logout"])) {
        session_destroy();

        header("Location: /sample/login.php");
    }
?>