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
                $error = "Username already exists.";
                break;
            }
        }

        if (!isset($error)) {
            file_put_contents('users.txt', "$username:$password\n", FILE_APPEND);
            header("Location: login.php");
            exit;
        }
    } else {
        $error = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            background: #e9ecef;
            font-family: Arial, sans-serif;
        }
        .form-container {
            width: 300px;
            margin: 100px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type=submit] {
            background-color: #007bff;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
        .link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="post">
            <input name="username" type="text" placeholder="Username" required>
            <input name="password" type="password" placeholder="Password" required>
            <input type="submit" value="Register">
        </form>
        <div class="link">
            <a href="login.php">Already have an account? Login</a>
        </div>
    </div>
</body>
</html>
