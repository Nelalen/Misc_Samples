<?php
session_start();
//check for required fields from the form
if ((!filter_input(INPUT_POST,'email'))
        || (!filter_input(INPUT_POST, 'password'))) {
//if ((!isset($_POST["username"])) || (!isset($_POST["password"]))) {
	header("Location: userlogin.html");
	exit;
}



//connect to server and select database
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "testDB");

/* create and issue the query
$sql = "SELECT f_name, l_name FROM auth_users WHERE username = '".$_POST["username"].
        "' AND password = PASSWORD('".$_POST["password"]."')";
*/

//create and issue the query
$targetname = filter_input(INPUT_POST,'email');
$targetpasswd = filter_input(INPUT_POST,'password');
$sql = "SELECT firstname, lastname FROM members WHERE email = '".$targetname.
        "' AND password = PASSWORD('".$targetpasswd."')";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

//get the number of rows in the result set; should be 1 if a match
if (mysqli_num_rows($result) == 1) {

	//if authorized, get the values of firstname lastname
	while ($info = mysqli_fetch_array($result)) {
		$firstname = stripslashes($info['firstname']);
		$lastname = stripslashes($info['lastname']);
	}

	//set authorization cookie
	setcookie("auth", "1", time()+60*30, "/", "", 0);
        $_SESSION['email'] = $targetname;
                //filter_input(INPUT_POST, 'email');
        
	//create display string
	$display_block = "
	<p>".$firstname." ".$lastname." is authorized!</p>
	<p>Authorized Users' Menu:</p>
	<ul>
	<li><a href=\"secretpage.php\">Lottery Ticket Selection</a></li>
        <li><a href=\"fileupload.html\">Upload A File</a></li>
	</ul>";
} else {
	//redirect back to login form if not authorized
	//echo "User does not exist";
        echo "
        <html>
        <center>
        User does not exist or is not authorized.
        <br>
        <a href ='applyaccount.php'>Click here to make a new account!</a>
        <br>
        <a href ='userlogin.html'>Go Back</a>
        </center>
        </html>";
       
    //header("Location: userlogin.html");	
        exit;
    
}
?>
<html>
<head>
<title>User Login</title>
</head>
<body>
<?php echo "$display_block"; ?>
</body>
</html>

