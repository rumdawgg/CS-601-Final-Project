<?php session_start();

require "../includes/database.php";

if (empty($_SESSION['userID'])) {
    print "You MUST be logged in before you can delete a job!";
    print "Redirecting you in 5 seconds...";
    header('Refresh: 5;  index.php');
    exit;
}
if (empty($_GET['id'])) {
    print "You did not access this page in a valid way.";
    exit;
}

$user = $_SESSION['userID'];
$job  = $_GET['id'];

$query = "DELETE FROM jobs WHERE req_number = $job AND posted_by = $user;";
print $query;

print "Redirecting you in 5 seconds...";
header('Refresh: 5;  myjobs.php');

?>