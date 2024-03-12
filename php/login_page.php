<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/sign_log_style.css">

    <script>
        function showPassword() {
            var pass = document.getElementById("password");
            if (pass.type === "password") {
                pass.type = "text";
            } else {
                pass.type = "password";
            }
        }
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
</head>

<body>

    <div id="expensys">
        <center>Expense Tracker</center>
        <p>Introducing our Expense Tracker website <br>
            Our platform is designed to simplify the way you track your expenses. <br><br>
            "Spend smart, live smart!"
        </p>
        <a href="#form"><button>Get started</button></a>
    </div>

    <div id="form">
        <h1>Sign In</h1>
        <p>Don't have an account? <a href="signup.php#form">Sign up</a></p>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                Username <br><input type="text" name="username" maxlength=20 required><br><br>
                Password <br><input type="password" name="pass" id="password" minlength="8" maxlength="20" required>
                <i class="fa fa-eye" onclick="showPassword()"></i><br><br>
            
            <input type="submit" value="Login" id="submit" name="login">

        </form>
    </div>

</body>

</html>


<?php
error_reporting(0);
require('../includes/db.php');

session_start();

if (isset($_POST["login"])) {

    $username = "'" . $_POST['username'] . "'";
    $pass = "'" . $_POST['pass'] . "'";

    $sql = "SELECT * FROM signup_details WHERE username = $username and password = $pass";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header('location:dashboard.php');
    } 
    else {
        echo "<script>alert('Username & password didn\'t match.'); window.location.href='login_page.php#form';</script>";
    }
}

?>