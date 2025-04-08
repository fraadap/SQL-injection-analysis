<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/search.css">
        
</head>
<body>
    <div class="container mt-3">
        <?php
            session_start();
            if (($_SESSION['username'])){
                echo "<h1>Welcome ". $_SESSION['username']."</h1>";
            }else{
                header("Location: ./login.php");
                exit();
            }
        ?>
        <h1>Search Articles</h1>
        <div class="input-group mb-3">
            <input type="text" id="article_name" class="form-control" placeholder="Search articles by name..." aria-label="Articles' name">
        </div>
        <div id="results"></div>
    </div>

    <script>
        $(document).ready(function() {
            // Search on 'keyup' event using AJAX
            $("#article_name").on('keyup', function(event) {
                var name = $("#article_name").val();

                if (name) {
                    $.ajax({
                        url: "search.php",
                        method: "POST",
                        data: { name: name },
                        success: function(response) {
                            $("#results").html(response);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $("#results").html("<div class='alert alert-danger mt-2'>Error: " + textStatus + "</div>");
                        }
                    });
                } else {
                    $("#results").html("<div class='alert alert-warning mt-2'>Please start to digit an article name to search.</div>");
                }
            });
        });
    </script>
</body>
</html>
