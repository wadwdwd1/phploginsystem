<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username && $password) {
        $users = file('users.txt', FILE_IGNORE_NEW_LINES);

        foreach ($users as $user) {
            list($u, $p) = explode(':', $user);
            if ($u === $username) {
                die("Username already exists. <a href='register.php'>Try again</a>");
            }
        }

        file_put_contents('users.txt', "$username:$password\n", FILE_APPEND);
        echo "Registered successfully. <a href='login.php'>Login</a>";
        exit;
    } else {
        echo "Please fill all fields.";
    }
}
?>

<h2>Register</h2>
<form method="post">
    Username: <input name="username"><br>
    Password: <input name="password" type="password"><br>
    <input type="submit" value="Register">
</form>
