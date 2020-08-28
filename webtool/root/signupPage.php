<!DOCTYPE <html>

<html>

    <head>
        <title>Singup-Page</title>
        <meta charset="utf8">
        <link rel="stylesheet" href="assets/css/loginStyles.css">
    </head>

    <body>
        <div class="signinBox">
            <form action="assets/PHP/signupCheck.php" method="post" name="signinForm" id="signinForm">
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