<?php
$servername = "localhost";
$username = "username";
$password = "1.frankie";  
$dbname = "geekdata";

// Include database connection
$con = new mysqli($servername, $username, $password, $dbname); 

if ($_SERVER["REQUEST_METHOD"] === "POST"){
  $postinput = file_get_contents('php://input');
  $userdata = json_decode($postinput,true);

  if ($userdata && isset($userdata['name']) && isset($userdata['age']) && isset($userdata['email'])) {
    
    // Insert user data into the database
    $sql = "INSERT INTO api (name, age, email) VALUES ('" . $userdata['name'] . "', '" . $userdata['age'] . "', '" . $userdata['email'] . "')";
    
    if ($con->query($sql) === TRUE) {
      $newUserId = $con->insert_id;
      $newUser = [
        'id' => $newUserId,
        'name' => $userdata['name'],
        'age' => $userdata['age'],
        'email' => $userdata['email']
      ];
      header('Content-Type: application/json');
      echo json_encode($newUser);
    } else {
      http_response_code(500);
      echo json_encode(['error'=>'Error inserting data']);
    }

  } else {
    http_response_code(400);
    echo json_encode(['error'=>'Invalid or missing data']); 
  }

} else {
  http_response_code(405);
}

?>
