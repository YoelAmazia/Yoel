<?php
    session_start();
    include 'server.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    $product = mysqli_query($conn, "SELECT * FROM product WHERE product_id = '".$_GET['idp']."'");
    $p = mysqli_fetch_object($product)
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
                <li><a href="kategori.php">Category</a></li>
                <li><a href="product.php">Product</a></li>
                <li class="logout"><a href="logout.php">Log out</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>Edit Product</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- <select name="kategori" id="" class="input-control" required>
                        <option value="">--Choose--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value=""<?php echo $r['category_name'] ?> <?php echo ($r['category_id'] == $p->category_id)?'selected':'';?>><?php echo $r['category_name'] ?></option>

                        <?php } ?>
                        
                    </select> -->
                    <input type="text" name="nama" class="input-control" placeholder="Product Name" value="<?php echo $p->product_name ?>"  required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->product_price ?>" required>
                    <img src="product/<?php echo $p->product_image ?>" width="100px">
                    <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="input-control">
                    <textarea class="input-control" name="deskripsi" id="" placeholder="Deskripsi" cols="30" rows="10" ><?php echo $p->product_description ?></textarea><br>
                    <!-- <select name="" id="">
                        <option value="">---Choose--</option>
                        <option value="1">Aktif</option>
                        <option value="2">Tidak Aktif</option>
                    </select> -->
                    <input type="submit" name="submit" value="Submit" class="btn2">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        // data input form
                        $kategori = $_POST['kategori'];
                        $nama = $_POST['nama'];
                        $harga = $_POST['harga'];
                        $deskripsi = $_POST['deskripsi'];
                        $foto = $_POST['foto'];

                        //data gambar baru
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'product'.time().'.'.$type2;
                        
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                        //jika ganti gambar
                        if($filename != ''){

                            if(!in_array($type2, $tipe_diizinkan)){
                                echo '<script>alert("File Format Not Allowed")</script>' ;
                            }else{
                                unlink('./product/' .$foto);
                                move_uploaded_file($tmp_name, './product/'.$newname);
                                $namagambar = $newname;
                            }

                        }else{
                            $namagambar = $foto;
                        }

                        $update = mysqli_query($conn, "UPDATE product SET 
                                               category_id = '".$kategori."',
                                               product_name = '".$nama."',
                                               product_price = '".$harga."',
                                               product_description = '".$deskripsi."',
                                               product_image = '".$namagambar."'  
                                               WHERE product_id = '".$p->product_id."'");                    
                        if($update){
                            echo '<script>alert("Add Data Succes")</script>';
                            echo '<script>window.location="product.php"</script>';
                        }else{
                            echo 'Failed' .mysqli_error($conn);                                              
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