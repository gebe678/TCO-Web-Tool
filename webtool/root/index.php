<!DOCTYPE <html>

<html>

    <head>
        <title>Landing Page</title>
        <meta charset="utf8">
        <link rel="stylesheet" href="assets/css/loginStyles.css">
    </head>

    <body>
    <p>this is a test</p>
        <div class="signinBox">
            <div class="formContainer">
                <form action="assets/PHP/signinCheck.php" method="post" name="signinForm" id="signinForm">
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

                    <input type="submit">
                </form>

                <a href="signupPage.php">Click to sign up</a>
            </div>
        </div>
    </body>

</html>