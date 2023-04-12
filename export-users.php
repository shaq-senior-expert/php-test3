<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch users from database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Generate CSV file
$file = fopen("users.csv", "w");
fwrite($file, "Gender,Title,First Name,Last Name,Street,City,State,Country,Postcode,Email,Phone\n");

while ($row = $result->fetch_assoc()) {
  fwrite($file, $row['gender'] . ",");
  fwrite($file, $row['title'] . ",");
  fwrite($file, $row['first_name'] . ",");
  fwrite($file, $row['last_name'] . ",");
  fwrite($file, $row['street'] . ",");
  fwrite($file, $row['city'] . ",");
  fwrite($file, $row['state'] . ",");
  fwrite($file, $row['country'] . ",");
  fwrite($file, $row['postcode'] . ",");
  fwrite($file, $row['email'] . ",");
  fwrite($file, $row['phone'] . "\n");
}

fclose($file);

// Queue file for export
$queue = new SplQueue();
$queue->enqueue("users.csv");

// Asynchronously process queue
while (!$queue->isEmpty()) {
  $file = $queue->dequeue();
  // Export file
}
?>
