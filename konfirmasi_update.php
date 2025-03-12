<?php require "header.php";

?>
<style>
    .banner .img {
        width: 100%;
        height: 250px;
        background-image: url('assets/img/4.jpg');
        padding: 0px;
        margin: 0px;
    }

    .img .box {
        height: 250px;
        background-color: rgb(41, 41, 41, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        color: white;
        padding-top: 70px;
    }

    .box a {
        color: #0066FF;
    }

    .box a:hover {
        text-decoration: none;
        color: rgb(6, 87, 209);
    }
</style>
<div class="banner mb-5">
    <div class="container-fluid img">
        <div class="container-fluid box">
            <h3>KONFIRMASI PEMBAYARAN</h3>
            <p>Home ><a href="#"> Konfirmasi Pembayaran</a></p>
        </div>
    </div>
</div>
<div class="containt">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>
                            Form Konfirmasi Pembayaran
                        </h4>
                        <p>Mohon untuk melengkapi data di bawah ini untuk melakukan konfirmasi</p>
                        <?php

                        $id = $_GET['id'];
                        $query = "SELECT * FROM tbl_pembayaran WHERE id_pembayaran='$id'";
                        $result = mysqli_query($db, $query);
                        $data = mysqli_fetch_assoc($result);

                        if (isset($_POST['kirim'])) {
                            $nama = $_POST['nama'];
                            $bank = $_POST['nmBank'];
                            $jml = $_POST['jml_transfer'];
                            $id_order = $_POST['id_order'];
                            $tgl = date('Y-m-d');
                            $nmGambar = $_FILES['gambar']['name'];
                            $lokasi = $_FILES['gambar']['tmp_name'];

                            if ($jml != $data['jml_pembayaran']) {
                                echo "<script type='text/javascript'>swal('Gagal', 'Jumlah Yang Anda Bayarkan Tidak Sesuai', 'error');</script>";
                            } elseif (!empty($lokasi)) //Jika temporari tidak kosong 
                            {
                                //memindah file gambar dari file temporari ke folder assets/img/bukti-transfer/
                                move_uploaded_file($lokasi, "assets/img/bukti-transfer/" . $nmGambar);
                                //Memasukkan data ke tabel tbl_produk
                                $query = "UPDATE tbl_pembayaran 
                                SET nm_pembayar='$nama', nm_bank='$bank',jml_pembayaran='$jml', tgl_bayar='$tgl', bukti_transfer='$nmGambar'
                                WHERE id_pembayaran='$id'";
                                $exec = mysqli_query($db, $query);

                                //ubah status orderan
                                $qupdate = "UPDATE tbl_order SET status='Menunggu Konfirmasi Pembayaran' WHERE id_order='$id_order'";
                                $qresult = mysqli_query($db, $qupdate);

                                //Menampilkan pesan jika data berhasil di masukkan
                                echo "<script type='text/javascript'>
                                            swal({
                                                title: 'Berhasil Konfirmasi',
                                                text: 'Produk Segera Kami Persiapkan Untuk Dikirim',
                                                icon: 'success',
                                                button: false
                                            });
                                            </script>";
                                echo "<meta http-equiv='refresh' content='1;url=orderan.php'>";
                            } else //jika temporari kosong
                            {
                                //Menampilkan pesan jika gambar belum dimasukkan
                                echo "<p class='alert alert-danger' role='alert'>
                                        [Error] Upload Gambar Gagal.<br />
                                        </p>";
                            }
                        };
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id_order" value="<?php echo $data['id_order']; ?>" required="required">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Nama Pembayar</label>
                                <input type="text" class="form-control" name="nama" onkeyup="isi_otomatis()" value="<?php echo $data['nm_pembayar']; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Nama Bank</label>
                                <input type="text" class="form-control" name="nmBank" required="required" value="<?php echo ($data['nm_bank']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="Jumlah Tranfer" class="font-weight-bold">Jumlah Tranfer</label>
                                <input type="number" class="form-control" name="jml_transfer" value="<?php echo ($data['jml_pembayaran']); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <img src="assets/img/bukti-transfer/<?php echo ($data['bukti_transfer']); ?>" width="100px" height="100px"><br>
                                <label for="" class="font-weight-bold">Bukti Transfer</label>
                                <input type="file" class="form-control-file" name="gambar" >
                            </div>
                            <button class="btn btn-secondary pull-right pl-5 pr-5" name="kirim">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body alert-secondary">
                        <p>Jumlah yang harus di bayar :</p>
                        <h1>Rp. <?php echo number_format($data['jml_pembayaran']); ?></h1>
                    </div>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script type="text/javascript">
                function isi_otomatis() {
                    var nama = $("#nama").val();
                    $.ajax({
                        url: 'ajax.php',
                        data: "nama=" + nama,
                    }).success(function(data) {
                        var json = data,
                            obj = JSON.parse(json);
                        $('#nmBank').val(obj.nmBank);
                        $('#jml_transfer').val(obj.jml_transfer);
                    });
                }
            </script>
        </div>
    </div>
</div>
<?php require "footer.php"; ?>