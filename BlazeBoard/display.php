<?

session_start();
require('connect.php');
if(@$_SESSION["username"]){

	
?>
<html>
	
		<link rel="stylesheet" href="style.css" type="text/css">
	<body>
		<center><? 
			$check=mysqli_query($connect,"SELECT * FROM user WHERE username='".$_SESSION['username']."'");
			$rows=mysqli_num_rows($check);
			
				while($row=mysqli_fetch_assoc($check)){
					$id=$row['id'];
					
				}
				
			
			echo "Logged in as" ." <a href='blazeBoardProfile.php?id=$id'>".$_SESSION['username']." </a> ";
			           
		?><a href='blazeBoardMain.php'> | Home Page</a> |<a href='blazeBoardAccount.php'> My account</a>  | <a href='blazeBoardMembers.php'> Members </a> | <a href="blazeBoardMain.php?action=logout">Logout</a>
		</center>
	</body>
	
</html>

<?}?>