<?php
session_start();


if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}


if (isset($_COOKIE["theme"])) {
    $currentTheme = $_COOKIE["theme"];
} else {
    $currentTheme = "light";
}


if ($currentTheme === "dark") {
    $backgroundColor = "black";
    $textColor = "white";
} else {
    $backgroundColor = "white";
    $textColor = "black";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            background-color: <?php echo $backgroundColor; ?>;
            color: <?php echo $textColor; ?>;
            font-family: Arial, sans-serif;
        }
        a { color: <?php echo $textColor; ?>; }
    </style>
</head>
<body>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION["student_name"]); ?></h2>

<a href="dashboard.php">Dashboard</a> |
<a href="preference.php">Preference</a>

<br><br>


<form method="post" action="logout.php">
    <button type="submit">Logout</button>
</form>
</body>
</html>
