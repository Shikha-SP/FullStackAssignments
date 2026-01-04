<?php
session_start();

if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedTheme = $_POST["theme"];


    setcookie("theme", $selectedTheme, time() + 86400 * 30, "/");


    header("Location: dashboard.php");
    exit;
}


$currentTheme = isset($_COOKIE["theme"]) ? $_COOKIE["theme"] : "light";


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
    <title>Preference</title>
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
<h2>Choose Theme</h2>

<form method="post" action="">
    <label>
        <input type="radio" name="theme" value="light"
            <?php if ($currentTheme === "light") echo "checked"; ?>>
        Light mode
    </label><br>

    <label>
        <input type="radio" name="theme" value="dark"
            <?php if ($currentTheme === "dark") echo "checked"; ?>>
        Dark mode
    </label><br><br>

    <button type="submit">Save</button>
</form>

<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
