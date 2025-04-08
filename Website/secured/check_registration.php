<?php
// Connessione al database
$host = "localhost";
$port = "5432";
$dbname = "db_secure";
$user = "user_user";
$password = "12345";

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

$hashed_password = password_hash($password_input, PASSWORD_BCRYPT);

pg_query($conn, 'BEGIN');

// inserting the address
$query_address = 'INSERT INTO address (street, number, city) VALUES ($1, $2, $3) RETURNING id';
$result_address = pg_prepare($conn, "register_address", $query_address);
$result_address = pg_execute($conn, "register_address", array($street, $number, $city));
if (!$result_address) {
    pg_query($conn, 'ROLLBACK');  // resets the query
    header("Location: ./registration.php?error=Address+insertion+failed");
    exit();
}
$address_id = pg_fetch_result($result_address, 0, 'id');

// inserting the user
$query_user = 'INSERT INTO users (username, name, surname, password, email, role, address) VALUES ($1, $2, $3, $4, $5, $6, $7)';
$result_user = pg_prepare($conn, "register_user", $query_user);
$result_user = pg_execute($conn, "register_user", array($username, $name, $surname, $hashed_password, $email, 'user', $address_id));
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
