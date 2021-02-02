<?php

    include "assets/PHP/connectDatabase.php";

    session_start();

    if(isset($_SESSION["userid"]) && $_SESSION["userid"] === true)
    {
        header("Location: main.php");
    }

    if(isset($_POST["submit"]))
    {
        $username = $_POST["email"];
        $password = $_POST["pass"];
        $email = $_POST["email"];
        $availiable = true;
        $emailAvailiable = true;

        if(!strpos($email, "@"))
        {
            $emailAvailiable = false;
        }

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

        if($availiable and $emailAvailiable)
        {
            $sqli = $connect->query($insertData);
            header("Location: index.php");
        }
        else if(!$availiable)
        {
            echo "username unavialiable";
        }
        else if(!$emailAvailiable)
        {
            echo "invalid email";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="" method="post" name="signinForm" id="signinForm">
					<span class="login100-form-title">
						Member Signup
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input type="submit" name="submit" class="login100-form-btn" value="Sign-up">
							<!-- Login -->
						<!-- </button> -->
					</div>

					<!-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> -->

					<!-- <div class="text-center p-t-136">
						<a class="txt2" href="signupPage.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div> -->
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>