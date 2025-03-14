<?php require "header.php"; ?>

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
$id = $_GET['id'];
$query = "SELECT * FROM tbl_produk WHERE id_produk='$id'";
$result = mysqli_query($db, $query);
$produk = mysqli_fetch_assoc($result);
?>
<?php
$id = $_GET['id'];
$query = "SELECT COALESCE(SUM(rating), 0) as total_rating, COALESCE(COUNT(rating), 0) as jumlah_rating
            FROM tbl_rating WHERE id_produk='$id'";
$result = mysqli_query($db, $query);
$produkul = mysqli_fetch_assoc($result);

$average_rating = ($produkul['jumlah_rating'] > 0) ? $produkul['total_rating'] / $produkul['jumlah_rating'] : 0;

// Mengatur jumlah bintang sesuai dengan rentang rating (termasuk untuk rating 0)
$num_full_stars = 0;
$num_empty_stars = 0;
if ($average_rating == 0) {
    $num_empty_stars = 5;
} elseif ($average_rating < 1.4) {
    $num_full_stars = 1;
    $num_empty_stars = 4;
} elseif ($average_rating < 2.5) {
    $num_full_stars = 2;
    $num_empty_stars = 3;
} elseif ($average_rating < 3.5) {
    $num_full_stars = 3;
    $num_empty_stars = 2;
} elseif ($average_rating < 4.5) {
    $num_full_stars = 4;
    $num_empty_stars = 1;
} else {
    $num_full_stars = 5;
}
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
            <div class="star-rating">
                <ul class="list-inline text-warning">
                    <?php
                    // Menampilkan bintang penuh sesuai dengan jumlah yang telah ditentukan
                    if ($num_empty_stars == 5) {
                        for ($i = 0; $i < 5; $i++) {
                    ?>
                            <li class="list-inline-item m-0"><i class="fa fa-star-o"></i></li>
                        <?php
                        }
                    } else {
                        for ($i = 0; $i < $num_full_stars; $i++) {
                        ?>
                            <li class="list-inline-item m-0"><i class="fa fa-star"></i></li>
                        <?php
                        }
                        // Menampilkan bintang kosong sesuai dengan jumlah yang telah ditentukan
                        for ($i = 0; $i < $num_empty_stars; $i++) {
                        ?>
                            <li class="list-inline-item m-0"><i class="fa fa-star-o"></i></li>
                    <?php
                        }
                    }
                    ?>
                    <li class="list-inline-item m-0"> <span style="color: black;">
                            <p><?php echo number_format($average_rating, 1); ?></p>
                        </span></li>
                </ul>
                paket yang dibeli berbobt 5 kg dalam satu produk.

            </div>
            <hr>
            <h3 class="text-danger"><span class="text-secondary" style="font-size: 20px">Harga :
                </span>Rp. <?php echo number_format($produk['harga']); ?><span style="color:black;">  /5kg</span></h3>
            <br>
            <h3 class="text-danger"><span class="text-secondary" style="font-size: 20px">Diskon :
                </span>Rp. <?php echo number_format($produk['diskon']); ?></h3>
            <br>
            <h3 class="text-danger"><span class="text-secondary" style="font-size: 20px">Tgl Panen :
                </span> <?php echo ($produk['tgl_panen']); ?></h3>
            <br>

            <p class="text-secondary font-weight-bold"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                Stok Tersedia</p>
            <p class="text-danger">Tersisa <?php echo number_format($produk['stok']); ?> Paket</p>

            <form method="post">
                <div class="row">
                    <div class="col-3">
                        <h3><span class="text-secondary" style="font-size: 15px">Jumlah : </span></h3>
                        <!-- <input id="demo0" type="text" value="1" name="demo0" data-bts-min="1"
                                data-bts-max="<?php echo $produk['stok']; ?>" class="text-center" /> -->
                        <div class="input-group spinner">
                            <button type="button" class="btn btn-secondary btn-number pl-2 pr-2" style="border-radius: 5px 0 0 5px;" id="minus-btn">
                                <i class="fa fa-minus"></i>
                            </button>
                            <input type="text" name="stok" id="qty_input" class="form-control input-number text-center" value="1" min="1" max="<?php echo $produk['stok']; ?>">
                            <button type="button" class="btn btn-secondary btn-number pl-2 pr-2" style="border-radius: 0 5px 5px 0;" id="plus-btn"><i class="fa fa-plus"></i>
                            </button>
                            <script>
                                $(function() {
                                    $('.spinner #plus-btn').on('click', function() {
                                        var btn = $(this);
                                        var input = btn.closest('.spinner').find('input');
                                        if (input.attr('max') == undefined || parseInt(input
                                                .val()) <
                                            parseInt(input.attr('max'))) {
                                            input.val(parseInt(input.val(), 10) + 1);
                                        } else {
                                            btn.next("disabled", true);
                                        }
                                    });
                                    $('.spinner #minus-btn').on('click',
                                        function() {
                                            var btn = $(this);
                                            var input = btn.closest('.spinner').find('input');
                                            if (input.attr('min') == undefined || parseInt(input
                                                    .val()) >
                                                parseInt(input.attr('min'))) {
                                                input.val(parseInt(input.val(), 10) - 1);
                                            } else {
                                                btn.prev("disabled", true);
                                            }
                                        });
                                })
                            </script>
                        </div>
                    </div>
                </div>
                <?php if ($produk['stok'] == 0) {
                    echo '<div class="row mt-4">
                    <div class="col-md-5">
                        <button class="btn btn-secondary btn-block" name="beli" disabled title="produk habis">
                            <i class="fa fa-shopping-basket" aria-hidden="true"></i> Produk Habis
                        </button>
                    </div>';
                } else {
                    echo '<div class="row mt-4">
                    <div class="col-md-5">
                        <button class="btn btn-secondary btn-block" name="beli">
                            <i class="fa fa-shopping-basket" aria-hidden="true"></i> Masukkan Keranjang
                        </button>
                    </div>';
                }
                ?>
                <?php if ($produk['stok'] == 0) {
                    echo '<div class="row mt-9">
                    <div class="col-md-17">
                        <button class="btn btn-secondary btn-block ml-3" name="beli2" disabled title="produk habis">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Produk Habis
                        </button>
                    </div>';
                } else {
                    echo '<div class="row mt-9">
                    <div class="col-md-17">
                        <button class="btn btn-secondary btn-block ml-3" name="beli2">
                            <i class="fa fa-shopping-basket" aria-hidden="true"></i> Beli Sekarang
                        </button>
                    </div>';
                }
                ?>
                
                
                <!-- <div class="col-md-5">
                    <button class="btn btn-secondary btn-block ml-3" name="beli2">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Beli Sekarang
                    </button>
                </div> -->
        </div>
        </form>
    </div>

    <?php
    if (isset($_POST['beli'])) {
        $jumlah = $_POST['stok'];

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] += $jumlah;
        } else {
            $_SESSION['cart'][$id] = $jumlah;
        }
        echo "<script type='text/javascript'>swal('','Produk Sudah Masuk Ke Keranjang Belanja', 'success');</script>";
    } elseif (isset($_POST['beli2'])) {
        $jumlah = $_POST['stok'];

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] += $jumlah;
        } else {
            $_SESSION['cart'][$id] = $jumlah;
        }
        echo "<script>location='cart.php';</script>";
    }
    ?>
</div>
<br>
<hr>
<div class="ProdukDesc">
    <div class="row mt-3">
        <div class="btn btn-secondary btn-block">
            <button class="btn" id="btnDesc1">DESCRIPTIONS</button>
        </div>
        <!-- <div class="col-md-2">
                <button class="btn text-light" id="btnDesc2">FEEDBACKS</button>
            </div> -->
    </div>
    <div class="row">
        <div class="col-md-12 bg-light">
            <div class="dec pt-5 pl-5 pr-5 text-justify">
                <h5>Spesifikasi Dan Deskripsi Produk Hasil Pertanian :</h5>
                <?php echo $produk['deskripsi']; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 bg-light">
            <div class="dec pt-5 pl-5 pr-5 text-justify">
                <h5>Ulasan Pembeli:</h5>
                <?php
                $query = "SELECT * FROM ulasan where id_produk='$id'";
                $result = mysqli_query($db, $query);
                while ($produkul = mysqli_fetch_array($result)) {

                ?>
                    <div class="col-md-4 col-sm-12 ">

                        <h5><?php echo $produkul['pelanggan'] ?></h5>
                        <p><?php echo $produkul['ulasan']; ?></p>
                        <hr align="center">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>

<?php require "footer.php"; ?>