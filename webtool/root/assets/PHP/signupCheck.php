<!DOCTYPE hmtl>
<html>
    <body>

        <?php 
            include "connectDatabase.php";

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
        ?>

        <a href="../../index.php">Login Page</a>

    </body>

</html>