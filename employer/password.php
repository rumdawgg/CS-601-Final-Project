<?php session_start();

require "../includes/database.php";

if ($_POST) {

    $email = $_POST["email"];

    $query = "SELECT * FROM employers WHERE email = '$email';";
    //echo "Running query: $query";
    $results = mysql_query($query)
    or die("Query error: " . mysql_error());
    if (mysql_num_rows($results)) {
        $hash = md5(rand());
        $query = "UPDATE employers SET temphash = '$hash' WHERE email = '$email';";
        mysql_query($query)
        or die("Query error: " . mysql_error());
        $from = "root@sagrantino.broadinstitute.org";
        $subject = "Job Seek Password Reset";
        $headers = "MIME-Version: 1.0\r\n".
        "Content-type: text/html; charset=iso-8859-1\r\n".
        "Content-Transfer-Encoding: 7bit\r\n".
        "From: $from\r\n";
        $message = "<b>Job Seek Password Reset</b><br><br>".
        "Click below to reset your password:<br>".
        "<a href='http://sagrantino.broadinstitute.org/jobseek/employer/password_reset.php?id=$hash'>Click Here</a>";
        mail($email,$subject,$message,$headers);
        $status['message'] = "Sent password reset email";
    } else {
        $status['error'] = "Invalid email";
    }
}?>

<!DOCTYPE html>
<html>
    <head>
        <title>Job Seek :: Forgot Password</title>
        <link rel="stylesheet" href="../includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php require "../includes/js_header.php";?>
        <?php require "../includes/message_bar.php";?>
        <?php if (empty($_SESSION['userAuthenticated'])) {
            include "password.html";
        } else { header('Location: myjobs.php'); } //if they are already logged in, send them elsewhere
        require "../includes/js_footer.php"; ?>
    </body>
</html>
