<?php

include('mysql_logon.php');

if ($_POST) {

    $first_name   = $_POST["first_name"];
    $last_name    = $_POST["last_name"];
    $email        = $_POST["email"];
    $password     = $_POST["password"];
    $passwordconf = $_POST["passwordconf"];
        
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
        
        $query = "INSERT INTO users(first_name, last_name, email, password, created) VALUES (\"$first_name\", \"$last_name\", \"$email\", PASSWORD($password), NOW() )";
        echo "Running query: $query";
        mysql_query($query)
        or die("Server Error: ".mysql_error());
        echo "Successfully registered!";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Job Seek :: User Registration</title>
        <link rel="stylesheet" href="jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php if (isset($status['error']) && $status['error']) { ?> <div class="errorMessage"><?php print $status['error'] ?></div><?php } ?>
        <?php if (isset($status['message']) && $status['message']) { ?> <div class="message"><?php print $status['message'] ?></div><?php } ?>
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
        <?php } ?>
    </body>
</html>
