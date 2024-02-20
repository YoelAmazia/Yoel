<?php
    session_start();
    include 'server.php';
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
    <title>Vapology</title>
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
            <h3>Add Product</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select name="kategori" id="" class="input-control" required>
                        <option value="">--Choose--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id DESC");
                            while($row = mysqli_fetch_array($kategori)){
                        ?>
                        <option value=""><?php echo $row['category_name'] ?></option>
                        <?php } ?>
                        
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Product Name" required>
                    <input type="text" name="harga" class="input-control" placeholder="Price" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <textarea class="input-control" name="deskripsi" id="" placeholder="Deskripsi" cols="30" rows="10"></textarea>
                    <!-- <select name="" id="">
                        <option value="">---Choose--</option>
                        <option value="1">Aktif</option>
                        <option value="2">Tidak Aktif</option>
                    </select> -->
                    <input type="submit" name="submit" value="Submit" class="btn2">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        // print_r($_FILES['gambar']);
                        $kategori = $_POST['kategori'];
                        $nama = $_POST['nama'];
                        $harga = $_POST['harga'];
                        $deskripsi = $_POST['deskripsi'];

                        // menyimpan data yg diupload
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'product'.time().'.'.$type2;

                        //format foto
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif', 'jfif');

                        if(!in_array($type2, $tipe_diizinkan)){
                            echo '<script>alert("File Format Not Allowed")</script>' ;
                        }else{
                            move_uploaded_file($tmp_name, './product/'.$newname);

                            $insert = mysqli_query($conn, "INSERT INTO product VALUES(
                                        null,
                                        '".$kategori."',
                                        '".$nama."',
                                        '".$harga."',
                                        '".$deskripsi."',
                                        '".$newname."',
                                        null
                            
                            )");

                        if($insert){
                            echo '<script>alert("Add Data Succes")</script>';
                            echo '<script>window.location="product.php"</script>';
                        }else{
                            echo 'Failed' .mysqli_error($conn);
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