<?php session_start();

require "includes/database.php";

if (empty($_SESSION['userID'])) {
    print "You MUST be logged in to view this page.";
    print "Redirecting you in 5 seconds...";
    header('Refresh: 5;  index.php');
    exit;
}

$user = $_SESSION['userID'];
$rowstart = 0;
$last = $rowstart;
$query = "SELECT * FROM jobs JOIN applied ON jobs.req_number=applied.job where applied.user = $user;";
$results = mysql_query($query);
$num_results = mysql_num_rows($results);?>

<html>
    <head>
        <title>Job Seek :: My Jobs</title>
        <link rel="stylesheet" href="includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <div>You have applied for: <?php print "$num_results" ?> job(s)</div><br/>
        <table>
        <tr class="boxtitle"><th>Title:</th><th>Requisition Number:</th><th>Area of Interest:</th><th>Location:</th></tr>
        <?php while ($row = mysql_fetch_array($results)) {
                extract($row);?>
                <tr><td><a href=viewjob.php?id=<?php print($req_number);?>><?php print($job_title); ?></a></td><td><?php print($req_number); ?></td><td><?php print($interest); ?></td><td><?php print($city); ?></td></tr>
<?php       } ?>
        </table>
        <br />
    </body>
</html>