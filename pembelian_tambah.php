<?php
    if (isset($_POST['idpelanggan'])){

        $idpelanggan = $_POST['idpelanggan'];
        $produk = $_POST['produk'];
        $total = 0;
        $tanggal = date('Y/m/d');

        $query = mysqli_query($koneksi,"INSERT INTO penjualan(tanggalpenjualan,idpelanggan) VALUES('$tanggal','$idpelanggan')");
        
        $idTerakhir = mysqli_fetch_array(mysqli_query($koneksi,"SELECT*FROM penjualan ORDER BY idpenjualan DESC"));
        $idpenjualan = $idTerakhir['idpenjualan'];

        foreach($produk as $key=>$val){
            $pr = mysqli_fetch_array(mysqli_query($koneksi,"SELECT*FROM produk WHERE idproduk=$key"));
            if($val >0 ){
                $sub = $val * $pr['harga'];
                $total += $sub;
                $query = mysqli_query($koneksi,"INSERT INTO detailpenjualan
                (idpenjualan,idproduk,jumlahproduk,subtotal) VALUES('$idpenjualan','$key','$val','$sub')");

                $updatestock = mysqli_query($koneksi,"UPDATE produk SET stok=stok-$val WHERE idproduk=$key");
            }
        }
        $query = mysqli_query($koneksi,"UPDATE penjualan SET totalharga=$total WHERE idpenjualan=$idpenjualan");
        
        if($query){
            echo '<script>alert("Tambah Data Berhasil")</script>';
        }else{
            echo '<script>alert("Tambah Data Gagal")</script>';
        }
    }
?>

<div class="container-fluid px-4">
                        <h1 class="mt-4">Pembelian</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"> Menu Pembelian</li>
                        </ol>
                        <a href="?page=pembelian" class="btn btn-danger">Kembali</a>
                        <hr>
                        <form method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="200">Nama Pelanggan</td>
                                    <td width="1">:</td>
                                    <td>
                                        <select class="form-control form-select" name="idpelanggan">
                                            <?php
                                                $p = mysqli_query($koneksi,"SELECT*FROM pelanggan");
                                                while($pel = mysqli_fetch_array($p)){
                                                   ?>
                                                   <option value="<?php echo $pel['idpelanggan']; ?>"><?php echo $pel['namapelanggan']; ?></option>
                                                   <?php 
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                                    $prod = mysqli_query($koneksi,"SELECT*FROM produk");
                                    while($produk = mysqli_fetch_array($prod)){
                                ?>
                                <tr>
                                    <td><?php echo $produk['namaproduk'] . '(stok :'.$produk['stok'].' )'; ?></td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control" type="number" 
                                        step="0" value="0" max="<?php echo $produk['stok']; ?>" name="produk[<?php echo $produk['idproduk']; ?>]"></td>
                                </tr>
                                <?php
                                    }
                                ?>
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