<?php session_start();

require "../includes/database.php";
include "../includes/logoncheck.php";

$user = $_SESSION['userID'];
$rowstart = 0;
$last = $rowstart;
$query = "SELECT * FROM jobs WHERE posted_by = $user;";
$results = mysql_query($query);
$num_results = mysql_num_rows($results);?>

<html>
    <head>
        <title>Job Seek :: My Jobs</title>
        <link rel="stylesheet" href="../includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php require "../includes/js_header.php";?>
        <?php require "../includes/message_bar.php";?>
        <?php require "../includes/menubar.php";?>
        <div>You have posted <?php print "$num_results" ?> job(s):</div><br/>
        <table>
        <tr class="boxtitle"><th>Title</th><th>Requisition Number</th><th>Area of Interest</th><th>Location</th><th>Delete</th></tr>
        <?php while ($row = mysql_fetch_array($results)) {
                extract($row);?>
                <tr><td><a href=viewjob.php?id=<?php print($req_number);?>><?php print($job_title); ?></a></td><td><?php print($req_number); ?></td><td><?php print($interest); ?></td><td><?php print($city); ?></td><td><a href="delete.php?id=<?php print($req_number); ?>">Delete</a></td></tr>
<?php       } ?>
        </table>
        <br />
        <?php require "../includes/js_footer.php"; ?>
    </body>
</html>