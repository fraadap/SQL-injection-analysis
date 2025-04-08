<?php
// Connessione al database
$host = "localhost";
$port = "5432";
$dbname = "db_critic";
$user = "admin_user";
$password = "10293";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    header("Location: ./registration.php?error=Connection+to+db+refused");
    exit();
} 

$username = $_POST['username'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$password_input = $_POST['password'];
$email = $_POST['email'];
$street = $_POST['street'];
$number = $_POST['number'];
$city = $_POST['city'];


pg_query($conn, 'BEGIN');

// inserting the address
$query_address = "INSERT INTO address (street, number, city) VALUES ('".$street."', '".$number. "', '".$city."') RETURNING id";
$result = pg_query($conn, $query_address);
if (!$result) {
    pg_query($conn, 'ROLLBACK');  // resets the query
    header("Location: ./registration.php?error=Address+insertion+failed");
    exit();
}
$address_id = pg_fetch_result($result, 0, 'id');

// inserting the user
$query_user = "INSERT INTO users (username, name, surname, password, email, role, address) VALUES ('".$username."','".$name."','".$surname."','".$password."','".$email."','".$role."','".$address_id."')";
$result_user = pg_query($conn, $query_user);
if (!$result_user) {
    pg_query($conn, 'ROLLBACK');
    header("Location: ./registration.php?error=User+registration+failed");
    exit();
}

// Commit transazione
pg_query($conn, 'COMMIT');

pg_close($conn);
header("Location: ./login.php?success=Registration+successful");
exit();
?>
