
<?php
        // Connessione al database
        $host = "localhost";
        $port = "5432";
        $dbname = "db_critic";
        $user = "admin_user";
        $password = "10293";

        $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

        if (!$conn) {
            header("Location: ./login.php?error=Connection+to+db+refused");
        } else {
            $username = $_POST['username'];
            $password_input = $_POST['password'];

            // Query preparata per evitare SQL injection
            $query = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password_input."' ";

            $result = pg_query($conn, $query);
            $row = pg_fetch_assoc($result);
            if (pg_num_rows($result) > 0) {
                session_start();
                $_SESSION["username"] = $row['username'];
                header("Location: ./search_articles.php");
                pg_close($conn);
                exit();
            } else{
                // login refused 
                pg_close($conn);
                header("Location: ./login.php?error=Username+or+password+are+wrong");
                exit();
            }
        }
    
        ?>
    </div>
    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
