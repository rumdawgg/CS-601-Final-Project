<?php session_start();

require "includes/database.php";

if ($_GET) {

    $id = $_GET["id"];
    
    $id = mysql_real_escape_string($id);
    
    $query = "select * from jobs where req_number = '$id';";
    $results = mysql_query($query)
    or die("Query error: " . mysql_error());
    
    $row = mysql_fetch_array($results);
    
    if(mysql_num_rows($results))
    {
        extract($row);
    }

} ?>

<html>
    <head>
        <title>Job Seek :: View Job</title>
        <link rel="stylesheet" href="includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php require "includes/js_header.php";?>
        <?php require "includes/message_bar.php";?>
        <?php require "includes/menubar.php";?>
        <div><form method="POST" action="apply.php" name="apply">
            <?php if (mysql_num_rows($results)) { ?>
            <div>Job Title: <?php print($job_title); ?></div>
            <div>Requisition Number: <?php print($req_number); ?></div>
            <div>Job Description: <?php print($description); ?></div>
            <div>Salary: <?php print($salary); ?></div>
            <input type="hidden" name="jobID" value="<?php echo $id; ?>">
            <div><input type="submit" value="Apply"></div>
        </form></div>
        <?php } else { ?>
        <div>Can't find a job with that ID!</div>
        <?php } 
        require "includes/js_footer.php";?>  
    </body>
</html>