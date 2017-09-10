<!DOCTYPE html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medhacks";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `Dept Name` AS dept,
`Available Beds` AS avail,
`Total Beds` AS capacity
FROM `department`";

$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>
<html>
<head>
	<title>Room Availability</title>
  <link rel="stylesheet" href="patient_status_style.css">
</head>
<body>
	<h1 style="font-family:helvetica;" align= "center">Available Rooms</h1>
	<table align = "center" class="data-table">
		<caption class="title">Department Status</caption>
		<thead>
			<tr>
				<th>Department</th>
				<th># Beds Available</th>
        <th>Capacity</th>
			</tr>
		</thead>
		<tbody>
		<?php
		while ($row = mysqli_fetch_array($query))
		{
			echo '<tr>
					<td>'.$row['dept'].'</td>
          <td>'.$row['avail'].'</td>
          <td>'.$row['capacity'].'</td>
				</tr>';
		}?>
		</tbody>
		</table>
</body>
<a href="available_rooms.php">
  <img src="gps.png" alt="patient history" style="position: absolute; bottom:80px; left:650px;width:75px;height:75px;border:0;">
</a>

 <a href="notifications.php">
  <img src="home.png" alt="homepage" style="position: absolute; bottom:80px; left:800px;width:75px;height:75px;border:0;">
</a>
</html>
