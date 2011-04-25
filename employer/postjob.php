<?php

require "../includes/database.php";

if ($_POST) {

    $job_title    = $_POST["job_title"];
    $req_number   = $_POST["req_number"];
    $interest     = $_POST["interest"];
    $city         = $_POST["city"];
    $state        = $_POST["state"];
    $type         = $_POST["type"];
    $description  = $_POST["description"];
    $requirements = $_POST["requirements"];
    $salary       = $_POST["salary"];

    if (!$job_title) {
        $status['error'] = "Job title field is blank!";
    } elseif (!$req_number) {
        $status['error'] = "Requisition number field is blank!";
    } elseif (!$description) {
        $status['error'] = "Description field is blank!";
    } elseif ($salary == "0") {
        $status['error'] = "You didn't set a salary!";
    }

    if ( $status['error'] == NULL ) {
        $query = "INSERT INTO jobs(job_title, req_number, interest, city, state, type, description, requirements, salary, date_posted) VALUES (\"$job_title\", \"$req_number\", \"$interest\", \"$city\", \"$state\", \"$type\", \"$description\", \"$requirements\", \"$salary\", NOW() )";
        echo $query;
        mysql_query($query)
        or die("Server Error: ".mysql_error());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Job Seek :: Post a Job</title>
<link rel="stylesheet" href="jobseek_styles.css" type="text/css" />
</head>
<body>
<?php if (isset($status['error']) && $status['error']) { ?> <div class="errorMessage"><?php print $status['error'] ?></div><?php } ?>
<?php if (isset($status['message']) && $status['message']) { ?> <div class="message"><?php print $status['message'] ?></div><?php } ?>
<form method="POST" action="" name="auth">
<fieldset>
    <legend>Post Job</legend>
    <div><label>Job Title:</label><input type="text" name="job_title"></div>
    <div><label>Requisition Number:</label><input type="text" name="req_number"></div>
    <div><label>Area of Interest:</label><input type="text" name="interest"></div>
    <div><label>City:</label><input type="text" name="city"></div>
    <div><label>State:</label><input type="text" name="state"></div>
    <div><label>Type:</label><input type="text" name="type"></div>
    <div><label>Description:</label><textarea rows="15" cols="30" name="description" size="100px"></textarea></div>
    <div><label>Requirements:</label><textarea rows="15" cols="30" name="requirements" size="100px"></textarea></div>       
    <div><label>Salary:</label><input type="number" name="salary" value="0" step="500"/></div>
    <br/>
    <div align="right"><input type="submit" value="Post Job"></div>
</fieldset>
</form>
</body>
</html>
