<?php
//Warrior Server: mysql_logon.php
//Version:	1.1
//Date Last Updated:	3/12/2008
//By whom:	Rafael Revi
/*
/	File History
/	
/ 	Originally created by Rafael Revi
/	
/	Added die statements to php functions to handle errors. On 3/12/2208.
/
*/
	mysql_connect("localhost", "jobseek_user", "jobseek_pass")
	or die("Server error: Check database connection!");

	mysql_select_db("jobseek")
	or die("Server error: Database not found in MySQL!");

?>
