<?php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
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
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .students-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .student-card {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid darkolivegreen;
        }
        
        .student-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .student-email {
            color: #666;
            margin-bottom: 10px;
            word-break: break-all;
        }
        
        .student-skills {
            margin-top: 15px;
        }
        
        .skill-tag {
            display: inline-block;
            background-color: #e0f7fa;
            color: #006064;
            padding: 4px 10px;
            border-radius: 15px;
            margin: 3px;
            font-size: 14px;
        }
        
        .no-students {
            text-align: center;
            padding: 40px;
            font-size: 18px;
            color: #666;
            background-color: #f5f5f5;
            border-radius: 10px;
            margin-top: 20px;
        }
        
        .page-title {
            text-align: center;
            margin: 20px 0 30px 0;
            color: #333;
            font-size: 28px;
        }
        
        .stats {
            background-color: #e8f5e9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
        <ul>
        <li><a href="index.php"> Home Page</a></li>
    </ul>
    <div class="content-wrapper">
        <h1 class="page-title">Student Records</h1>
        
        <?php
        if (file_exists("students.txt")) {
            $lines = file("students.txt");
            $studentCount = count($lines);
            
            echo "<div class='stats'>Total Students: $studentCount</div>";
            
            if ($studentCount > 0) {
                echo "<div class='students-container'>";
                
                foreach ($lines as $line) {
                    list($name, $email, $skills) = explode("|", trim($line));
                    $skillsArray = explode(",", $skills);
                    
                    echo "<div class='student-card'>";
                    echo "<div class='student-name'>$name</div>";
                    echo "<div class='student-email'>📧 $email</div>";
                    
                    if (!empty($skills) && $skills !== '') {
                        echo "<div class='student-skills'>";
                        foreach ($skillsArray as $skill) {
                            if (trim($skill) !== '') {
                                echo "<span class='skill-tag'>" . htmlspecialchars(trim($skill)) . "</span>";
                            }
                        }
                        echo "</div>";
                    }
                    
                    echo "</div>";
                }
                
                echo "</div>";
            } else {
                echo "<div class='no-students'>No students found in the database</div>";
            }
        } else {
            echo "<div class='no-students'>No students found. Student records file does not exist.</div>";
        }
        ?>
    </div>
</body>
</html>

<?php require 'footer.php'; ?>