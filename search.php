<?php session_start();

require "includes/database.php";

if (empty($_SESSION['userAuthenticated'])) {
    //if not authenticated, kick them back to the main page
    header('Location: index.php');
}

if (isset($_POST['searchtype']) && isset($_POST['searchterm'])){
    $searchtype = $_POST['searchtype'];
    $searchterm = $_POST['searchterm'];
} else if(isset($_REQUEST['searchtype']) && isset($_REQUEST['searchterm'])){
    $searchtype = $_REQUEST['searchtype'];
    $searchterm = $_REQUEST['searchterm'];
    //echo "blah";
} else {
    header('Location: searchjob.php');
}

$searchterm = trim($searchterm);

if(!$searchterm){
    //go somewhere else
    //echo '<tr><td style="color: red">No search term provided!</td></tr>';
    //include("searchBookForm.php"); 
    } else {
        $user = $_SESSION['userID'];
        $rowstart = 0;
        $last = $rowstart;
        $query = "SELECT * FROM jobs WHERE $searchtype like \"%$searchterm%\";";
        //echo $query;
        $results = mysql_query($query);
        $num_results = mysql_num_rows($results);
    }?>

<html>
    <head>
        <title>Job Seek :: Search Results</title>
        <link rel="stylesheet" href="includes/jobseek_styles.css" type="text/css" />
    </head>
    <body>
        <?php require "includes/js_header.php";?>
        <?php require "includes/message_bar.php";?>
        <?php require "includes/menubar.php";?>
        <div>Found: <?php print "$num_results" ?> job(s)</div><br/>
        <table>
        <tr class="boxtitle"><th>Title:</th><th>Requisition Number:</th><th>Area of Interest:</th><th>Location:</th></tr>
        <?php while ($row = mysql_fetch_array($results)) {
                extract($row);?>
                <tr><td><a href=viewjob.php?id=<?php print($req_number);?>><?php print($job_title); ?></a></td><td><?php print($req_number); ?></td><td><?php print($interest); ?></td><td><?php print($city); ?></td></tr>
<?php       } ?>
        </table>
        <br />
        <?php require "includes/js_footer.php"; ?>
    </body>
</html>