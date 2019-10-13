<?
session_start();
include('display.php');
if(@$_SESSION["username"]){
?>
<html>
	<body>
		<center>
		<form action="blazeBoardPost.php" method="POST">
			Thread name:</br><input type="string" name="topic"></br>
			</br>Write your message here:</br><textarea name="message" type="text" style="resize; none; width: 400px; height: 300px;"></textarea></br>
			</br>
			<input class="button" type="submit" name="post" value="Post" style="width: 200px;">
			<?
			$topic=$_POST['topic'];
			$message=$_POST['message'];
			$date=date("Y-m-d");
			$author=$_SESSION['username'];
			
			if(isset($_POST['post'])){
			if($topic && $message){
				if($query=mysqli_query($connect,"INSERT INTO blazeboardmessages(author,posted,message,message_name) VALUES('$author','$date','$message','$topic')")){
					echo "Message Posted!";
				}else{
					echo "Failed";
				}
				
			}else{
				echo "You must fill all fields";
			}
			}
			
			?>
		</form>
		</center>
	</body>
</html>
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