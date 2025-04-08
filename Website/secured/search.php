<?php

$host = "localhost";
$port = "5432";
$dbname = "db_secure";
$user = "user_user";
$password = "12345";


// connection using pg_connect for PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error($conn));
}

$name = strtolower($_POST["name"]);

// Escape user input to prevent SQL injection
$name = pg_escape_string($conn, $name);

// ILIKE operator for ignoring uppercase
$query = "SELECT article.*, shop.name as shop_name FROM article JOIN shop ON article.shop_Id = shop.id WHERE article.name ILIKE $1";

$result = pg_prepare($conn, "login", $query);           // prepares the query named search
$result = pg_execute($conn, "login", array($name."%")); // executes the query search (name+% for ILIKE operator)

if (!$result) {
    echo "";
    exit; // Exit script if query fails
}

$output = "";

if (pg_num_rows($result) > 0) {
    $output .= "<div class='table-responsive'>";
    $output .= "<table class='table table-bordered table-striped'>";
    $output .= "<thead class='bg-primary'>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Shop</th>
                    </tr>
                </thead>
                <tbody>";

    // Loop through results and display article information
    while ($row = pg_fetch_assoc($result)) {
        $output .= "<tr>
                        <td>" . htmlspecialchars($row["name"]) . "</td>
                        <td>" . htmlspecialchars($row["brand"]) . "</td>
                        <td>" . htmlspecialchars($row["model"]) . "</td>
                        <td>" . htmlspecialchars($row["color"]) . "</td>
                        <td>" . htmlspecialchars($row["shop_name"]) . "</td>
                    </tr>";
    }

    $output .= "</tbody></table>";
    $output .= "</div>";
} else {
    $output = "<div class='alert alert-warning mt-2'>No article finded with name: '$name'.</div>";
}

echo $output;
pg_close($conn);
?>
