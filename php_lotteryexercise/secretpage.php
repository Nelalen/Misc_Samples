<?php
session_start();

//echo "<p>Your session ID is: ".session_id().".</p>";


//if ($_COOKIE["auth"] == "1") {
  if (filter_input (INPUT_COOKIE, 'auth') == "1") {
	$display_block = "<p>You are an authorized user.</p>";
        header("Location: choosetickets.php");
        
} else {
	//redirect back to login form if not authorized
	header("Location: userlogin.html");
	exit;
}
?>

<html>
<head>
<title> Login Successful</title>
</head>
<body>
<?php echo "$display_block"; ?>
</body>
</html>
