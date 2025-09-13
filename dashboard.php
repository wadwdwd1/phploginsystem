<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<iframe src="welcome.php" width="100%" height="100%" style="border:none; position:fixed; top:0; left:0; width:100%; height:100%;"></iframe>
