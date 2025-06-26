<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = mysqli_real_escape_string($con, $_POST['fname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lname']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $num = mysqli_real_escape_string($con, $_POST['number']);
    $address = mysqli_real_escape_string($con, $_POST['add']);
    $email = mysqli_real_escape_string($con, $_POST['mail']);
    $password = $_POST['pass']; // Get plain password

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $query = "INSERT INTO form (fname, lname, gender, cnum, address, email, pass) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $gender, $num, $address, $email, $hashed_password);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Signup successful!";
            header("Location: login.php");
            die;
        } else {
            echo "Error: " . mysqli_error($con);
        }

        // Close the statement
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
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container signup">
        <h2>Sign Up</h2>
        <form method="post">
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" required>
            </div>
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="number">Contact Number:</label>
                <input type="text" id="number" name="number" required>
            </div>
            <div class="form-group">
                <label for="add">Address:</label>
                <textarea id="add" name="add" required></textarea>
            </div>
            <div class="form-group">
                <label for="mail">Email:</label>
                <input type="email" id="mail" name="mail" required>
            </div>
            <div class="form-group">
                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" required>
            </div>
            <button type="submit" class="btn">Sign Up</button>
            <p>Already have an account? <a href="login.php">Login here</a></p>
</form>
</div>
</body>
</html>