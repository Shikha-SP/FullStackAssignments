<?php
session_start();
require "db.php";

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST["student_id"];
    $password  = $_POST["password"];


    $sql = "SELECT * FROM students WHERE student_id = :student_id";
    $statement = $pdo->prepare($sql);
    $statement->execute([':student_id' => $studentId]);
    $studentRow = $statement->fetch();

    if ($studentRow) {
 
        $storedHash = $studentRow["password_hash"];


        if (password_verify($password, $storedHash)) {

            $_SESSION["logged_in"]    = true;
            $_SESSION["student_id"]   = $studentRow["student_id"];
            $_SESSION["student_name"] = $studentRow["full_name"];


            header("Location: dashboard.php");
            exit;
        } else {
            $errorMessage = "Incorrect password.";
        }
    } else {
        $errorMessage = "Student not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>

<p style="color:red;"><?php echo $errorMessage; ?></p>

<form method="post" action="">
    <label>Student ID:</label><br>
    <input type="text" name="student_id" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<a href="register.php">Register</a>
</body>
</html>
