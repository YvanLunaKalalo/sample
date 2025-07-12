<div class="side-bar">
    <div class="user-p">
        <img src="/sample/img/user.jpg">
        <!-- <h4>Elias</h4> -->
        <?php
        echo "<h4>{$_SESSION['username']}</h4> <br><br>";

        if (!isset($_SESSION['username'])) {
            header("Location: /sample/admin_login.php");
        }
        ?>
    </div>
    <ul>
        <li>
            <a href="/admin/admin_dashboard.php">
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
        </li>
        <li>
            <a href="#">
                <i class="fa fa-cog" aria-hidden="true"></i>
                <span>Setting</span>
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