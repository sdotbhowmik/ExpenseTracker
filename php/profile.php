<?php
include("../includes/auth_session.php");
require("../includes/db.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container">
        <div class="sidepanel">
            <div class="logo">Expensys </div>
            <p>Hello,<br>
                <?php $user = $_SESSION['username'];
                echo trim($user, '\''); ?>
            </p>

            <hr>
            <nav class="nav">
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="expense.php">Expenses</a></li>
                    <li><a href="report.php">Report</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <div class="mainpanel">

            <form action="" class="form" method="post">
                <?php
                $query = "SELECT * FROM `signup_details` WHERE username=$user";
                $result = mysqli_query($conn, $query) or die(mysql_error());
                $r = mysqli_fetch_array($result);

                ?>
                <h2>PROFILE</h2>
                Name:<input class="profile_details" type="text" name="name" disabled
                    value="<?php echo $r[0] ?>"><br>
                Username:<input class="profile_details" type="text" name="username" disabled
                    value="<?php echo $r[1] ?>"><br>
                Email:<input class="profile_details" type="email" name="email" disabled
                    value="<?php echo $r[2] ?>">
            </form>
        </div>
    </div>
</body>

</html>