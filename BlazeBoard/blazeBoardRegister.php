<html>
		<link rel="stylesheet" href="style.css" type="text/css">
	<head>
		<title>Register your account</title>
			<h1>Blaze Board</h1>
	</head>
	<body> 
	<center>
	<form action="blazeBoardRegister.php" method="POST">
		<h2>Register to Blaze Board</h2><br>
	    Username: <input type="string" name="username"><br>
	    </br>First name:<input type="string" name="fname"><br>
	    </br>Last name:<input type="string" name="lname"><br>
	    </br>Password: <input type="password" name="pass"><br>
	    </br>Confirm Password: <input type="password" name="repass"><br>
	    </br>E-mail: <input type="string" name="mail"><br>
	    </br>
	    <input class="button" type="submit" name = "submit" value="Register"> or <a class="an" href="blazeBoardLogin.php">Login</a>
	   </form>
	   </center>
	</body>
</html>
<?
require('connect.php');
$username=$_POST['username'];
$pass=$_POST['pass'];
$repass=$_POST['repass'];
$mail=$_POST['mail'];
$date= date("Y-m-d");
$pass_encrypt=sha1($pass);
$fname=$_POST['fname'];
$lname=$_POST['lname'];


$check=mysqli_query($connect,"SELECT* FROM user WHERE username='".$username."'");
$rows=mysqli_num_rows($check);


if(isset($_POST['submit'])){
	if($username && $pass && $repass && $mail){
		if($pass==$repass){
			if(strlen($username)>=5 && strlen($pass)>=6 && strlen($username) <25){
				if($rows==0){
				if($query=mysqli_query($connect,"INSERT INTO user(username,firstname,lastname,password,email,date) VALUES('{$username}','{$fname}','{$lname}','{$pass_encrypt}','{$mail}','{$date}')")){
					echo "You have been registered! Please click <a href='blazeBoardLogin.php'>here </a> to login";
				}else {
					echo "Failure";
				}
				}else{
					echo "Username already exists!";
				}
			}else{
				if(strlen($username)<5||strlen($username)>=25){
					echo "Your username must be between 5 and 25 characters";
				}
				if(strlen($pass)<6){
					echo "Your password must have at least 6 characters";
				}
			}
			
		}else{
			echo "The password and the confirmed password doesn't match";
		}
		
	}else{
		if(!$username){
			echo "Please insert a username<br>";
		}
		if(!$pass){
			echo "Please enter a password<br>";
		}
		if(!$repass){
			echo "Please confirm password<br>";
		}
		if(!$mail){
			echo "Please enter your e-mail<br>";
		}
	}
	
	
	
	//if($query=mysqli_query($connect,"INSERT INTO user(username,password,email,date) VALUES('{$username}','{$pass}','{$mail}','{$date}')")){
	//	echo "Success";
//	}else {
	//	echo "Failure";
	
	}
	


?>