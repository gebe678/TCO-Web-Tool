<?php

    include "assets/PHP/connectDatabase.php";

    session_start();

    if(isset($_SESSION["userid"]) && $_SESSION["userid"] === true)
    {
        header("Location: main.php");
    }


    if(isset($_POST["submit"]))
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $availiable = true;

        $usernameCheck = "SELECT username FROM users";
        $insertData = "INSERT INTO users(username, userPassword, email) VALUES('$username', '$password', '$email')";
        $result = $connect->query($usernameCheck);
        $i = 0;
        $usernames;

        while($searchResults = $result->fetch_assoc())
        {
            $usernames[$i] = $searchResults["username"];
            $i++;
        }

        $i = 0;
        while($i < sizeof($usernames) && $availiable)
        {
            if($usernames[$i] === $username)
            {
                $availiable = false; 
            }
            $i++;
        }

        if($availiable)
        {
            $sqli = $connect->query($insertData);
        }
        else
        {
            echo "username unavialiable";
        }
    }
?>

<!DOCTYPE <html>

<html>

    <head>
        <title>Singup-Page</title>
        <meta charset="utf8">
        <link rel="stylesheet" href="assets/css/loginStyles.css">
    </head>

    <body>
        <div class="signinBox">
            <form action="" method="post" name="signinForm" id="signinForm">
                <div class="userNameBox">
                    <div class="labelBox">
                        <label for="username">Enter User Name</label>
                    </div>
                    <input type="text" name="username" id="username">
                </div>

                <div class="passwordBox">
                    <div class="labelBox">
                        <label for="password">Enter Password</label>
                    </div>
                    <input type="password" name="password" id="password">
                </div>

                <div class="emailBox">
                    <div class="labelBox">
                        <label for="email">Enter Email</label>
                    </div>
                    <input type="text" name="email" id="email">
                </div>

                <input type="submit">
            </form>
        </div>
    </body>

</html>