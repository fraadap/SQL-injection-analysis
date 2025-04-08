<?php

// DB sicurezza
$host = "localhost";
$port = "5432";
$dbname = "db_critic";
$user = "admin_user";
$password = "10293";

// connection using pg_connect for PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error($conn));
}

// Get username from POST request
$name = $_POST["name"];

// Build the query with LIKE operator
$sql = "SELECT article.*, shop.name as shopname FROM article JOIN shop on article.shop_id = shop.id WHERE article.name ILIKE '$name%'";

// Perform the query and handle potential errors
$result = pg_query($conn, $sql);

if (!$result) {
    echo "<div class='alert alert-danger mt-2'>Errore durante l'esecuzione della query.</div>";
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
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["brand"] . "</td>
                        <td>" . $row["model"] . "</td>
                        <td>" . $row["color"] . "</td>
                        <td>" . $row["shopname"] . "</td>
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
