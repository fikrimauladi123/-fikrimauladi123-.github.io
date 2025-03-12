<?php require "koneksi.php"; 
$id=$_GET['id'];
$query="UPDATE tbl_detail_order SET ulas='2' WHERE id_detail_order='$id'";
$result=mysqli_query($db,$query); 

echo "<script>location='shop.php';</script>";
echo "UL";
?>