<?php
    $id = $_GET['id'];

    if (isset($_POST['namaproduk'])){
        $namaproduk = $_POST['namaproduk'];
        $harga = $_POST['harga'];
        $stock = $_POST['stok'];

        $query = mysqli_query($koneksi,"UPDATE produk set namaproduk='$namaproduk',harga='$harga',stok='$stock' WHERE idproduk='$id'");
        if($query){    
            echo '<script>alert("Ubah Data Berhasil")</script>';
        }else{
            echo '<script>alert("Ubah Data Gagal")</script>';
        }
    }

    $query = mysqli_query($koneksi,"SELECT*FROM produk WHERE idproduk=$id");
    $data  = mysqli_fetch_array($query);
?>

<div class="container-fluid px-4">
                        <h1 class="mt-4">Produk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                        <a href="?page=produk" class="btn btn-danger">Kembali</a>
                        <hr>
                        <form method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="200">Nama Produk</td>
                                    <td width="1">:</td>
                                    <td><input class="form-control" value="<?php echo $data['namaproduk'];  ?>" type="text" name="namaproduk"></td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td><input class="form-control" value="<?php echo $data['harga'];  ?>" step="0" type="text" name="harga"></td>
                                </tr>
                                <tr>
                                    <td>Stock</td>
                                    <td>:</td>
                                    <td><input class="form-control" type="number" step="0" value="<?php echo $data['stok'];  ?>"  name="stok"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        
                       
</div>