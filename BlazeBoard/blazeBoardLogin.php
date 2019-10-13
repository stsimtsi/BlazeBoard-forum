<html>
	<center>
		<link rel="stylesheet" href="style.css" type="text/css">
	</center>
	<head>
		<title>Login to the forum</title>
		<h1>Blaze Board</h1>
	</head>
	<body>
	<center>
		<form action="blazeBoardLogin.php" method="POST" >
			<h2>Login</h2><br>
			</br> Username: <input  type="string" name="username"><br>
	    </br>Password: <input type="password" name="pass"><br>
	    <input class="button" type="submit" name = "submit" value="Login"><br>
				
		</form>
		</center>
		Not a member? <a href='blazeBoardRegister.php'>Register!</a>
	</body>
</html>
<?

session_start();
require('connect.php');
$username=$_POST['username'];
$pass= $_POST['pass'];

if(isset($_POST['submit'])){
	if($username && $pass){
		$check=mysqli_query($connect,"SELECT * FROM user WHERE username='{$username}'");
		$rows=mysqli_num_rows($check);
		
		if(mysqli_num_rows($check) !=0){
			while($row=mysqli_fetch_assoc($check)){
				$username_db=$row['username'];
				$password_db=$row['password'];
			
				if($username==$username_db && sha1($pass)==$password_db){
					echo "Logged in";
					$_SESSION['username']=$username;
					//echo $_SESSION['username'];
					
					header("Location:blazeBoardMain.php");
				}else{
					echo "YOur pass is wrong";
				}
			}
		}else{
			die ("User is not found");
		}
	}else{
		echo "Please fill all the fields";
	}
	
}

?>
