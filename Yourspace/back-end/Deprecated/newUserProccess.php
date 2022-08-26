 <?php //attempt to input new user data into DB
try {
  $sql = "INSERT INTO users (username, password)
  VALUES ('$user', '$pass')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New user created successfully <br>";
} catch(PDOException $e) {
  // echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?> 