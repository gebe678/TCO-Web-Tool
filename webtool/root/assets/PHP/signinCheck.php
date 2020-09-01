<?php
    include "connectDatabase.php";

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
            header("Location: /main.php");
        }
        $i++;
    }

    if($i == sizeof($usernameDB))
    {
        echo "Incorrect Username or Password";
    }
?>