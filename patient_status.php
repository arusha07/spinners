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

$sql = "SELECT CONCAT(`patient`.`First Initial`,' ',`patient`.`Last Name`) AS Name,
`patient`.`Severity Level` AS Severity,
`patient`.`Current Location` AS Current,
TIMEDIFF(NOW(), `patient`.`Admit DateTime`) AS Stay
FROM `patient`";

$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>
<html>
<head>
	<title>Pending Transfers</title>
  <link rel="stylesheet" href="patient_status_style.css">
</head>
<body>
	<h1 style="font-family:helvetica;" align= "center">Patient Tracking System</h1>
	<table align = "center" class="data-table">
		<caption class="title">Pending Patient Transfers</caption>
		<thead>
			<tr>
				<th>Patient Name</th>
        <th>Severity Level</th>
				<th>Current Location</th>
				<th>Length of Stay</th>
			</tr>
		</thead>
		<tbody>
		<?php
		while ($row = mysqli_fetch_array($query))
		{
			echo '<tr>
					<td>'.$row['Name'].'</td>
					<td>'.$row['Severity'].'</td>
          <td>'.$row['Current'].'</td>
          <td>'.$row['Stay'].'</td>
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
