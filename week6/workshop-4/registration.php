<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $errors = [];

    // checking if name is empty
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    // checking if email is empty or invalid
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // checking if password is empty
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // checking if passwords match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // if no validation errors, continue saving data
    if (empty($errors)) {


        // OLD DATA SAVING IN $users SO that we dont overwrite it
        $users = json_decode(file_get_contents("users.json"), true);

        // check if json decode returned null (file empty or invalid)
        if ($users === null) {
            $users = [];
        }

        // not storing plain text password for security reasons and encoding it using password_hash function
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // new user storing
        $newUser = [
            "name" => $name,
            "email" => $email,
            "password" => $hashedPassword
        ];
        $users[] = $newUser;

        // saving back to the users.json file
        file_put_contents("users.json", json_encode($users));

        //we need to do $success=true bc tala html ma check garda we wrote if success is not empty then display success message
        $success = true;
    }

}

?>




<!DOCTYPE html>

<html>


<head>
    <title>Registration form</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #466337ff;
        }

        form {
            padding: 20px;
            border: 1px solid #ccc;
            width: 300px;
            height: 600px;
            display: flex;
            flex-direction: column;
            text-align: center;
            background-color: white;

        }

        button {
            color: white;
            background-color: #466337ff;
            height: 40px;
            border: 1px solid black;
        }

        h3 {
            color: #466337ff;
        }
    </style>
</head>



<body>
    <form method="post">
        <h3>Registration Form</h3><br><br>
        <label>Name: </label>
        <input type="text" name="name"><br><br>
        <label>Email: </label>
        <input type="email" name="email"><br><br>
        <label>Password: </label>
        <input type="password" name="password"><br><br>
        <label>Confirm password: </label>
        <input type="password" name="confirm_password"><br><br>
        <br><br>
        <button type="submit">Register</button><br><br>
        <?php
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='error'>$error</div>";
            }
        }

        if (!empty($success)) {
            echo "<div class='success'>Registration successful</div>";
        }
        ?>
    </form>

</body>

</html>