<?php session_start();

require "includes/database.php";

$query       = "select * from jobs;";
$results     = mysql_query($query);
$num_results = mysql_num_rows($results);
$rowstart    = 0;
?>


<html>
    <head>
        <title>Job Seek :: Show All</title>
        <link rel="stylesheet" href="includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php require "includes/js_header.php";?>
        <?php require "includes/message_bar.php";?>
        <?php require "includes/menubar.php";?>
        <div>Your search returned: <?php print "$num_results" ?> job(s)</div><br/>
            <table>
            <tr class="boxtitle"><th>Title:</th><th>Requisition Number:</th><th>Area of Interest:</th><th>Location:</th></tr>
            <?php 
            $count = $rowstart;
            while ($row = mysql_fetch_array($results)) {
                extract($row);?>
                <tr><td><a href=viewjob.php?id=<?php print($req_number);?>><?php print($job_title); ?></a></td><td><?php print($req_number); ?></td><td><?php print($interest); ?></td><td><?php print($city); ?></td></tr>
        
            <?php $count++;
            } ?>
        </table>
        <br />
        <?php require "includes/js_footer.php"; ?>
    </body>
</html>