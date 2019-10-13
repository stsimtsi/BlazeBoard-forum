<?

session_start();
include('display.php');
if(@$_SESSION["username"]){

	
?>
<html>
	<head>
		<title>Home Page </title>
	</head>
	<body>
	<?
	
	echo "<h1>Members</h1>";
	$check=mysqli_query($connect,"SELECT * FROM user");
	$rows=mysqli_num_rows($check);
		if(mysqli_num_rows($check) !=0){
			while($row=mysqli_fetch_assoc($check)){
				$id=$row['id'];
				echo "<a href='blazeBoardProfile.php?id=$id'>".$row['username']."</a></br>";
			}
		}
	
	?>
	
	
	
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