<?php
require 'header.php';

function uploadPortfolioFile($file) {
    $allowed = ['pdf', 'jpg', 'png'];
    $maxSize = 2 * 1024 * 1024;

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        throw new Exception("Invalid file type");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File too large");
    }

    if (!is_dir("uploads")) {
        throw new Exception("Upload directory missing");
    }

    $newName = time() . "_" . basename($file['name']);
    move_uploaded_file($file['tmp_name'], "uploads/" . $newName);
}

// Store messages in variables instead of echoing immediately
$successMessage = '';
$errorMessage = '';

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        uploadPortfolioFile($_FILES['portfolio']);
        $successMessage = "File uploaded successfully";
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
    <title>Upload Portfolio</title>
    <style>
        body {
            min-height: 100vh;
            width: 100vw;
            padding: 0px;
            margin: 0px;
            display: flex;
            flex-direction: column;
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
        
        .content-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        
        form {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }
        
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border: 2px dashed #ddd;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer;
        }
        
        form button {
            background-color: darkolivegreen;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        .message {
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            width: 400px;
            font-weight: bold;
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
        #title{
            width:100%;
            margin:0px;
            background-color: #e0f7fa;
            color:darkolivegreen;
        }
    </style>
</head>
<body>
    <ul>
        <li><a href="index.php"> Home Page</a></li>
    </ul>
    <div class="content-wrapper">
        <?php if ($successMessage): ?>
            <div class="message success"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        
        <?php if ($errorMessage): ?>
            <div class="message error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        
        <form method="post" enctype="multipart/form-data">
            <h2 id="title">Upload Portfolio</h2>
            <p>Allowed formats: PDF, JPG, PNG (Max: 2MB)</p>
            <input type="file" name="portfolio" required><br><br>
            <button type="submit">Upload File</button>
        </form>
    </div>
</body>
</html>

<?php require 'footer.php'; ?>