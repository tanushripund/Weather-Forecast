<?php
echo "<br>DEBUG (LOGIN): This login.php is being executed.<br>";
error_log("DEBUG (LOGIN): This login.php is being executed.");
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $gmail = mysqli_real_escape_string($con, $_POST['mail']);
    $password = $_POST['pass'];

    // Prepare the SQL statement to fetch user by email
    $query = "SELECT * FROM form WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $gmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Verify the password
            if (password_verify($password, $row['pass'])) {
                $_SESSION['user_id'] = $row['id'];
                header("Location:/Combine/index.php"); // Redirect to your main page
                die();
            } else {
                echo "Wrong password!";
            }
        } else {
            echo "Wrong email!";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container login">
    <h2>Login</h2>
        <form method="post">
            <div class="form-group">
                <label for="mail">Email:</label>
                <input type="email" id="mail" name="mail" required>
            </div>
            <div class="form-group">
                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
        </form>
</div>
</body>
</html>