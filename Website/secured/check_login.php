
        <?php
        // Connessione al database
        $host = "localhost";
        $port = "5432";
        $dbname = "db_secure";
        $user = "user_user";
        $password = "12345";

        $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

        if (!$conn) {
            header("Location: ./login.php?error=Connection+to+db+refused");
        } else {
            $username = $_POST['username'];
            $password_input = $_POST['password'];

            // Query preparata per evitare SQL injection
            $query = 'SELECT password FROM users WHERE username = $1';
            $result = pg_prepare($conn, "login", $query);           // prepares the query named login
            $result = pg_execute($conn, "login", array($username)); // executes the query login
            
            if ($row = pg_fetch_assoc($result)) {
                if (password_verify($password_input, $row['password'])){ // verifies the input password with the hashed one
                    session_start();
                    $_SESSION["username"] = htmlspecialchars($username);
                    pg_close($conn);
                    header("Location: ./search_articles.php");
                    exit();
                }
            }        
        }
        // login refused 
        pg_close($conn);
        header("Location: ./login.php?error=Username+or+password+are+wrong");
        exit();
        ?>
    </div>
    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
