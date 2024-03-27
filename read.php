<?php
$servername = "localhost";
$username = "username"; 
$password = "1.frankie";
$dbname = "geekdata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM api";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header('Content-Type: application/json');
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $response[] = $row; 
  }
  echo json_encode($response);
} else {
  echo "0 results";
}

$conn->close();
?>
