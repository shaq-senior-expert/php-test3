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

// Get total number of users
$json = file_get_contents('https://randomuser.me/api/?results=1');
$data = json_decode($json, true);
$total_users = $data['info']['results'];

// Get current page number
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Get starting index
$start = ($page - 1) * 5;

// Fetch users from API endpoint
$json = file_get_contents('https://randomuser.me/api/?results=5&page=' . $page);
$data = json_decode($json, true);

// Insert users into database
$stmt = $conn->prepare("INSERT INTO users (gender, title, first_name, last_name, street, city, state, country, postcode, email, phone, picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssss", $gender, $title, $first_name, $last_name, $street, $city, $state, $country, $postcode, $email, $phone, $picture);

foreach ($data['results'] as $user) {
  $gender = $user['gender'];
  $title = $user['name']['title'];
  $first_name = $user['name']['first'];
  $last_name = $user['name']['last'];
  $street = $user['location']['street']['name'];
  $city = $user['location']['city'];
  $state = $user['location']['state'];
  $country = $user['location']['country'];
  $postcode = $user['location']['postcode'];
  $email = $user['email'];
  $phone = $user['phone'];
  $picture = $user['picture']['large'];
  
  $stmt->execute();
}

$stmt->close();
$conn->close();
?>
