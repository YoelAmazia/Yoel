<?php
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WR Bu Yuli</title>
    <link rel="stylesheet" href="home.css">

</head>
<body>
    <header>
        <div class="container">
            <h1><a href="home.php">WR Bu Yuli</a></h1>
            <ul class="topnavbar">
                <li><a href="home.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="kategori.php">Category</a></li>
                <li><a href="product.php">Product</a></li>
                <li class="logout"><a href="logout.php">Log out</a></li>
            </ul>
        </div>
        
    </header>

    <div class="section">
        <div class="container">
            <h3>Dashbord Admin</h3>
            <div class="box">
                <h4>Welcome <?php echo $_SESSION['a_global']->admin_name ?></h4>
            </div>
</div>
    </div>
    <!-- <script src="script.js"></script> -->
    <!-- <footer>
        <div class="container">
            <small>Copyright &copy; 2021 - Vapology.</small>
        </div>
    </footer> -->
</body>
</html>