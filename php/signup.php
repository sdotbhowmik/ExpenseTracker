<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>

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
        <h1>Sign Up</h1>
        <p>Already have an account? <a href="login_page.php#form">Login</a></p>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                Name <br><input type="text" name="name" maxlength=30 required><br><br>
                Username <br><input type="text" name="username" maxlength=20 required><br><br>
                Email <br><input type="email" name="email" maxlength="40" required><br><br>
                Password <br><input type="password" name="pass" id="password" minlength="8" maxlength="20" required>
                <i class="fa fa-eye" onclick="showPassword()"></i><br><br>
            
            <input type="submit" value="Sign Up" id="submit" name="submit">

        </form>
    </div>

</body>
</html>

<?php
error_reporting(0);
header("cache-control:no-cache");
header("pragma:no-cache");

if (isset($_POST['submit'])) {

    $name = "'" . $_POST['name'] . "'";
    $username = "'" . $_POST['username'] . "'";
    $email = "'" . $_POST['email'] . "'";
    $pass = "'" . $_POST['pass'] . "'";

    require('../includes/db.php');

    $today_date = date('Y-m-d');

    $sql = "SELECT * FROM signup_details WHERE username = $username";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        echo '<script>alert("Username is existed"); window.location.href=\'signup.php#form\';</script>';
    }

    $sql = "SELECT * FROM signup_details WHERE email = $email";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        echo '<script>alert("Email is already used."); window.location.href=\'signup.php#form\';</script>';
    }
    else {

        $sql = "INSERT INTO `signup_details` (`name`,`username`, `email`, `password`)
                    VALUES ($name, $username, $email, $pass)";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<script>alert("Signed up successfully, please login."); window.location.href=\'login_page.php#form\'; </script>';
            $d = date('Y-m-d');
            $query = "INSERT INTO `track_expense` (username,credit,debit,description ,ddate,balance) VALUES($username,0,0,'init','$d',0)";
            $result = mysqli_query($conn, $query);

        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
}

?>