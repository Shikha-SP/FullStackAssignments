<?php
require 'header.php';

function formatName($name) {
    return ucwords(trim($name));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    return array_map('trim', explode(',', $string));
}

function saveStudent($name, $email, $skillsArray) {
    $data = $name . "|" . $email . "|" . implode(',', $skillsArray) . PHP_EOL;
    file_put_contents("students.txt", $data, FILE_APPEND);
}

// Store messages in variables instead of echoing immediately
$successMessage = '';
$errorMessage = '';

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $name = formatName($_POST["name"]);
        $email = $_POST["email"];
        $skills = cleanSkills($_POST["skills"]);

        if (!$name || !validateEmail($email)) {
            throw new Exception("Invalid name or email");
        }

        saveStudent($name, $email, $skills);
        $successMessage = "Student saved successfully";
    }
} catch (Exception $e) {
    $errorMessage = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            height:100vh;
            width:100vw;
            padding:0px;
            margin:0px;
            display:flex;
            flex-direction:column;
            justify-content:flex-start;
            align-items: center;
        }
        ul{
            display:flex;
            flex-direction:row;
            justify-content: center;
            align-items: center;
            background-color:#FDEB9E;
            margin:0px;
            padding:0px;
            height:100px;
            width:100vw;
        }

        li{
            width:400px;
            height:auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            width: 100%;
            flex-direction: column; /* Added to stack messages above form */
        }
        
        /* Style for messages */
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }
        
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 400px;
        }
        
        form input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        form button {
            background-color: darkolivegreen;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <ul>
        <li><a href="index.php"> Home Page</a></li>
    </ul>
    
    <div class="form-container">
        <?php if ($successMessage): ?>
            <div class="message success"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        
        <?php if ($errorMessage): ?>
            <div class="message error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        
        <form method="post">
            Name: <input type="text" name="name"><br><br>
            Email: <input type="text" name="email"><br><br>
            Skills (comma separated): <input type="text" name="skills"><br><br>
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>

<?php require 'footer.php'; ?>