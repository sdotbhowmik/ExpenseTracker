<?php
//include auth_session.php file on all user panel pages
include("../includes/auth_session.php");
require("../includes/db.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/style.css">

</head>

<body>
    <div class="container">
        <div class="sidepanel">
            <div class="logo">Expensys</div>
            <p>Hello,<br>
                <?php $user = $_SESSION['username'];
                echo trim($user, '\''); ?>
            </p>
            <hr>
            <nav class="nav">
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="expense.php">Expenses</a></li>
                    <li><a href="report.php">Report</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <div class="mainpanel">
            <?php
            $query = "SELECT `balance` FROM `track_expense` WHERE username=$user ORDER BY id DESC LIMIT 1;";

            $result = mysqli_query($conn, $query) or die(mysql_error());
            $r = mysqli_fetch_assoc($result);

            ?>

            <div class="show_bal">
                <hr>
                <span class="bal_amt">
                    <?php echo $r['balance']; ?>
                </span>
                <hr>
                <br>Your Balance <br><br>
                <input type="submit" name="add" value="Add Amount" class="submit"
                    onclick=window.location.href='add_amt.php'>
            </div>
        </div>


    </div>
</body>

</html>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

</script>