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

// Get user ID
$id = $_GET['id'];

// Fetch user from database
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Update user in database
  $stmt = $conn->prepare("UPDATE users SET gender = ?, title = ?, first_name = ?, last_name = ?, street = ?, city = ?, state = ?, country = ?, postcode = ?, email = ?, phone = ? WHERE id = ?");
  $stmt->bind_param("sssssssssssi", $gender, $title, $first_name, $last_name, $street, $city, $state, $country, $postcode, $email, $phone, $id);
  
  $gender = $_POST['gender'];
  $title = $_POST['title'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $street = $_POST['street'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $country = $_POST['country'];
  $postcode = $_POST['postcode'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  
  $stmt->execute();
  
  header("Location: index.php");
}

$stmt->close();
$conn->close();
?>
<form method="post">
  <label for="gender">Gender:</label>
  <input type="text" name="gender" value="<?php echo $user['gender']; ?>"><br>
<label for="title">Title:</label>
<input type="text" name="title" value="<?php echo $user['title']; ?>"><br>

<label for="first_name">First Name:</label>
<input type="text" name="first_name" value="<?php echo $user['first_name']; ?>"><br>
<label for="last_name">Last Name:</label>
<input type="text" name="last_name" value="<?php echo $user['last_name']; ?>"><br>

<label for="street">Street:</label>
<input type="text" name="street" value="<?php echo $user['street']; ?>"><br>

<label for="city">City:</label>
<input type="text" name="city" value="<?php echo $user['city']; ?>"><br>

<label for="state">State:</label>
<input type="text" name="state" value="<?php echo $user['state']; ?>"><br>

<label for="country">Country:</label>
<input type="text" name="country" value="<?php echo $user['country']; ?>"><br>

<label for="postcode">Postcode:</label>
<input type="text" name="postcode" value="<?php echo $user['postcode']; ?>"><br>

<label for="email">Email:</label>
<input type="email" name="email" value="<?php echo $user['email']; ?>"><br>

<label for="phone">Phone:</label>
<input type="tel" name="phone" value="<?php echo $user['phone']; ?>"><br>

  <input type="submit" value="Save">
</form>