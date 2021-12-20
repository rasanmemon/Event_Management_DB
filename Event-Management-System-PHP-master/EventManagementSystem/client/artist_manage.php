<?php
	//Connect database
	include "../database/connect.php";
	
	//Read session
	include '../session.php';
	$uid=$_SESSION['UserID'];
	if($uid=='' || $uid==null){
		$message="Please login to continue";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Refresh: 0, login_register.php");
	}

	//Read button script
	include "top_button.html";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Urban Management - Add/Edit/Delete User </title>
	<style type="text/css">
		a:hover{
			font-size: 24px;
		}
		a{
			color: black;
		}
		form{
			margin-left: 60px;
			margin-top: 15px;
			margin-right: 60px;
		}
		table{
			max-width:750px;
			margin-top:50px;
			margin-bottom:50px;
			margin-left:auto;
			margin-right:auto;
			background-color: white;
		}
		th{
			font-size: 28px;
			text-align: center;
			padding-top: 20px ;
			padding-bottom: 20px ;
			width: 50%;
		}
		td, input[type=text], input[type=email],input[type=password], select{
			font-family: Times New Roman;
			font-size: 22px;
			text-align: center;
			padding-top: 2px ;
			padding-bottom: 2px ;
		}
		input[type=submit], input[type=reset]{
			padding: 10px;
			color: black;
			border: none;
			background-color: #66CDAA;
			font-weight: 900;
			font-family: Times New Roman;
			font-size: 20px;
			text-align: center;
			width: 120px;
		}
		input[type=submit]:hover, input[type=reset]:hover{
			background-color: #20B2AA;
		}
	</style>
</head>
<body background="..\image\concrete1.jpg">

	<button onclick="topFunction()" id="myBtn" title="Go to top"></button>
		<hr width="auto" size="10" style="background: #808000">

	<div id="add">
		<form action="artist_manage.php#add" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Add New User <<< </th></tr>
				<tr><td>Artist ID: <input type="text" name="a_userid" size="30" required></td></tr>
				<tr><td>Name: <input type="text" name="a_username" size="30" required></td></tr>
				<!-- <tr><td>Password: <input type="password" name="a_userpass" size="30" required></td></tr> -->
				<tr><td>Email: <input type="email" name="a_useremail" size="30" required></td></tr>
				<!-- <tr><td>User Type: 
					<select name="a_usertype" style="width: 120px;">
						<option value="">Select</option>
						<option value="Student">Student</option>
						<option value="Client">Client</option>
					</select>
				</td></tr> -->
				<tr><td><input type="submit" name="adduser" value="Add">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="edit">
		<form action="artist_manage.php#edit" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Edit User <<< </th></tr>
				<tr><td>Artist ID: 
					<select name="edit_user_id" style="width: 140px;">
						<option value="">Select</option>
						<?php
							$conn = mysqli_connect($servername, $username, $password, $dbname);
							$read_user = "SELECT * FROM artist";
							$result_read_user = mysqli_query($conn, $read_user);
							if(mysqli_num_rows($result_read_user)>0){
								while($row = mysqli_fetch_array($result_read_user, MYSQLI_ASSOC)){
									echo "<option value='".$row['Artist_id']."'>".$row['Artist_id']."</option>";
								}
							}
						?>
					</select>
				&nbsp;&nbsp;<input type="submit" name="refreshuser" value="Refresh"></td></tr>
				<tr><td><img src="../image/divide.jpg" height="40%" width="100%" style="opacity: 0.6"></td></tr>
				<tr><td>New User Name: <input type="text" name="e_username" size="30"></td></tr>
				<tr><td>New User Email: <input type="text" name="e_useremail" size="30"></td></tr>
				<tr><td><input type="submit" name="edituser" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="delete">
		<form action="artist_manage.php" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Delete User <<< </th></tr>
				<tr><td>User ID: 
					<select name="delete_user_id" style="width: 140px;">
						<option value="">Select</option>
						<?php
							$conn = mysqli_connect($servername, $username, $password, $dbname);
							$read_user = "SELECT * FROM artist";
							$result_read_user = mysqli_query($conn, $read_user);
							if(mysqli_num_rows($result_read_user)>0){
								while($row = mysqli_fetch_array($result_read_user, MYSQLI_ASSOC)){
									echo "<option value='".$row['Artist_id']."'>".$row['Artist_id']."</option>";
								}
							}
						?>
					</select>
				&nbsp;&nbsp;<input type="submit" name="refreshuser" value="Refresh"></td></tr>
				<tr><td><input type="submit" name="deleteuser" value="Delete">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
		</form>
	</div>

	<!--Each button's action-->
	<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		//Add user
		if (isset($_POST['adduser'])) {
			$uid = $_POST['a_userid'];
			// $upass = hash('sha512',$_POST['a_userpass']);
			$uname = $_POST['a_username'];
			//$utype = $_POST['a_usertype'];
			$uemail = $_POST['a_useremail'];
			$insert_user = "INSERT INTO artist (Artist_id, Artist_Name, Artist_Email) VALUES ('$uid', '$uname', '$uemail')";
			//Ensure no empty field
			
				$result_insert_user = mysqli_query($conn, $insert_user);
				if($result_insert_user){
    				$message="Add user success.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
				else{
					$message="Fail to add new user. Please try again.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			

		}
		//Edit user
		if (isset($_POST['edituser'])) {
			$selectid=$_POST['edit_user_id'];
			$uname=$_POST['e_username'];
			$uemail=$_POST['e_useremail'];
			
			if($selectid==''){
				$message="User ID not selected. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				//Update both name and email
				if(($uname!='') && ($uemail!='')){
					$update_user = "UPDATE artist SET Artist_Name='$uname', Artist_Email='$uemail' WHERE UserID='$selectid'";
					$result_update_user = mysqli_query($conn, $update_user);
					if($result_update_user){
						$message="Update user(ID: ".$selectid.") name and email success.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else{
						$message="Fail to update user name and email. Please try again.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
				//Update name only
				elseif(($uname!='') && ($uemail=='')){
					$update_name = "UPDATE artist SET Artist_Name='$uname' WHERE Artist_Id='$selectid'";
					$result_update_name = mysqli_query($conn, $update_name);
					if($result_update_name){
						$message="Update user(ID: ".$selectid.") name success.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else{
						$message="Fail to update user name. Please try again.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
				//Update email only
				elseif (($uname=='') && ($uemail!='')) {
					$update_email = "UPDATE artist SET Artist_Id='$uemail' WHERE Artist_Id='$selectid'";
					$result_update_email = mysqli_query($conn, $update_email);
					if($result_update_email){
						$message="Update user(ID: ".$selectid.") email success.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else{
						$message="Fail to update email. Please try again.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
			}
		}
		//Delete user
		if (isset($_POST['deleteuser'])) {
			$selectid=$_POST['delete_user_id'];
			if($selectid==''){
				$message="User ID not selected. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				//Check 'event_details' table. If user organized event, cannot delete
				$check_event="SELECT Artist_Id FROM event_details WHERE Artist_Id='$selectid'";
				$result_check_event = mysqli_query($conn, $check_event);
				if(mysqli_num_rows($result_check_event)>0){
					$message="Cannot delete user. The user is the organizer of certain event.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
				//If user made booking for one or more event, cannot delete user
				else{
								$message="Delete user success.";
								echo "<script type='text/javascript'>alert('$message');</script>";
							
							
						}
					}
				}
			
		
	?>
</body>
</html>