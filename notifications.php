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
`patient`.`Current Location` AS curr,
`transfer_request`.`Proposed Change` AS next
FROM `patient`,`transfer_request`
WHERE `transfer_request`.`Patient ID` = `patient`.`Patient ID`";

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
	<h1 style="font-family:helvetica;" align= "center">Notifications</h1>
	<table align = "center" class="data-table">
		<caption class="title">Pending Patient Transfers</caption>
		<thead>
			<tr>
				<th>Patient Name</th>
				<th>Current Location</th>
				<th>Next Location</th>
			</tr>
		</thead>
		<tbody>
		<?php
		while ($row = mysqli_fetch_array($query))
		{
			echo '<tr>
					<td>'.$row['Name'].'</td>
					<td>'.$row['curr'].'</td>
          <td><div contenteditable>'.$row['next'].'</div></td>
				</tr>';
		}?>
		</tbody>
		</table>
</body>
<a href="available_rooms.php">
  <img src="gps.png" alt="patient history" style="position: absolute; bottom:80px; left:600px;width:75px;height:75px;border:0;">
</a>

<a href="patient_status.php">
  <img src="status.png" alt="homepage" style="position: absolute; bottom:80px; left:700px;width:75px;height:75px;border:0;">
</a>

<a href="default.asp">
  <img src="print.png" alt="homepage" style="position: absolute; bottom:80px; left:850px;width:75px;height:75px;border:0;">
</a>
</html>
