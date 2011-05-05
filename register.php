<?php

require "includes/database.php";

if ($_POST) {

    $first_name   = $_POST["first_name"];
    $last_name    = $_POST["last_name"];
    $email        = $_POST["email"];
    $password     = sha1($_POST["password"]);
    $passwordconf = sha1($_POST["passwordconf"]);
        
    $query = "SELECT * FROM users WHERE email = $email;";
    echo "Running query: $query";
    mysql_query($query);
    
    if ($password != $passwordconf) {
        $status['error'] = "Passwords do not match!";
    } elseif (!$first_name) {
        $status['error'] = "First name field is blank!";
    } elseif (!$last_name) {
        $status['error'] = "Last name field is blank!"; 
    } elseif (!$email) {
        $status['error'] = "Email field is blank!"; 
    }  elseif (!$password) {
        $status['error'] = "Password field is blank!";  
    } 
    if(!$status['error']) {
        
        $query = "INSERT INTO users(first_name, last_name, email, password, created) VALUES ('$first_name', '$last_name', '$email', '$password', curdate() );";
        //echo "Running query: $query";
        mysql_query($query)
        or die("Server Error: ".mysql_error());
        $from = "sagrantino@broadinstitute.org";
        $subject = "Job Seek Registration";
        $headers = "MIME-Version: 1.0\r\n".
                    "Content-type: text/html; charset=iso-8859-1\r\n".
                    "Content-Transfer-Encoding: 7bit\r\n".
                    "From: " . $from . "\r\n";
        $message = "<b>Warrior Server Registration</b> <br><br>".
                    "Click below to finish the registration process:<br>";
        mail($email,$subject,$message,$headers);
        $status['message'] = "Successful Registration!";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Job Seek :: User Registration</title>
        <link rel="stylesheet" href="includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php require "includes/js_header.php";?>
        <?php require "includes/message_bar.php";?>
        <?php if (empty($_SESSION['userAuthenticated'])) { ?>
        <form method="POST" action="" name="auth">
            <fieldset>
                <legend>User Registration</legend>
                <div><label>First name:</label><input type="text" name="first_name"></div>  
                <div><label>Last name:</label><input type="text" name="last_name"></div>
                <div><label>Email address:</label><input type="text" name="email"></div>
                <div><label>Password:</label><input type="password" name="password"></div>
                <div><label>Confirm Password:</label><input type="password" name="passwordconf"></div>
                <br/>
                <div align="right"><input type="submit" value="Register Now"></div>
            </fieldset>
        </form>
        <?php } 
        require "includes/js_footer.php"; ?>
    </body>
</html>
