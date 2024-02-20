<?php
    include 'server.php';

    if(isset($_GET['idk'])){
        $delete = mysqli_query($conn, "DELETE FROM  category WHERE category_id = '".$_GET['idk']."' ");
        echo '<script>window.location="kategori.php"</script>';
    }

    if(isset($_GET['idp'])){
        $product = mysqli_query($conn, "SELECT product_image FROM product WHERE product_id = '".$_GET['idp']."'");
        $p = mysqli_fetch_object($product);

        // unlink('./product'.$p->product_image);

        $delete = mysqli_query($conn, "DELETE FROM  product WHERE product_id = '".$_GET['idp']."' ");
        echo '<script>window.location="product.php"</script>';
    }
?>