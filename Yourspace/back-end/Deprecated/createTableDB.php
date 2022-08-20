 <?php
$servername = "localhost";
$username = "root";
$password = "local_Development747";
$dbname = "yourspace";

try {
  // sql to create table
  $sql = "CREATE TABLE users (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE KEY,
  username VARCHAR(15) NOT NULL UNIQUE KEY,
  password VARCHAR(30) NOT NULL,
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";

  // use exec() because no results are returned
  $conn->exec($sql);
  // echo "Table users created successfully <br>";
} catch(PDOException $e) {
  // echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?> 