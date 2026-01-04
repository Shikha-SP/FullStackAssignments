<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $studentId = $_POST["student_id"];
    $fullName  = $_POST["full_name"];
    $password  = $_POST["password"];


    $passwordHash = password_hash($password, PASSWORD_BCRYPT);


    $sql = "INSERT INTO students (student_id, full_name, password_hash)
            VALUES (:student_id, :full_name, :password_hash)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':student_id'    => $studentId,
        ':full_name'     => $fullName,
        ':password_hash' => $passwordHash
    ]);


    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>Register</h2>

<form method="post" action="">
    <label>Student ID:</label><br>
    <input type="text" name="student_id" required><br><br>

    <label>Full Name:</label><br>
    <input type="text" name="full_name" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>
</form>

<a href="login.php">Go to Login</a>
</body>
</html>
