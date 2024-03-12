<?php
//include auth_session.php file on all user panel pages
include("../includes/auth_session.php");
require("../includes/db.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <title>Report</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/report_style.css">
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
            if (isset($_POST['submit'])) {
                $date1 = $_POST['date1'];
                $date1 = mysqli_real_escape_string($conn, $date1);
                $date2 = $_POST['date2'];
                $date2 = mysqli_real_escape_string($conn, $date2);
                $query = "SELECT * FROM `track_expense` WHERE username=$user and (credit>0 or debit>0) and ddate BETWEEN '$date1' AND '$date2'";
                $result = mysqli_query($conn, $query) or die(mysql_error());

                if ($result) {
                    echo "<a class=close_cross href='report.php'>&#9932;</a>";
                    echo "<button class=print-report id=my-pdf>Print report</button>";
                    echo "<table id=my-table><tr><th colspan=6>Transactions<br></th></tr><tr><th style='text-align:left' colspan=6>Name : " . trim($user, "'") . "</th></tr><tr><th>Sr.No</th><th>Credited</th><th>Debited</th><th>Date</th><th>Description</th><th>Balance</th></tr>";
                    $s = 1;
                    while ($r = mysqli_fetch_array($result)) {
                        echo "<tr><td>$s</td><td style='color:#007700; font-weight:600' >" . $r['credit'] . "</td><td style='color:#990000; font-weight:600' >" . $r['debit'] . "</td><td>" . $r['ddate'] . "</td><td>" . $r['description'] . "</td><td style='color:#001166; font-weight:600' >" . $r['balance'] . "</td></tr>";
                        $s = $s + 1;
                    }
                    echo "</table>";
                } else {
                    echo "<div class='form'>
        <h3>Required fields are missing.</h3><br/>
        </div>";
                }
            } else {
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form" method="post">

                    <h2>Report</h2>
                    From Date :</label> <input type="date" name="date1"><br>
                    To Date:</label> <input type="date" name="date2"><br><br>
                    <input type="submit" value="Submit" class="submit" name="submit"></p>
                </form>
                <?php
            }
            ?>
        </div>
    </div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $("body").on("click", "#my-pdf", function () {
                html2canvas($('#my-table')[0], {
                    onrendered: function (canvas) {
                        var data = canvas.toDataURL();
                        var docDefinition = {
                            content: [{
                                image: data,
                                width: 500
                            }]
                        };
                        pdfMake.createPdf(docDefinition).download("expense-report.pdf");
                    }
                });
            });
        });
    </script>

</body>

</html>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }


</script>