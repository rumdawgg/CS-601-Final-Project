<?php session_start();

include("mysql_logon.php");

if (empty($_SESSION['userID'])) {
	print "You MUST be logged in to view this page.";
	print "Redirecting you in 5 seconds...";
	header('Refresh: 5;  index.php');
	exit;
}

$user = $_SESSION['userID'];

/*
if(isset($_REQUEST['rowstart']) && $_REQUEST['rowstart'] != 0){
	$rowstart = $_REQUEST['rowstart'];
}else{
	$rowstart = 0;
}
*/

$rowstart = 0;
$last = $rowstart;

$query = "SELECT * FROM jobs JOIN applied ON jobs.req_number=applied.job where applied.user = $user;";

#echo $query;

$results = mysql_query($query);
$totalJobs = mysql_query($query);
	
$query_num = mysql_num_rows($results);

$num_results = mysql_num_rows($totalJobs);?>


<html>
	<head>
		<title>Job Seek :: My Jobs</title>
		<link rel="stylesheet" href="jobseek_styles.css" type="text/css" />
	</head>
	<body>
		<div>You have applied for: <?php print "$num_results" ?> job(s)</div><br/>
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