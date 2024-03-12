
<?php
//include auth_session.php file on all user panel pages
include("../includes/auth_session.php");
require("../includes/db.php");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Expense</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/style.css">

</head>
<body>
    <div class="container">
        <div class="sidepanel">
            <div class="logo">Expensys</div>
            <p>Hello,<br><?php $user=$_SESSION['username'];echo  trim($user,'\'');?></p>
            <hr>
            <nav class="nav">
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profile.php" >Profile</a></li>
                    <li><a href="expense.php" >Expenses</a></li>
                    <li><a href="report.php">Report</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <div class="mainpanel">
       

<?php
if(isset($_POST['submit'])){

    $query="SELECT `balance` FROM `track_expense` WHERE username=$user ORDER BY id DESC LIMIT 1;";
    $result=mysqli_query($conn, $query) or die(mysql_error());
    $q=mysqli_fetch_assoc($result);
    $balance=$q['balance'];
    
    $amount=$_POST['amount'];
    
    $date=$_POST['date'];
    $date=mysqli_real_escape_string($conn,$date);
    $date="'".$date."'";
    
    $description=stripslashes($_POST['description']);
    $description=mysqli_real_escape_string($conn,$description);
    $description="'".$description."'";


        $temp=$balance-$amount;

        if($temp <= 0){
            echo "<script>alert('Insuficient Balance'); window.location.href='expense.php'</script>";
        }
        else{

        $balance=$balance - $amount;
        $query="INSERT INTO `track_expense` (username,credit,debit,description ,ddate,balance) VALUES($user,0,$amount,$description,$date,$balance)";
        $result=mysqli_query($conn,$query);
        
        if($result){
            echo "<div class='form'>
            <h3> Successful.</h3>
            Click here to <a href='expense.php'>Record</a> again.
            </div>
            <script src='https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js'></script>
            <center><lottie-player src='withdraw.json'  background='transparent'  speed='1'  style='width: 300px; margin-top:-4rem;' autoplay></lottie-player><center>";
        } else {
            echo "<div class='form'>
            <h3>Required fields are missing.</h3>
            </div>";
        }
        
}
$conn->close();

}
else{

    ?>

            <?php

            $query = "SELECT `balance` FROM `track_expense` WHERE username=$user ORDER BY id DESC LIMIT 1;";

            $result = mysqli_query($conn, $query) or die(mysql_error());
            $r = mysqli_fetch_assoc($result);

            ?>
   
            
<form action="<?php echo $_SERVER['PHP_SELF']?>" id="form" method="post">

<h3>Record an expense</h3>
    <span>Balance : <?php echo $r['balance']; ?></span><br><br>
    Amount:<input type="number" name="amount" min="1" oninput="validity.valid||(value='');" required><br>
    Date:<input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" required><br>
    Description:<textarea name="description" id="" cols="30" rows="3"></textarea><br>
    <input  class="submit" type="submit" name="submit"><br>
</form>



<?php
}
?>

</div>
</div>
</body>
</html>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>


