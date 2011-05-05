<?php

require "../includes/database.php";

if ($_POST) {

    $first_name   = $_POST["first_name"];
    $last_name    = $_POST["last_name"];
    $email        = $_POST["email"];
    $company      = $_POST["company"];
    $password     = sha1($_POST["password"]);
    $passwordconf = sha1($_POST["passwordconf"]);
    
    if ($password != $passwordconf) {
        $status['error'] = "Passwords do not match!";
    } elseif (!$first_name) {
        $status['error'] = "First name field is blank!";
    } elseif (!$last_name) {
        $status['error'] = "Last name field is blank!";
    } elseif (!$email) {
        $status['error'] = "Email field is blank!";
    } elseif (!$company) {
        $status['error'] = "Company field is blank!";
    } elseif (!$password) {
        $status['error'] = "Password field is blank!";  
    }
    if(empty($status['error'])) {
        $query = "INSERT INTO employers(first_name, last_name, company, email, password, created) VALUES ('$first_name', '$last_name', '$company', '$email', '$password', curdate() );";
        mysql_query($query)
        or die("Server Error: ".mysql_error());
        $status['message'] = "Successful Registration!";
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Job Seek :: Employer Registration</title>
        <link rel="stylesheet" href="../includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php require "../includes/js_header.php";?>
        <?php require "../includes/message_bar.php";?>
        <?php if (empty($_SESSION['userAuthenticated'])) { ?>
        <form method="POST" action="" name="auth">
            <fieldset>
                <legend>Employer Registration</legend>
                <div><label>First name:</label><input type="text" name="first_name"></div>  
                <div><label>Last name:</label><input type="text" name="last_name"></div>
                <div><label>Company:</label><input type="text" name="company"></div>
                <div><label>Email address:</label><input type="text" name="email"></div>    
                <div><label>Password:</label><input type="password" name="password"></div>
                <div><label>Confirm Password:</label><input type="password" name="passwordconf"></div>
                <br/>
                <div align="right"><input type="submit" value="Register Now"></div>
            </fieldset>
        </form>
        <div>Already have an account? Click <a href="index.php">here</a> to login.</div>
        <?php } ?>
    </body>
</html>
