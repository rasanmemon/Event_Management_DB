<?php
	//Connect database
	include "database/connect.php";
	
	//Read session
	include 'session.php';
	$uid=$_SESSION['UserID'];
	if($uid=='' || $uid==null){
		$message="Please login to continue";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Refresh: 0, login_register.php");
	}

	//Read button script
	//include "top_button.html";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special View List</title>
	<style type="text/css">
		a:hover{
			font-size: 24px;
		}
		a{
			color: blue;
		}
		form{
			margin-left: 60px;
			margin-top: 15px;
			margin-right: 60px;
		}
		table{
			max-width: 1200px;
			margin-bottom:50px;
			margin-left:auto;
			margin-right:auto;
			background-color: white;
			text-align:center;
		}
		th{
			background-color: #66CDAA;
			border:1px solid #66CDAA;
			font-size: 18px;
			text-align: center;
			padding: 5px 10px;
		}
		td{
			border:1px solid black;
			font-size: 16px;
			font-family: Times New Roman;
			padding: 5px 5px;
		}
		input[type=submit]{
			padding: 5px;
			color: black;
			border: none;
			background-color: #66CDAA;
			font-weight: 700;
			font-family: Times New Roman;
			font-size: 18px;
			text-align: center;
			width: 100px;
		}
		input[type=submit]:hover{
			background-color: #20B2AA;
		}
		div{
			margin: auto;
			padding-bottom: 20px;
			min-width: 70%;
			max-width: 95%;
			background-color: white;
		}
		hr{
			border-top: 5px dotted grey;
			border-bottom: none;
			border-left: none;
			border-right: none;
			width: 95%;
			padding-top: 10px
		}
	</style>
</head>
<body background="image\concrete1.jpg">
<table align="center" cellpadding="20px" cellspacing="6px">
<tr>
				<th >UserName</th>
				<th >UserEmail</th>
	</tr>
    <?php 
		
		$name =$_POST['sviewlist'];
	
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		$read_event = "SELECT * FROM  guest INNER JOIN weakentity ON weakentity.EventID = $name AND weakentity.Guest_Id = guest.Guest_Id ";
					$result_read_event = mysqli_query($conn, $read_event);
					if(mysqli_num_rows($result_read_event)>0){
						while($row = mysqli_fetch_array($result_read_event, MYSQLI_ASSOC)){
							echo "<tr>";
							echo "<td>".$row['Guest_FName']."</td>";
							echo "<td>".$row['Guest_email']."</td>";
							echo "<tr>";
						}
					}
				
	?>
</table>
	
</body>
</html>