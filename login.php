<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $users = file('users.txt', FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($u, $p) = explode(':', $user);
        if ($u === $username && $p === $password) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        }
    }

    echo "Invalid credentials. <a href='login.php'>Try again</a>";
}
?>

<h2>Login</h2>
<form method="post">
    Username: <input name="username"><br>
    Password: <input name="password" type="password"><br>
    <input type="submit" value="Login">
</form>
