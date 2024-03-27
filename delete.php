<?php
// Include database connection
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

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  
  // Get user ID from request
  $userId = $_GET['id'] ?? null;

  // Validate user ID
  if ($userId === null || !is_numeric($userId)) {
      http_response_code(400);
      echo json_encode(['error' => 'Invalid user ID']);
      exit;
  }

  // Prepare delete statement
  $stmt = $conn->prepare("DELETE FROM api WHERE id = ?");
  $stmt->bind_param("i", $userId);

  // Execute statement
  if ($stmt->execute()) {
    echo json_encode(['message' => 'User deleted']);
  } else {
    http_response_code(404);
    echo json_encode(['error' => 'User not found']); 
  }

  $stmt->close();
}

$conn->close();
?>
