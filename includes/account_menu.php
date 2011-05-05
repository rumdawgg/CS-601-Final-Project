<div><div>Hello <?php echo($_SESSION['userFullName']); ?>! you are now logged in.  Click <a href="?logout">here</a> to logout.</div>
<div class="account"><a href="searchjob.php">Search Jobs</a></div>
<?php if ( $_SESSION['userType'] == 'employer'){ ?><div class="account"><a href="postjob.php">Post</a></div><?php } ?>
<div><a href="viewall.php">Show All Jobs</a></div>
<div><a href="myjobs.php">My Jobs</a></div></div>