<?php
require 'db.php';
require 'session.php';

// Logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

$userEmail = null;

if (isset($_SESSION['user_id'])) {

    $stmt = $conn->prepare(
        "SELECT email FROM users WHERE id = ?"
    );
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $userEmail = $user['email'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<?php if ($userEmail): ?>

    <h2>Welcome</h2>
    <p>Email: <?php echo htmlspecialchars($userEmail); ?></p>

    <form method="post">
        <button type="submit" name="logout">Logout</button>
    </form>

<?php else: ?>

    <h2>You are not logged in</h2>
    <a href="login.php">
        <button>Login</button>
    </a>

<?php endif; ?>

</body>
</html>
