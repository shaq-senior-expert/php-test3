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

// Get current page number
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Get starting index
$start = ($page - 1) * 5;

// Fetch users from database
$sql = "SELECT * FROM users LIMIT $start, 5";
$result = $conn->query($sql);

// Display users
while ($row = $result->fetch_assoc()) {
	echo "<div>";
  	echo "<img src='" . $row['picture'] . "' alt='" . $row['first_name'] . " " . $row. " " . $row['last_name'] . "'>";
  	echo "<p>Name: " . $row['title'] . " " . $row['first_name'] . " " . $row['last_name'] . "</p>";
	echo "<p>Location: " . $row['street'] . ", " . $row['city'] . ", " . $row['state'] . ", " . $row['country'] . ", " . $row['postcode'] . "</p>";
	echo "<p>Email: " . $row['email'] . "</p>";
	echo "<p>Phone: " . $row['phone'] . "</p>";
	echo "<a href='edit-user.php?id=" . $row['id'] . "'>Edit</a>";
	echo "</div>";
}

// Display pagination links
echo "<div>";
if ($page > 1) {
	echo "<a href='?page=" . ($page - 1) . "'>Previous</a>";
}
if ($start + 5 < $total_users) {
	echo "<a href='?page=" . ($page + 1) . "'>Next</a>";
}
echo "</div>";

$conn->close();
?>
