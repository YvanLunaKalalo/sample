<?php
    include("../../database.php");
    session_start();

    include("../snippets/header.php");
?>

<div class="body">
    <?php include("../snippets/sidebar.php"); ?>

    <div class="section-1">
        <h1>WELCOME</h1>
        <p>Coding with <?php echo $_SESSION['username']; ?></p>
    </div>
</div>

<?php include("../snippets/footer.php"); ?>

<?php
    if (isset($_POST["logout"])) {
        session_destroy();
        header("Location: /sample/login.php");
        exit();
    }
?>
