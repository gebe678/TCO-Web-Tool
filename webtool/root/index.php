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
    
        $usernameQuery = "SELECT username FROM users";
        $passwordQuery = "SELECT userPassword FROM users";
    
        $usernameSearch = $connect->query($usernameQuery);
        $passwordSearch = $connect->query($passwordQuery);
    
        $i = 0;
    
        while($usernameResult = $usernameSearch->fetch_assoc())
        {
            $usernameDB[$i] = $usernameResult["username"];
            $i++;
        }
    
        $i = 0;
    
        while($passwordResult = $passwordSearch->fetch_assoc())
        {
            $passwordDB[$i] = $passwordResult["userPassword"];
            $i++;
        }
        
        $i = 0;
        while($i < sizeof($usernameDB))
        {
            if($username === $usernameDB[$i] && $password === $passwordDB[$i])
            {
                
                $_SESSION["userid"] = true;
                $_SESSION["user"] = $username;
                $_SESSION["testing"] = 100;
                header("Location: main.php");
            }
            $i++;
        }
    
        if($i == sizeof($usernameDB))
        {
            echo "Incorrect Username or Password";
        }
    }
?>

<!DOCTYPE <html>

<html>

    <head>
        <title>Landing Page</title>
        <meta charset="utf8">
        <link rel="stylesheet" href="assets/css/loginStyles.css">
    </head>

    <body>
        <div class="signinBox">
            <div class="formContainer">
                <form action="" method="post" name="signinForm" id="signinForm">
                    <div class="userName">
                        <div class="labelBox">
                            <label for="username">User Name</label>
                        </div>
                        <input type="text" name="username" id="username">
                    </div>

                    <div class="password">
                        <div class="labelBox">
                            <label for="password">Password</label>
                        </div>
                        <input type="password" name="password" id="password">
                    </div>

                    <input type="submit" name="submit">
                </form>

                <a href="signupPage.php">Click to sign up</a>
            </div>
        </div>
    </body>

</html>