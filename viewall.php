<?php session_start();

include "mysql_logon.php";

$rowstart = 0;
$last = $rowstart;

$query = "select * from jobs;";

$results = mysql_query($query);
$totalJobs = mysql_query($query);
    
$query_num = mysql_num_rows($results);

$num_results = mysql_num_rows($totalJobs);?>


<html>
    <head>
        <title>Job Seek :: View Job</title>
        <link rel="stylesheet" href="jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <div>Your search returned: <?php print "$num_results" ?> job(s)</div><br/>
        <div>Displaying results <?php print($rowstart + 1); ?> through <?php print($rowstart + 5); ?> </div><br/>
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
        <?php
        /* if($rowstart > 1)
            echo '<a href="'.$_SERVER['PHP_SELF'].
                           '?cmd=viewall' .
                           '&rowstart='.($rowstart-5).'">&lt;-Previous Page</a> &nbsp; ';
         if($last < ($num_results - $rowstart))
            echo '<a href="'. $_SERVER['PHP_SELF'].
                           '?cmd=viewall' .
                           '&rowstart='.($last+5).'">Next Page-&gt;</a><br><br>'; */
        ?>
    </body>
</html>