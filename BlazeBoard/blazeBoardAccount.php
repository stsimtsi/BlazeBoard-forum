<?
session_start();
include('display.php');

if(@$_SESSION["username"]){
$check=mysqli_query($connect,"SELECT* FROM user WHERE username='".$_SESSION['username']."'");
$rows=mysqli_num_rows($check);
while($row=mysqli_fetch_assoc($check)){
	$username=$row['username'];
	$id=$row['id'];
	$email=$row['email'];
	$fname=$row['firstname'];
	$lname=$row['lastname'];
	$date=$row['date'];

	
}
?>
<html>
	<head>
		<title>My Account</title>
		
	</head>
	<body>
		<center>
		
		<h2>My Messages:</h2>
		<table class="table1" border="1px;">
				<tr>
					<th><span>ID</span></th>
					<th>NAME</th>
					
					<th>POSTED BY</th>
					<th>DATE</th>
					
				</tr>
			<?
$check=mysqli_query($connect,"SELECT * FROM blazeboardmessages WHERE author='".$_SESSION['username']."'");
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
		
		<center>
			</br>
			</br>
			<a href='blazeBoardAccount.php?action=cp'>Change Password</a>
			</br>
			<a href='blazeBoardAccount.php?action=pic'>Change Profile Picture</a>
		</center>
	</body>

<?



if($_GET['action']=="cp"){
	echo "<center><form action='blazeBoardAccount.php?action=cp' method='POST'";
	echo "
		<br>Enter current password:<input type='password' name='cpass'></br>
		<br>Enter new password:<input type='password' name ='npass'</br>
		<br></br>
		<br>Re-enter new password:<input type='password' name='rpass'</br>
		<br><input type='submit' name='submit' value='Change Password'></br>
		
	";
	
	    $cpass=sha1($_POST['cpass']);
		$npass=sha1($_POST['npass']);
		$rpass=sha1($_POST['rpass']);
	
	if(isset($_POST['submit'])){
		
		$check=mysqli_query($connect,"SELECT * FROM user WHERE username='".$_SESSION['username']."'");
		$rows=mysqli_num_rows($check);
		
		while($row=mysqli_fetch_assoc($check)){
			$pass=$row['password'];
			
		}
		if($pass==$cpass){
			if($npass==$rpass){
				if(strlen($npass)>=6){
					
				if($query=mysqli_query($connect,"UPDATE user SET password='".$npass."' WHERE username='".$_SESSION['username']."'")){
					
				echo "Password changed!";
				}
				}else{
					echo "Password must be longer than 6 characters ";
				}
			}else{
				echo "Passwords doesn't match!";
			}
		}else{
			echo "Wrong password!";
		}
		
	echo "</center></form>";	
	}
	
	
	
	
}


if($_GET['action']=="pic"){
	echo "<center><form action='blazeBoardAccount.php?action=pic' method='POST' enctype='multipart/form-data'>";
	echo "
		<br><h2>Choose Photo</h2></br>
		<br><input type='file'  name ='image'></br>
		<br><input type='submit' name='change_pic' value='Change'></br>
	
		
	";
	
	    $photo=$_POST['browse'];
		
	
	if(isset($_POST['change_pic'])){
		$errors=array();
		$allowed_e=array('png','jpg','jpeg');
		
		$file_name=$_FILES['image']['name'];
		$file_e=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
		$file_s=$_FILE['image']['size'];
		$file_tmp=$_FILES['image']['tmp_name'];
		
		if(in_array($file_e, $allowed_e)===false){
			$errors[]='This file extension is not allowed';
			
		}
		if($file_s>2097152){
			$errors[]='file must be under 2mb';
			
		}
		
		if(empty($errors)){
			move_uploaded_file($file_tmp,'images/'.$file_name);
			$image_up='images/'.$file_name;
		
		if($query=mysqli_query($connect,"UPDATE user SET image='".$image_up."' WHERE username='".$_SESSION['username']."'")){
					
				echo "Profile picture changed!";
				echo $file_name;
		}      
				}else{
				foreach($errors as $error){
				echo $error, '</br>';	
				}
				
				}
		
			
		}
		
}
	
	
?>
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

</html>