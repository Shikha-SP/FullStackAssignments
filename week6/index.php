<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            padding:0px;
            margin:0px;
            height:100vh;
            display:flex;
            flex-direction: column;
            justify-content: space-between;
            
        }
        #body{
            height:80vh;
            padding:0px;
            margin:0px;
            display:flex;
            flex-direction:column;
            justify-content: space-between;
            align-items: center;
        }

        li{
            
            
            width:400px;
            height:auto;
            display: flex;
            justify-content: center;
            align-items: center;
            
        }
        ul{
            display:flex;
            flex-direction:row;
            justify-content: space-around;
            background-color:#FDEB9E;
            margin:0px;
            padding:0px;
            height:100px;
            width:100vw;
        }
        p{
            font-size:20px;
            font-weight:bold;
            margin-bottom: 20%;
            
        }
    </style>
</head>
<body>
    <?php require 'header.php'; ?>



<div id="body">
<ul>
    
    <li><a href="add_student.php">Add Student Info</a></li>
    <li><a href="upload.php">Upload Portfolio File</a></li>
    <li><a href="students.php">View Students</a></li>
</ul>
<p>Welcome to the Student Portfolio Manager. You can manage your student data using this website.</p>
</div>

<?php require 'footer.php'; ?>
</body>
</html>

