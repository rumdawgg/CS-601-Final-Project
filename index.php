<?php session_start();

require "includes/database.php";
 
try {
    if (isset($_REQUEST['logout'])) {
        session_destroy();
        session_start();
    }
} catch (Exception $e) {
    $status['error'] = $e->getMessage();
}

try {
    if (empty($_SESSION['userAuthenticated']) && $_POST) {
    
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        
        $query = "select * from users where email = '$user' AND password = PASSWORD('$pass');";
       
        $results = mysql_query($query)
        or die("Query error: " . mysql_error());
        
        $row = mysql_fetch_array($results);
        
        if (mysql_num_rows($results)) {
            extract($row);
            $_SESSION['userFullName'] = "$first_name "."$last_name";
            $_SESSION['userAuthenticated'] = true;
            $_SESSION['userEmail'] = $email;
            $_SESSION['userID'] = $id;
            
        } else {
            $status['error'] = "Incorrect username or password.";
        }
    } 
} catch (Exception $e) {
    $status = $e->getMessage();
    echo $status;
}

?>

<html>
    <head>
        <title>Job Seek :: Home</title>
        <link rel="stylesheet" href="includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php require "includes/js_header.php";?>
        <?php require "includes/message_bar.php";?>
        <?php // Are we logged in?
        if (empty($_SESSION['userAuthenticated'])) { 
        include "includes/login_box.html"; 
        } else {
            include "includes/account_menu.php";
        }
        require "includes/js_footer.php"; ?>
    </body>
</html>
