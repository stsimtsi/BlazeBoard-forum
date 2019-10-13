<?

session_start();
require('connect.php');
if(@$_SESSION["username"]){


	include('display.php');

?>
<html>

	<head>
		<title>Home Page</title>
	</head>
		<link rel="stylesheet" href="style.css" type="text/css">
	<body>
		<center>
			</br>
			<a href='blazeBoardPost.php'><button class="btn">Post message</button></a>
		<table class="table" border="1px;">
				<tr>
					<th><span>ID</span></th>
					<th>NAME</th>
					
					<th>POSTED BY</th>
					<th>DATE</th>
					
				</tr>
			<?
$check=mysqli_query($connect,"SELECT * FROM blazeboardmessages");
$rows=mysqli_num_rows($check);
if(mysqli_num_rows($check)!=0){
	while($row=mysqli_fetch_assoc($check)){
		$check1=mysqli_query($connect,"SELECT * FROM user WHERE username='".$row['author']."'");
		while($row1=mysqli_fetch_assoc($check1)){
			$id1=$row1['id'];
		}
		$id=$row['messageID'];
		echo "<tr>";
		echo "<td>".$row['messageID']."</td>";
		echo "<td><a href='blazeBoardMessage.php?id=$id'>".$row['message_name']."</a></td>"; 
		
		echo "<td><a href='blazeBoardProfile.php?id=$id1'>".$row['author']."</a></td>"; 
		echo "<td>".$row['posted']."</td>";
		echo "</tr>";
		
	}
	
}
?>
		
		</table>	
		</center>
		
		<?	
if($_GET['action']=="logout"){
	session_destroy();
	header("Location:blazeBoardLogin.php");
}

}
else{
	echo "You must be logged in!<br>";
	echo "</br><a href='blazeBoardLogin.php'>Login!</a><br>";
}
?>
		
	</body>
	
</html>

