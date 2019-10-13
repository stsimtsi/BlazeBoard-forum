<?

session_start();
require('connect.php');
if(@$_SESSION["username"]){
	echo "Welcome ".$_SESSION['username'];
	
?>
<html>
	<head>
		<title> Profile </title>
	</head>
	<?
	include('display.php');
	if($_GET['id']){
			$check=mysqli_query($connect,"SELECT * FROM user WHERE id='".$_GET['id']."'");
	$rows=mysqli_num_rows($check);
		if(mysqli_num_rows($check) !=0){
			while($row=mysqli_fetch_assoc($check)){
				echo "<br><h1>".$row['username']."</h1><img src='".$row['image']."' width='100' height='100'<br>";
				echo "</br><h3> First Name: ".$row['firstname']."</h3><br>";
				echo "</br><h3> Last Name: ".$row['lastname']."</h3><br>";
				echo "</br><h3> E-mail: ".$row['email']."</h3><br>";
				echo "</br><h3> Date registered: ".$row['date']."</h3><br>";
				echo "</br> ";
			}
	}
	}
	?>
	<body>
	
		
	</body>
	
</html>
<?	
if($_GET['action']=="logout"){
	session_destroy();
	header("Location:blazeBoardLogin.php");
}

}
else{
	echo "You must be logged in!";
		echo "</br><a href='blazeBoardLogin.php'>Login!</a><br>";
}
?>