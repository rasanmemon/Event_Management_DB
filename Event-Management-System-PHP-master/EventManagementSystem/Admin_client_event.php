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
<html>
<head>
	<title>Urban Management - View User</title>
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
		input[type=submit],button[type=submit]{
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
		input[type=submit]:hover,button[type=submit]:hover{
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

	<button onclick="topFunction()" id="myBtn" title="Go to top"></button>

	<!--Sort according to name in ascending/descending order-->
	<!--Sort according to UserID by default-->
	<div id="view" align="center">
		<br>
		<p><span style="text-decoration: underline;font-weight: 900;font-size: 30px"> >>> View All Event <<< </span></p>
		<hr>
		<form action="admin_client_event.php" method="POST" style="font-size: 20px;">
			Event Name: 
			<input type="submit" name="name_asc" value="Ascending">&nbsp;
			<input type="submit" name="name_desc" value="Descending">
			&nbsp;&nbsp;Event Date: 
			<input type="submit" name="date_asc" value="Ascending">&nbsp;
			<input type="submit" name="date_desc" value="Descending">
			&nbsp;&nbsp;Organizer: 
			<input type="submit" name="user_asc" value="Ascending">&nbsp;
			<input type="submit" name="user_desc" value="Descending">
			<br/>
			&nbsp;&nbsp;
			<select style="width: 140px " name="search_user_id">
						<option value=" ">Select</option>
						<?php
							$conn = mysqli_connect($servername, $username, $password, $dbname);
							$read_user = "SELECT * FROM user_details where UserType='Client' OR UserType='Admin' ";
							$result_read_user = mysqli_query($conn, $read_user);
							if(mysqli_num_rows($result_read_user)>0){
								while($row = mysqli_fetch_array($result_read_user, MYSQLI_ASSOC)){
									echo "<option value='".$row['UserID']."'>".$row['UserID']."</option>";
								}
							}
						?>
					</select>
					&nbsp;&nbsp;
					<input type="submit" style="margin:4px 0px 0px 0px"  value="Search" name="search">
		</form>
		<hr>
		<table align="center" cellpadding="20px" cellspacing="6px">
			<tr>
				<th width="4%">No.</th>
				<th width="25%">Name</th>
				<th width="11%">Date</th>
				<th width="11%">Time</th>
				<th width="12%">Category</th>
				<th width="4%">Ticket Price</th>
				<th width="4%">Total Ticket</th>
				<th width="4%">Ticket Sold</th>
				<th width="20%">Venue</th>
				<th width="5%">Organizer</th>
			</tr>
			<?php
				if (isset($_POST['name_asc'])) {
					$count=0;
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					$read_event = "SELECT * FROM event_details INNER JOIN venue_details ON event_details.VenueID = venue_details.VenueID ORDER BY EventName ASC";
					$result_read_event = mysqli_query($conn, $read_event);
					if(mysqli_num_rows($result_read_event)>0){
						while($row = mysqli_fetch_array($result_read_event, MYSQLI_ASSOC)){
							$count=$count+1;
							echo "<tr>";
							echo "<td style='text-align:center'>".$count."</td>";
							echo "<td>".$row['EventName']."</td>";
							echo "<td>".$row['EventDate']."</td>";
							echo "<td>".$row['EventTime']."</td>";
							echo "<td>".$row['EventCategory']."</td>";
							echo "<td>".$row['EventTicketPrice']."</td>";
							echo "<td>".$row['EventTicketTotal']."</td>";
							echo "<td>".$row['EventTicketSold']."</td>";
							echo "<td>".$row['VenueName']."</td>";
							echo "<td>".$row['UserID']."</td>";
							echo "<form method='POST' action='viewlist.php'' >";
							echo "<td><button type='submit'  style='margin:4px 0px 0px 0px'  value='".$row['EventID']."' name='viewlist' >View List</button></td>";
							echo "<tr>";
							echo "</form>";
						}
					}
				}
				else if (isset($_POST['name_desc'])) {
					$count=0;
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					$read_event = "SELECT * FROM event_details INNER JOIN venue_details ON event_details.VenueID = venue_details.VenueID ORDER BY EventName DESC";
					$result_read_event = mysqli_query($conn, $read_event);
					if(mysqli_num_rows($result_read_event)>0){
						while($row = mysqli_fetch_array($result_read_event, MYSQLI_ASSOC)){
							$count=$count+1;
							echo "<tr>";
							echo "<td style='text-align:center'>".$count."</td>";
							echo "<td>".$row['EventName']."</td>";
							echo "<td>".$row['EventDate']."</td>";
							echo "<td>".$row['EventTime']."</td>";
							echo "<td>".$row['EventCategory']."</td>";
							echo "<td>".$row['EventTicketPrice']."</td>";
							echo "<td>".$row['EventTicketTotal']."</td>";
							echo "<td>".$row['EventTicketSold']."</td>";
							echo "<td>".$row['VenueName']."</td>";
							echo "<td>".$row['UserID']."</td>";
							echo "<form method='POST' action='viewlist.php' >";
							echo "<td><button type='submit'  style='margin:4px 0px 0px 0px'  value='".$row['EventID']."' name='viewlist' >View List</button></td>";
							echo "</form>";
							echo "<tr>";
						}	
					}
				}
				else if (isset($_POST['date_asc'])) {
					$count=0;
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					$read_event = "SELECT * FROM event_details INNER JOIN venue_details ON event_details.VenueID = venue_details.VenueID ORDER BY EventDate ASC";
					$result_read_event = mysqli_query($conn, $read_event);
					if(mysqli_num_rows($result_read_event)>0){
						while($row = mysqli_fetch_array($result_read_event, MYSQLI_ASSOC)){
							$count=$count+1;
							echo "<tr>";
							echo "<td style='text-align:center'>".$count."</td>";
							echo "<td>".$row['EventName']."</td>";
							echo "<td>".$row['EventDate']."</td>";
							echo "<td>".$row['EventTime']."</td>";
							echo "<td>".$row['EventCategory']."</td>";
							echo "<td>".$row['EventTicketPrice']."</td>";
							echo "<td>".$row['EventTicketTotal']."</td>";
							echo "<td>".$row['EventTicketSold']."</td>";
							echo "<td>".$row['VenueName']."</td>";
							echo "<td>".$row['UserID']."</td>";
							echo "<form method='POST' action='viewlist.php' >";
							echo "<td><button type='submit'  style='margin:4px 0px 0px 0px'  value='".$row['EventID']."' name='viewlist' >View List</button></td>";
							echo "</form>";
							echo "<tr>";
						}
					}
				}
				else if (isset($_POST['date_desc'])) {
					$count=0;
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					$read_event = "SELECT * FROM event_details INNER JOIN venue_details ON event_details.VenueID = venue_details.VenueID ORDER BY EventDate DESC";
					$result_read_event = mysqli_query($conn, $read_event);
					if(mysqli_num_rows($result_read_event)>0){
						while($row = mysqli_fetch_array($result_read_event, MYSQLI_ASSOC)){
							$count=$count+1;
							echo "<tr>";
							echo "<td style='text-align:center'>".$count."</td>";
							echo "<td>".$row['EventName']."</td>";
							echo "<td>".$row['EventDate']."</td>";
							echo "<td>".$row['EventTime']."</td>";
							echo "<td>".$row['EventCategory']."</td>";
							echo "<td>".$row['EventTicketPrice']."</td>";
							echo "<td>".$row['EventTicketTotal']."</td>";
							echo "<td>".$row['EventTicketSold']."</td>";
							echo "<td>".$row['VenueName']."</td>";
							echo "<td>".$row['UserID']."</td>";
							echo "<form method='POST' action='viewlist.php' >";
							echo "<td><button type='submit'  style='margin:4px 0px 0px 0px'  value='".$row['EventID']."' name='viewlist' >View List</button></td>";
							echo "</form>";
							echo "<tr>";
						}
					}
				}
				else if (isset($_POST['user_asc'])) {
					$count=0;
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					$read_event = "SELECT * FROM event_details INNER JOIN venue_details ON event_details.VenueID = venue_details.VenueID ORDER BY UserId ASC";
					$result_read_event = mysqli_query($conn, $read_event);
					if(mysqli_num_rows($result_read_event)>0){
						while($row = mysqli_fetch_array($result_read_event, MYSQLI_ASSOC)){
							$count=$count+1;
							echo "<tr>";
							echo "<td style='text-align:center'>".$count."</td>";
							echo "<td>".$row['EventName']."</td>";
							echo "<td>".$row['EventDate']."</td>";
							echo "<td>".$row['EventTime']."</td>";
							echo "<td>".$row['EventCategory']."</td>";
							echo "<td>".$row['EventTicketPrice']."</td>";
							echo "<td>".$row['EventTicketTotal']."</td>";
							echo "<td>".$row['EventTicketSold']."</td>";
							echo "<td>".$row['VenueName']."</td>";
							echo "<td>".$row['UserID']."</td>";
							echo "<form method='POST' action='viewlist.php' >";
							echo "<td><button type='submit' style='margin:4px 0px 0px 0px'  value='".$row['EventID']."' name='viewlist' >View List</button></td>";
							echo "</form>";
							echo "<tr>";
						}
					}
				}
				else if (isset($_POST['user_desc'])) {
					$count=0;
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					$read_event = "SELECT * FROM event_details INNER JOIN venue_details ON event_details.VenueID = venue_details.VenueID ORDER BY UserID DESC";
					$result_read_event = mysqli_query($conn, $read_event);
					if(mysqli_num_rows($result_read_event)>0){
						while($row = mysqli_fetch_array($result_read_event, MYSQLI_ASSOC)){
							$count=$count+1;
							echo "<tr>";
							echo "<td style='text-align:center'>".$count."</td>";
							echo "<td>".$row['EventName']."</td>";
							echo "<td>".$row['EventDate']."</td>";
							echo "<td>".$row['EventTime']."</td>";
							echo "<td>".$row['EventCategory']."</td>";
							echo "<td>".$row['EventTicketPrice']."</td>";
							echo "<td>".$row['EventTicketTotal']."</td>";
							echo "<td>".$row['EventTicketSold']."</td>";
							echo "<td>".$row['VenueName']."</td>";
							echo "<td>".$row['UserID']."</td>";
							echo "<form method='POST' action='viewlist.php' >";
							echo "<td><button type='submit'  style='margin:4px 0px 0px 0px'  value='".$row['EventID']."' name='viewlist' >View List</button></td>";
							echo "</form>";
							echo "<tr>";
						}
					}
				}else if (isset($_POST['search'])) {
					$selectid=$_POST['search_user_id'];
					if($selectid!=" "){

					
					$count=0;
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					$read_event = "SELECT * FROM event_details INNER JOIN venue_details ON event_details.VenueID = venue_details.VenueID AND event_details.UserID='$selectid'  ORDER BY UserID ASC";
					$result_read_event = mysqli_query($conn, $read_event);
					if(mysqli_num_rows($result_read_event)>0){
						while($row = mysqli_fetch_array($result_read_event, MYSQLI_ASSOC)){
							$count=$count+1;
							echo "<tr>";
							echo "<td style='text-align:center'>".$count."</td>";
							echo "<td>".$row['EventName']."</td>";
							echo "<td>".$row['EventDate']."</td>";
							echo "<td>".$row['EventTime']."</td>";
							echo "<td>".$row['EventCategory']."</td>";
							echo "<td>".$row['EventTicketPrice']."</td>";
							echo "<td>".$row['EventTicketTotal']."</td>";
							echo "<td>".$row['EventTicketSold']."</td>";
							echo "<td>".$row['VenueName']."</td>";
							echo "<td>".$row['UserID']."</td>";
							echo "<form method='POST' action='viewlist.php' >";
							echo "<td><button type='submit' style='margin:4px 0px 0px 0px'  value='".$row['EventID']."' name='viewlist' >View List</button></td>";
							echo "</form>";
							echo "<tr>";
						}
					}
				  }
				  else{
					$count=0;
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					$read_event = "SELECT * FROM event_details INNER JOIN venue_details ON event_details.VenueID = venue_details.VenueID ORDER BY UserID ASC";
					$result_read_event = mysqli_query($conn, $read_event);
					if(mysqli_num_rows($result_read_event)>0){
						while($row = mysqli_fetch_array($result_read_event, MYSQLI_ASSOC)){
							$count=$count+1;
							echo "<tr>";
							echo "<td style='text-align:center'>".$count."</td>";
							echo "<td>".$row['EventName']."</td>";
							echo "<td>".$row['EventDate']."</td>";
							echo "<td>".$row['EventTime']."</td>";
							echo "<td>".$row['EventCategory']."</td>";
							echo "<td>".$row['EventTicketPrice']."</td>";
							echo "<td>".$row['EventTicketTotal']."</td>";
							echo "<td>".$row['EventTicketSold']."</td>";
							echo "<td>".$row['VenueName']."</td>";
							echo "<td>".$row['UserID']."</td>";
							echo "<form method='POST' action='viewlist.php' >";
							echo "<td><button type='submit'  style='margin:4px 0px 0px 0px'  value='".$row['EventID']."' name='viewlist' >View List</button></td>";
							echo "</form>";
							echo "<tr>";
						}
					}
				  }
				}
				else{
					$count=0;
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					$read_event = "SELECT * FROM event_details INNER JOIN venue_details ON event_details.VenueID = venue_details.VenueID ORDER BY UserID ASC";
					$result_read_event = mysqli_query($conn, $read_event);
					if(mysqli_num_rows($result_read_event)>0){
						while($row = mysqli_fetch_array($result_read_event, MYSQLI_ASSOC)){
							$count=$count+1;
							echo "<tr>";
							echo "<td style='text-align:center'>".$count."</td>";
							echo "<td>".$row['EventName']."</td>";
							echo "<td>".$row['EventDate']."</td>";
							echo "<td>".$row['EventTime']."</td>";
							echo "<td>".$row['EventCategory']."</td>";
							echo "<td>".$row['EventTicketPrice']."</td>";
							echo "<td>".$row['EventTicketTotal']."</td>";
							echo "<td>".$row['EventTicketSold']."</td>";
							echo "<td>".$row['VenueName']."</td>";
							echo "<td>".$row['UserID']."</td>";
							echo "<form method='POST' action='viewlist.php' >";
							echo "<td><button type='submit' style='margin:4px 0px 0px 0px'  value='".$row['EventID']."' name='viewlist' >View List</button></td>";
							echo "</form>";
							echo "<tr>";
						}
					}
				}
			?>
		</table>
	</div>
</body>
</html>