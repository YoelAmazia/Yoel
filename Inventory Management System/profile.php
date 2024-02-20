<?php
    session_start();
    include 'server.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = '".$_SESSION['id']."'");
    $d = mysqli_fetch_object($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaporlogy</title>
    <link rel="stylesheet" href="home.css">
    
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="home.php">VAPORLOGY</a></h1>
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
            <h3>Profile</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                    <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $d->admin_telp ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_address ?>" required>
                    <input type="submit" name="submit" value="Change Profile" class="btn2">
                </form>
            <?php
                if(isset($_POST['submit'])){

                    $nama   = ucwords($_POST['nama']);
                    $user   = $_POST['user'];
                    $hp     = $_POST['hp'];
                    $email  = $_POST['email'];
                    $alamat = ucwords($_POST['alamat']);

                    $update = mysqli_query($conn, "UPDATE admin SET
                                    admin_name = '".$nama."',
                                    username = '".$user."',
                                    admin_telp = '".$hp."',
                                    admin_email = '".$email."',
                                    admin_address = '".$alamat."'
                                    WHERE admin_id = '".$d->admin_id."'
                                    ");
                    if($update){
                        echo '<script>alert("Change Data Succesful")</script>';
                        echo '<script>window.location="profile.php"</script>';
                    }else{
                        echo 'Gagal' .mysqli_error($conn);
                    }
                }
            ?>
            </div>
            <h3>Change Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="New Password" class="input-control" required>
                    <input type="pasword" name="pass2" placeholder="Confirm Password" class="input-control" required>
                    <input type="submit" name="Change_Password" value="Change Password" class="btn2">
                </form>
            <?php
                if(isset($_POST['Change_Password'])){

                    $pass1   = $_POST['pass1'];
                    $pass2     = $_POST['pass2'];

                    if($pass2 != $pass1){
                        echo '<script>alert("Confirm the new password does not match")</script>';
                    }else{
                        $update_password = mysqli_query($conn, "UPDATE admin SET
                                    password = '".md5($pass1)."'
                                    WHERE admin_id = '".$d->admin_id."'
                                    ");
                        if($update_password){
                            echo '<script>alert("Change Password Succesful")</script>';
                            echo '<script>window.location="profile.php"</script>';
                        }else{
                            echo 'Gagal' .mysqli_error($conn);
                        }
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