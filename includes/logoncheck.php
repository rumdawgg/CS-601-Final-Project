<?php if (empty($_SESSION['userID'])) {
    //there is probably a better way to do this...
    print "You MUST be logged in to view this page.";
    print "Redirecting you in 5 seconds...";
    header('Refresh: 5;  index.php');
    exit;
} ?>