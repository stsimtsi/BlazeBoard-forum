<?
session_start();
include("display.php");
?>
<html>
	<head>
		<title>Message</title>
	</head>
	<body>
		<center>
			<?
			if($_GET['id']){
				$check=mysqli_query($connect,"SELECT * FROM blazeboardmessages WHERE messageID='".$_GET['id']."'");
				if(mysqli_num_rows($check)!=0){
					while($row=mysqli_fetch_assoc($check)){
					
						?>
						<br></br>
						<?echo"<form width='100px'action='blazeBoardMessage.php?id=".$_GET['id']."' method='POST'>"?>
							<h2>Name:<?	echo "".$row['message_name']."";?></h2>
							<h5>Posted by: <?echo $row['author'];?></h5>
							<br></br>
							<h2>Message</h2>
							<?echo "".$row['message']."";?>
							<?
							if($row['author']==$_SESSION['username']){
								
							?>
							<br><br>
							<br><input class='button' type='submit' name='delete' value='Delete'></br>
							
							<?
								if(isset($_POST['delete'])){
									if($query1=mysqli_query($connect,"DELETE FROM blazeboardmessages WHERE messageID='".$row['messageID']."'")){
					
							header("Location:blazeBoardMain.php");
									}else{
										echo $_GET['id'];
									}
								}
							}
							
								
							
							
							
							?>
							
						</form>
							<? 	if($row['author']==$_SESSION['username']){
							echo"<a href='blazeBoardMessage.php?id=".$_GET['id']."&action=ed'><button class='btn'>Edit Message</button></a>"; ?>
						<?
						
							if($_GET['action']=="ed"){
									echo "
									<form class='frm' action='blazeBoardMessage.php?id=".$_GET['id']."&action=ed' method='POST'>
									<br><input class='txtf' type='textfield' name='edtext' value='".$row['message']."'></br> 
									<br><input class='button' type='submit' name='save' value='Save'></br>
									
									";
									if(isset($_POST['save'])){
										$text=$_POST['edtext'];
										if($query=mysqli_query($connect,"UPDATE blazeboardmessages SET message='".$text."' WHERE messageID='".$row['messageID']."'")){
					
										header("Location:blazeBoardMessage.php?id=".$_GET['id']."");
										}else{
											echo $text;
										}
									}
								}
							echo "</form>";
							}
					}
				}
				
			}
			
			
			?>
			
			
		</center>
		
	</body>
</html>