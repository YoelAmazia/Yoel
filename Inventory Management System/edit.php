<?php
    session_start();
    include 'server.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $kategori = mysqli_query($conn, "SELECT *FROM category WHERE category_id = '".$_GET['idk']."' ");
    if(mysqli_num_rows($kategori) == 0){
        echo '<script>window.location="kategori.php"</script>';
    }
    $k = mysqli_fetch_object($kategori);    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vapology</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="home.php">VAPORLOGY</a></h1>
            <ul class="topnavbar">
                <li><a href="home.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="kategori.php">Kategori</a></li>
                <li><a href="product.php">Product</a></li>
                <li class="logout"><a href="logout.php">Log out</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Edit</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Category Name" class="input-control" value="<?php echo $k->category_name ?>" required>
                    <input type="submit" name="submit" value="Submit" class="btn2">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        $nama = ucwords($_POST['nama']);

                        $update = mysqli_query($conn, "UPDATE category SET 
                                    category_name = '".$nama."' 
                                    WHERE category_id = '".$k->category_id."'");
                    if($update){
                        echo '<script>alert("Edit Data Succesfully")</script>';
                        echo '<script>window.location="kategori.php"</script>'; 
                    }else{
                        echo'gagal' .mysqli_error($conn);
                    }
                    
                }   
                ?>
            </div>
        </div>
    </div>

    <!-- <footer>
        <div class="container">
            <small>Copyright &copy; 2021 - Vapology.</small>
        </div>
    </footer> -->
</body>
</html>