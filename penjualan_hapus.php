<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM penjualan WHERE idpenjualan='$id'");
$query = mysqli_query($koneksi, "DELETE FROM detailpenjualan WHERE idpenjualan='$id'");
if($query){
    echo '<script>alert("Hapus Data Berhasil"); location.href="?page=pembelian"</script>';
}else{
    echo '<script>alert("Hapus Data Gagal")</script>';
}

?>