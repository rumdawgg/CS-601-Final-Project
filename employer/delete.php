<?php session_start();

require "../includes/database.php";

if (empty($_SESSION['userID'])) {
    //print "You MUST be logged in before you can apply for a job!!";
    //print "Redirecting you in 5 seconds...";
    $status['error'] = "You MUST be logged in before you can apply for a job!!";
}
if (empty($_GET['id'])) {
    print "You did not access this page in a valid way.";
    exit;
}

$user = $_SESSION['userID'];
$job  = $_GET['id'];

$query = "DELETE FROM jobs WHERE req_number = $job AND posted_by = $user;";
$results = mysql_query($query)
or die("Query error: " . mysql_error());
$status['message'] = "Successfully deleted that job";

?>

<html>
    <head>
        <title>Job Seek :: Delete Job</title>
        <link rel="stylesheet" href="../includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php require "../includes/message_bar.php";
         if ($status['error']) { 
            header('Refresh: 5;  myjobs.php');
        } else {
            header('Refresh: 5;  myjobs.php');
        } ?>
    </body>
</html>