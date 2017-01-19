<?php
session_start();
if (filter_input(INPUT_COOKIE, 'auth') == "1") {

if(isset($_POST['submit'])){
$email = ($_POST["email"]);
$password = ($_POST["password"]);
$firstname = ($_POST["firstname"]);
$lastname = ($_POST["lastname"]);
$gender = ($_POST["gender"]);
$age = ($_POST["age"]);



//connect to server and select database
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "testDB");

//create and issue the query
$targetemail = strtolower($email);
$sql = "SELECT email FROM members WHERE email = '$targetemail'";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

//get the number of rows in the result set; should be 1 if a match
if (mysqli_num_rows($result) == 1){ 
     
        echo "Your email address has already been used! </br> Please "
    . "use a different email address for a new account.";

}    

else  { 
    
    $nowTime = date("Y-m-d H:i:s", time());
    
    $newuser = "INSERT INTO members (firstname,lastname,email,password,age,gender,startdate)"
            . " VALUES('$firstname','$lastname',"
            . "'$email',PASSWORD('$password'),'$age','$gender','$nowTime')";
    
    $adduser = mysqli_query($mysqli, $newuser) or die(mysqli_error($mysqli));

    
    //$pathname = "/var/www/html/uploaddir/$email/";
    //$mode = 0733;
    
    mkdir("/var/www/html/uploaddir/".$targetemail,0733);
    
    
    echo "Your new account has been created. Thank you for joining us!" .
    "</br> <a href=\"userlogin.html\">Continue to User Login</a>";
}
}

if(!isset($_POST['submit'])){
?> 

<html>
<head>
<title>User Registration Form</title>
</head>
<body>
    
<h1>Registration Form</h1>
<!form method="post" action="<?php echo $PHP_SELF;?>">
<form method="post" action="">
<p><strong>Email:</strong><br/>
<input type="text" name="email"/></p>
<p><strong>Create Password:</strong><br/>
<input type="password" name="password"/></p>
<p><strong>First Name:</strong><br/>
<input type="text" name="firstname"/></p>
<p><strong>Last Name:</strong><br/>
<input type="text" name="lastname"/></p>
<p><strong>Age:</strong><br/>
<input type="text" name="age"/></p>
 <p><strong>Gender:</strong><br>
     <label for="Female">Female</label>
      <input type="radio" id="Female" name="gender" value="Female"><br />
      <label for="Male">Male</label>
      <input type="radio" id="Male" name="gender" value="Male"><br />

<p><input type="submit" name="submit" value="Submit"/></p>
</form>
</body>
</html>

<?php
}
} else {
	//redirect back to login form if not authorized
	header("Location: userlogin.html");
	exit;
   }
?>

