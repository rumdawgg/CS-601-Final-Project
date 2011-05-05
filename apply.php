<?php session_start();

require "includes/database.php";

if (empty($_SESSION['userID'])) {
    //print "You MUST be logged in before you can apply for a job!!";
    //print "Redirecting you in 5 seconds...";
    $status['error'] = "You MUST be logged in before you can apply for a job!!";
}
if (empty($_POST['jobID'])) {
    //print "You did not access this page in a valid way.";
    $status['error'] = "You did not access this page in a valid way.";
} else {

    $user = $_SESSION['userID'];
    $job  = $_POST['jobID'];
    
    $query = "select * from applied where job = $job AND user = $user;";
    //print $query;
    $results = mysql_query($query);
    
    $num_results = mysql_num_rows($results);
    
    if ($num_results == 0) {
        $row = mysql_fetch_array($results);
        $query = "insert into applied (job, user) values ($job, $user);";
        //print $query;
        $results = mysql_query($query)
        or die("Query error: " . mysql_error());
        $status['message'] = "Successfully applied for that job!";
    }
}
?>

<html>
    <head>
        <title>Job Seek :: Applied</title>
        <link rel="stylesheet" href="includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php require "includes/message_bar.php";
         if ($status['error']) { 
            header('Refresh: 5;  index.php');
        } else {
            header('Refresh: 5;  myjobs.php');
        } ?>
    </body>
</html>