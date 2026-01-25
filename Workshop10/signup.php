<?php
require 'db.php';
require 'session.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // CSRF check
    if (
        !isset($_POST['csrf_token']) ||
        $_POST['csrf_token'] !== $_SESSION['csrf_token']
    ) {
        die("Invalid request");
    }

    // Validate email
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$email) {
        $errors[] = "Invalid email format";
    }

    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }

    if (empty($errors)) {

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepared statement
        $stmt = $conn->prepare(
            "INSERT INTO users (email, password) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $email, $hashedPassword);
        $stmt->execute();

        header("Location: login.php");
        exit;
    }
}

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>

<h2>Signup</h2>

<?php foreach ($errors as $error): ?>
    <p><?php echo htmlspecialchars($error); ?></p>
<?php endforeach; ?>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Signup</button>
        <a href="login.php">
        <button type="button">Login</button>
</form>

</body>
</html>
