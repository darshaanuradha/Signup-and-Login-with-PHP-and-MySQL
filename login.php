<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $mysqli = require __DIR__ . "./database.php";
    $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $mysqli->real_escape_string($_POST['email']));
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
           session_start();
           session_regenerate_id();
           $_SESSION["user_id"]=$user["id"];
           header("Location:index.php");
           exit;
        }
    }
    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <title>signUp</title>
</head>

<body class="bg-light">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 98vh; min-width: 98vw">
        <div class="shadow-lg p-lg-5 p-md-4 p-3 rounded-2">
            <div class="container">
                <h5 class="bg-secondary p-2 text-center text-light rounded-2 shadow-sm">
                    Log In
                </h5>
                <?php 
                if($is_invalid):?>
                <div class="bg-danger text-light text-center p-0 rounded-2">Invalid Login</div>
                <?php endif ?>
                <form action="" method="post">

                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" 
                      />
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" />
                    </div>
                    <!-- htmlspecialchars($_POST["email"] ?? "" ); -->
                    
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-outline-primary mt-3 btn-sm">
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>