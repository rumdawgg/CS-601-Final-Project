<?php session_start(); ?>


<html>
    <head>
        <title>Job Seek :: View Job</title>
        <link rel="stylesheet" href="includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php require "includes/js_header.php";?>
        <?php require "includes/message_bar.php";?>
        <?php // Are we logged in?
        if (empty($_SESSION['userAuthenticated'])) { 
        include "includes/login_box.html"; 
        } else {
            include "searchjobform.php";
        }
        require "includes/js_footer.php"; ?>
    </body>
    </body>
</html>