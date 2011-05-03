<?php session_start();

require "includes/database.php";

if (empty($_SESSION['userID'])) {
	print "You MUST be logged in before you can apply for a job!!";
	print "Redirecting you in 5 seconds...";
	header('Refresh: 5;  index.php');
	exit;
}
if (empty($_POST['jobID'])) {
	print "You did not access this page in a valid way.";
	exit;
}

$user = $_SESSION['userID'];
$job  = $_POST['jobID'];

$query = "select * from applied where job = $job AND user = $user;";
print $query;
$results = mysql_query($query);

$num_results = mysql_num_rows($results);

if ($num_results == 0) {

	$row = mysql_fetch_array($results);
	$query = "insert into applied (job, user) values ($job, $user);";
	print $query;
	$results = mysql_query($query)
	or die("Query error: " . mysql_error());
}
?>