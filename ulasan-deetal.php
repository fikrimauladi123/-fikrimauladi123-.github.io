<?php require "header.php";
if (!isset($_SESSION["pelanggan"])) {
    /*     echo "<script>alert('Silahkan Login Dulu');</script>"; */
    echo "<script>location='login.php';</script>";
}
?>

<style>
    .row {
        margin-left: 0;
        margin-right: 0;
    }

    .row>[class^="col-"] {
        padding-left: 0;
        padding-right: 0;
    }

    /* 
        .row>[class^="col-sm-8"] {
            padding-right: 100px;
        } */

    /* .col-sm-8,
        .col-sm4 {
            padding: 0px;
        } */
    #containt {
        margin-top: 80px;
    }

    .itemBig,
    .item1,
    .item2,
    .item3 {
        border: none;
        background-color: silver;
    }

    .itemBig:hover,
    .item1:hover,
    .item2:hover,
    .item3:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
        border: none;
    }

    .star-rating li {
        padding: 0;
        margin: 0;
    }

    .star-rating i {
        font-size: 17px;
        color: #ffc000;
    }

    #btnDesc1 {
        padding: 12px 10px;
        width: 100%;
        border-radius: 0;
        color: white;
        background-color: #3498db;
        border-top: px solid #3498db;


    }

    #btnDesc1:hover,
    #btnDesc2:hover {
        background-color: rgb(83, 83, 83);
    }

    #btnDesc2 {
        padding: 10px 10px;
        width: 100%;
        border-radius: 0;
        color: white;
        background-color: silver;
        margin-top: 4px;
    }

    .dec {
        width: 100%;
        height: auto;
        border: 2px solid #3498db;
    }
</style>

<?php
$id_order = $_GET['id_order'];
$id = $_GET['id'];
$query = "SELECT * FROM tbl_produk WHERE id_produk='$id'";
$result = mysqli_query($db, $query);
$produk = mysqli_fetch_assoc($result);

?>

<div class="container bg-white rounded pt-4 pb-4" id="containt">
    <div class="row">
        <div class="col-md-5 col-sm-12">
            <div class="itemBig">
                <a href="admin/assets/images/foto_produk/<?php echo $produk['gambar']; ?>">
                    <img src="admin/assets/images/foto_produk/<?php echo $produk['gambar']; ?>" height="400px" width="100%">
                </a>
            </div>
        </div>
        <div class="col-md-7 col-sm-12 pt-3 pl-5">
            <h3><?php echo $produk['nm_produk']; ?></h3>

            <?php

            // Cek apakah ulasan dan rating sudah ada untuk produk dan pelanggan tertentu
            $id_produk = $produk['id_produk'];
            $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

            $resultUlasan = $db->query("SELECT * FROM ulasan WHERE id_produk='$id_produk' AND id_pelanggan='$id_pelanggan'AND id_order='$id_order'");
            $resultRating = $db->query("SELECT * FROM tbl_rating WHERE id_produk='$id_produk' AND id_pelanggan='$id_pelanggan'AND id_order='$id_order'");

            // Jika sudah ada ulasan dan rating, tampilkan pesan dan hentikan eksekusi form
            if ($resultUlasan->num_rows > 0 && $resultRating->num_rows > 0) {
                echo "<script>alert('Anda sudah memberikan rating dan ulasan untuk produk ini.');</script>";
                echo "<script>window.location.href = 'shop.php'</script>";
            } else {
                // Jika belum ada ulasan dan rating, tampilkan formulir
            ?>
                <div class="row">
                    <div class="row">
                        <form method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-sm-20">
                                    <div class="form-group">
                                        <input name="pelanggan" type="hidden" class="form-control" value="<?php echo $nm_pelanggan = $_SESSION['pelanggan']['nm_pelanggan']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <input name="id_pelanggan" type="hidden" class="form-control" value="<?php echo $id_pel = $_SESSION['pelanggan']['id_pelanggan']; ?>" readonly>
                            <input name="id_produk" type="hidden" class="form-control" value="<?php echo $produk['id_produk']; ?>" readonly>
                            <?php

                            $no = 1;
                            $sql = "SELECT * FROM tbl_detail_order d JOIN tbl_produk p ON d.id_produk=p.id_produk WHERE id_order = '$id_order'";
                            $query = mysqli_query($db, $sql);
                            while ($produk = mysqli_fetch_assoc($query)) {
                            ?>
                                <input name="id_order" type="hidden" class="form-control" value="<?php echo $produk['id_order']; ?>" readonly>
                            <?php } ?>
                            <input name="ulas" type="hidden" class="form-control" value="2" readonly>
                            <input name="nm_produk" type="hidden" class="form-control" value="<?php echo $produk['nm_produk']; ?>" readonly>
                            <label>Rating</label>
                            <div class="row">
                                <div class="col-sm-20">
                                    <div class="form-group">
                                        <div class="rating">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <span class="star" onclick="setRating(<?php echo $i; ?>)">
                                                    <i class="fa <?php echo ($i <= $_POST['rating']) ? 'fa-star' : 'fa-star-o'; ?>"></i>
                                                </span>
                                            <?php endfor; ?>
                                        </div>
                                        <input type="hidden" name="rating" id="rating" value="0">
                                    </div>
                                </div>
                            </div>

                            <label>Ulasan</label>
                            <div class="row">
                                <div class="col-sm-20">
                                    <div class="form-group">
                                        <textarea name="ulasan" type="text" class="form-control" required rows="5" cols="100" oninput="checkFormValidity()"></textarea>

                                    </div>
                                </div>
                            </div>

                            <button id="ulasButton" class="btn btn-secondary btn-sm btn-block" onclick="validate()" disabled>Ulas Produk</button>


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
                                                        "ulasan-order.php?id=<?php echo $id_order; ?>";
                                                };
                                            });
                                        } else {
                                            swal("Lakukan Konfirmasi Jika Produk Sudah Diterima");
                                        }
                                    });
                                }
                            </script>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php

            if (isset($_POST['ulasan'])) {
                $nm_pelanggan = $_SESSION['pelanggan']['nm_pelanggan'];
                $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                $id_produk = $_POST['id_produk'];
                $id_order = $_POST['id_order'];
                $nm_produk = $_POST['nm_produk'];
                $ulasan = $_POST['ulasan'];
                $rating = $_POST['rating'];

                // Sesuaikan query rating
                $db->query("INSERT INTO ulasan (pelanggan, id_produk,id_pelanggan,id_order, nm_produk, ulasan) VALUES ('$nm_pelanggan', '$id_produk', '$id_pelanggan','$id_order','$nm_produk', '$ulasan')");

                // Perbaiki query rating untuk memasukkan nilai rating yang benar
                $db->query("INSERT INTO tbl_rating (id_produk, id_pelanggan,id_order,  rating) VALUES ('$id_produk', '$id_pelanggan','$id_order','$rating')");

                $id = $_GET['id'];
                $query = "UPDATE tbl_order SET status='Sudah Ulas Produk' WHERE id_order='$id'";
                $result = mysqli_query($db, $query);

                // Menampilkan pesan jika data berhasil dimasukkan
                echo "<p class='alert alert-success' role='alert'>
                            Berhasil Menambahkan Ulasan Produk.
                            </p>";
                echo "<script>
            setTimeout(function() {
                window.location.href = 'shop.php';
            }, 1000); // 2000 milidetik (2 detik) delay sebelum mengarahkan
          </script>";
            }
            ?>
            <?php
            if (isset($_POST['ulas'])) {
                $ulas = $_POST['ulas'];

                $db->query("INSERT INTO tbl_detail_order (ulas) VALUES ('$ulas')");
                $id = $_GET['id'];
                $query = "UPDATE tbl_detail_order SET status='2' WHERE id_detail_order='$id'";
                $result = mysqli_query($db, $query);
            }
            ?>
            <script>
                function hideButton(x) {
                    x.style.display = 'none';
                }

                function checkFormValidity() {
                    var rating = document.getElementById('rating').value;
                    var ulasan = document.querySelector('textarea[name="ulasan"]').value;
                    // Ganti kondisi sesuai kebutuhan, misalnya rating > 0 dan ulasan tidak kosong
                    var isFormValid = (rating > 0 && ulasan.trim() !== '');

                    // Aktifkan atau nonaktifkan tombol berdasarkan kondisi
                    document.getElementById('ulasButton').disabled = !isFormValid;
                }
                // Panggil checkFormValidity untuk menetapkan status tombol saat halaman dimuat
                checkFormValidity();

                function setRating(rating) {
                    document.getElementById('rating').value = rating;

                    // Highlight the selected stars
                    for (let i = 1; i <= 5; i++) {
                        const star = document.querySelector('.star:nth-child(' + i + ')');
                        if (i <= rating) {
                            star.classList.add('selected');
                            star.innerHTML = '<i class="fa fa-star"></i>';
                        } else {
                            star.classList.remove('selected');
                            star.innerHTML = '<i class="fa fa-star-o"></i>';
                        }
                    }
                    // Periksa validitas form setelah rating berubah
                    checkFormValidity();
                }
            </script>
        </div>
        <?php require "footer.php"; ?>