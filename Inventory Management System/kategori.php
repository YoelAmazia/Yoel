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
    <title>WR Bu Yuli</title>
    <link rel="stylesheet" href="category.css">
    
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
            <h3>Category</h3>
            <br>
            <div class="box">
                <button class="btn2"><a href="add-category.php">Add Categories</a></button>
                <!-- <p><a href="add-category.php">Add Category</a></p> -->
                <br>
                <br>
                <table class="table" border="1" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Category</th>
                            <th width="150px">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $kategori = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id DESC");
                            while($row= mysqli_fetch_array($kategori)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><button class="btn"><a href="edit.php?idk=<?php echo $row['category_id'] ?>">Edit</a></button> 
                            <br>
                            <button class="btn1"><a href="delete.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Sure You Want Delete ?')">Delete</a></button></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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