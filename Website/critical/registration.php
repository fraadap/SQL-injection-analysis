<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
        <form action="check_registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                <i class="fas fa-envelope"></i>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="street" name="street" placeholder="Street" required>
                <i class="fas fa-road"></i>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="number" name="number" placeholder="Number" required>
                <i class="fas fa-home"></i>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                <i class="fas fa-city"></i>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <?php
            if (isset($_GET["error"])) {
                $errorMessage = $_GET['error'];
                echo "<p style='color:red'>" . $errorMessage . "</p>";
            }
        ?>
    </div>
</body>
</html>
