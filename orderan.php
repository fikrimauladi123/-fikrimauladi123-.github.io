<?php require "header.php";

if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan Login Dulu');</script>";
    echo "<script>location='login.php';</script>";
}
$id = $_SESSION['pelanggan']['id_pelanggan'];
$query2 = "SELECT * FROM tbl_order WHERE id_pelanggan='$id'";
$result2 = mysqli_query($db, $query2);
$dta = mysqli_fetch_assoc($result2);
if (!$dta) {
    echo "<script type='text/javascript'>
        swal({
            title: 'Orderan Kosong',
            text: 'Silahkan Melakukan Pembelian Dulu !',
            icon: 'warning',
            dangerMode: true,
        }).then(okay => {
            if (okay) {
            window.location.href ='shop.php';
            };
        });
        </script>";
}
?>


<style>
    .banner .img {
        width: 100%;
        height: 250px;
        background-image: url('assets/img/sawah.jpg');
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
<div class="banner mb-3">
    <div class="container-fluid img">
        <div class="container-fluid box">
            <h3>RIWAYAT ORDERAN</h3>
            <p>Home ><a href="#"> Orderan</a></p>
        </div>
    </div>
</div>

<div class="container bg-white rounded pb-4 pt-4">
    <div class="row">
        <div class="col-md-12">
            <table id="datatable" class="table table-striped dt-responsive nowrap table-vertical" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th class="text-center">Status</th>
                        <th>Total Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = "SELECT * FROM tbl_order WHERE id_pelanggan='$id'";
                    $result = mysqli_query($db, $query);
                    while ($data = mysqli_fetch_assoc($result)) {
                        $tgl = $data['tgl_order'];
                        $status = $data['status'];
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo date("F d, Y", strtotime($tgl)); ?></td>
                            <td>
                                <?php
                                $id_order =  $data['id_order'];
                                $query2 = "SELECT SUM(jml_order) AS jml FROM tbl_detail_order WHERE id_order='$id_order'";
                                $result2 = mysqli_query($db, $query2);
                                $data2 = mysqli_fetch_assoc($result2);
                                echo $data2['jml'];
                                ?> Produk | <a href="rincian-produk.php?id=<?php echo $id_order; ?>" class="badge badge-info">Lihat</a>
                            </td>
                            <td class="text-center">
                                <?php
                                if ($status == 'Belum Dibayar') {
                                    echo "<span class='badge badge-danger'>" . $status . "</span>";
                                } elseif ($status == 'Menunggu Konfirmasi Pembayaran') {
                                    echo "<span class='badge badge-warning'>" . $status . "</span>";
                                } elseif ($status == 'Jumlah Pembayaran Tidak Sesuai') {
                                    echo "<span class='badge badge-danger'>" . $status . "</span>";
                                } elseif ($status == 'Pembayaran Diterima') {
                                    echo "<span class='badge badge-primary'>" . $status . "</span>";
                                } elseif ($status == 'Menyiapkan Produk') {
                                    echo "<span class='badge badge-warning'>" . $status . "</span>";
                                } elseif ($status == 'Produk Dikirim') {
                                    echo "<span class='badge badge-primary'>" . $status . "</span> </br>";
                                    // echo "<span style='font-size: small;'>Resi: " . $data['no_resi'] . "</span>";
                                } elseif ($status == 'Produk Diterima') {
                                    echo "<span class='badge badge-success'>" . $status . "</span>";
                                } elseif ($status == 'Sudah Ulas Produk') {
                                    echo "<span class='badge badge-danger'>" . $status . "</span>";
                                }
                                ?>
                            </td>

                            <td>Rp. <?php echo number_format($data['total_order']) ?></td>
                            <td class="text-left">
                                <?php if ($data['status'] == 'Belum Dibayar') { ?>
                                    <a href="konfirmasi-pembayaran.php?id=<?php echo $id_order; ?>" class="btn btn-dark btn-sm">Konfirmasi Pembayaran</a>
                                <?php } elseif ($data['status'] == 'Jumlah Pembayaran Tidak Sesuai' || $data['status'] == 'Jumlah Pembayaran Tidak Sesuai') { ?>
                                    <?php
                                    // Fetch id_pembayaran associated with id_order
                                    $query_pembayaran = "SELECT id_pembayaran FROM tbl_pembayaran WHERE id_order='$id_order'";
                                    $result_pembayaran = mysqli_query($db, $query_pembayaran);
                                    $data_pembayaran = mysqli_fetch_assoc($result_pembayaran);
                                    $id_pembayaran = $data_pembayaran['id_pembayaran'];
                                    ?>
                                    <a href="konfirmasi_update.php?id=<?php echo $id_pembayaran; ?>" class="btn btn-warning btn-sm">Upload Ulang</a>
                                    <a href="https://api.whatsapp.com/send?phone=+6289611471404&text=Hai%20saya+ingin+Konfirmasi+Ulang" target="_blank" class="btn btn-dark btn-sm">Konfirmasi Ulang Pembayaran</a>


                                <?php } elseif ($data['status'] == 'Pembayaran Diterima' || $data['status'] == 'Menyiapkan Produk') { ?>
                                    <a href="nota-order.php?id=<?php echo $id_order; ?>" class="btn btn-warning btn-sm">Nota</a>
                                <?php } elseif ($data['status'] == 'Produk Dikirim') { ?>
                                    <a href="nota-order.php?id=<?php echo $id_order; ?>" class="btn btn-secondary btn-sm">Nota</a>
                                    <button class="btn btn-danger btn-sm" onclick="validate();">Pesanan Diterima</button>
                                    <!-- <a href="konfirmasi-barang.php?id=<?php echo $id_order; ?>" class="btn btn-danger btn-sm konfirmasi">Konfirmas Barang Diterima</a> -->
                                    <script>
                                        function validate() {
                                            swal({
                                                title: "Konfirmasi!",
                                                text: "Apakah Anda Ingin Mengkonfirmasi Produk ?",
                                                icon: "warning",
                                                buttons: true,
                                                dangerMode: true,
                                            }).then((willDelete) => {
                                                if (willDelete) {
                                                    swal({
                                                        title: "Konfirmasi!",
                                                        text: "Terimakasih Sudah Melakukan Konfirmasi",
                                                        icon: "success",
                                                    }).then(okay => {
                                                        if (okay) {
                                                            window.location.href =
                                                                "konfirmasi-barang.php?id=<?php echo $id_order; ?>";
                                                        };
                                                    });
                                                } else {
                                                    swal("Lakukan Konfirmasi Jika Produk Sudah Diterima");
                                                }
                                            });
                                        }
                                    </script>
                                <?php } elseif ($data['status'] == 'Produk Diterima') { ?>
                                    <a href="nota-order.php?id=<?php echo $id_order; ?>" class="btn btn-success btn-sm">Nota</a>
                                    <?php
                                    // Check if there is an existing review for the current order
                                    $check_review_query = "SELECT * FROM ulasan WHERE id_order='$id_order'";
                                    $check_review_result = mysqli_query($db, $check_review_query);

                                    if (mysqli_num_rows($check_review_result) > 0) {
                                        // If a review exists, show "Ulas" button
                                    ?>
                                        <a href="ulasan-order.php?id=<?php echo $id_order; ?>" class="btn btn-danger btn-sm">Ulas</a>
                                    <?php
                                    } else {
                                        // If no review exists, show the regular "Ulas Produk" button
                                    ?>
                                        <a href="ulasan-order.php?id=<?php echo $id_order; ?>" class="btn btn-danger btn-sm">Ulas Produk</a>
                                    <?php
                                    }
                                    ?>
                                <?php } elseif ($data['status'] == 'Sudah Ulas Produk' || $data['status'] == 'Sudah Ulas Produk') { ?>
                                    <a href="nota-order.php?id=<?php echo $id_order; ?>" class="btn btn-warning btn-sm">Nota</a>
                                <?php }
                                ?>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require "footer.php"; ?>