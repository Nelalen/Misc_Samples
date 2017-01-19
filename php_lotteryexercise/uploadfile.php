<?php
error_reporting(E_ALL | E_NOTICE);
ini_set('display_errors','1');
session_start();
//$email = $_SESSION['email'];

if ($_COOKIE["auth"] == "1") {
  
$usremail = $_SESSION['email'];
//isset($_SESSION['email']);
$file_dir = "/var/www/html/uploaddir/".$usremail;

foreach($_FILES as $file_name => $file_array) {
	echo "path: ".$file_array["tmp_name"]."<br/>\n";
	echo "name: ".$file_array["name"]."<br/>\n";
	echo "type: ".$file_array["type"]."<br/>\n";
	echo "size: ".$file_array["size"]."<br/>\n";

	if (is_uploaded_file($file_array["tmp_name"])) {
		move_uploaded_file($file_array["tmp_name"], "$file_dir/".$file_array["name"]) or die ("Couldn't copy");
		echo "File was moved!<br/>";
	}
  }
  

} else {
      //redirect back to login form if not authorized
	header("Location: userlogin.html");
	exit;
}
?>