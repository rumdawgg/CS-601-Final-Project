<?php

require "includes/database.php";

if ($_POST) {

    $password     = sha1($_POST["password"]);
    $passwordconf = sha1($_POST["passwordconf"]);

    if ($password != $passwordconf) {
        $status['error'] = "Passwords do not match!";
    } else {
        //$query = "UPDATE users SET password = '$password', temphash = null;";
        $query = "UPDATE users SET password = '$password';";
        //echo $query;
        $results = mysql_query($query)
        or die("Query error: " . mysql_error());
        $status['message'] = "Successfully changed password";
        header('Refresh: 5;  index.php');
    }
}

if(isset($_REQUEST['id'])) {

    $authorized = false;
    $hashcheck = $_REQUEST['id'];
    $query = "SELECT * FROM users WHERE temphash = '$hashcheck';";
    //echo "Running query: $query";
    $results = mysql_query($query)
    or die("Query error: " . mysql_error());
    
    $row = mysql_fetch_array($results);
    
    if (mysql_num_rows($results)) {
        $authorized = true;
    } else {
        $status['error'] = "You did not access this page in a valid way.";
    }
} ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Job Seek :: Forgot Password</title>
        <link rel="stylesheet" href="includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php require "includes/js_header.php";?>
        <?php require "includes/message_bar.php";?>
        <?php if ($authorized) { ?>
        <form method="POST" action="" name="auth">
            <fieldset>
                <legend>New Password</legend>
                <div><label>Password:</label><input type="password" name="password"></div>
                <div><label>Confirm Password:</label><input type="password" name="passwordconf"></div>
                <br/>
                <div align="right"><input type="submit" value="Submit"></div>
            </fieldset>
        </form>
        <?php } else { header('Refresh: 5;  index.php'); }?>
     <?php require "includes/js_footer.php"; ?>
    </body>
</html>



