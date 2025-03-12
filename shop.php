<?php require "header.php"; ?>
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
        color: gray;
    }

    .box a:hover {
        text-decoration: none;
        color: rgb(6, 87, 209);
    }


    .atas .card {
        padding: 1px;
        border: 1px solid silver;
    }

    .atas .card:hover {
        border: none;
    }

    .item:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.4);
    }
</style>

<div class="banner mb-5">
    <div class="container-fluid img">
        <div class="container-fluid box">
            <h3>SHOP</h3>
            <p>Home > <a href="#">Shop</a></p>
        </div>
    </div>
</div>
<div class="col text-center">
                <h3><span class="text-secondary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Produk yang di beli berbobot 5kg dalam satu Paket</h3>
            </div>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-4 col-xl-3">
            <div class="card pb-3">
                <div class="card-body" style="padding-bottom: 3px;">
                    <form class="form-group" method="GET" action="shop.php">
                        <!-- <h5>Cari:</h5> -->
                        <input class="form-control" width="100%" type="search" name="search" placeholder="Search">
                        <!-- <input type="submit" value="Cari" class="btn btn-secondary"> -->
                    </form>

                    <hr class="text-center" width="80%">
                    <h5>Kategori:</h5>
                    <style>
                        .hide {
                            list-style: none;
                        }
                    </style>
                     <a href="shop.php" style="text-decoration: none;" class="text-secondary ml-3" name="kategori">Semua Kategori</a><br>
                    <?php
                    $qkat = "SELECT * FROM tbl_kat_produk";
                    $reskat = mysqli_query($db, $qkat);
                    while ($dat = mysqli_fetch_assoc($reskat)) {
                    ?>
                        <a href="shop.php?kategori=<?php echo $dat['id_kategori'] ?>" style="text-decoration: none;" class="text-secondary ml-3" name="kategori"><?php echo $dat['nm_kategori'] ?></a><br>
                    <?php } ?>
                    
                </div>
                
            </div>
            <!-- <div class="card pb-3">
                <div class="card-body" style="padding-bottom: 3px;">
                    Tanyakan produk yang tidak ada di sini.
                    
                                    <a href="https://api.whatsapp.com/send?phone=+6289611471404&text=Hai%20saya+ingin+menanyakan+produk?" target="_blank" class="btn btn-secondary btn-sm">tanyakan sesuatu</a>
                    
                </div>
                
            </div> -->
            
            
        </div>
        <div class="col-md-12 col-lg-8 col-xl-9">
            <div class="row">
                <div class="col-md-12 pl-5 text-secondary">
                    <?php
                    if (isset($_GET['kategori'])) {
                        $cari = $_GET['kategori'];
                        $query2 = "SELECT * FROM tbl_kat_produk WHERE id_kategori='$cari'";
                        $results = mysqli_query($db, $query2);
                        $data = mysqli_fetch_assoc($results);
                        echo "<h4><i>Kategori : " . $data['nm_kategori'] . "</i></h4>";
                    }
                    ?>

                </div>
            </div>
            <div class="row">

                <?php
                // ...

                // Query untuk menampilkan semua produk
                $queryAllProducts = "SELECT p.id_produk, p.nm_produk, p.harga, p.diskon, p.gambar, COALESCE(SUM(r.rating), 0) as total_rating, COALESCE(COUNT(r.rating), 0) as jumlah_rating
              FROM tbl_produk p
              LEFT JOIN tbl_rating r ON p.id_produk = r.id_produk
    GROUP BY p.id_produk";
                // Cek jika tidak ada parameter pencarian atau filter kategori
                if (!isset($_GET['search']) && !isset($_GET['kategori'])) {
                    $resultAllProducts = $db->query($queryAllProducts);

                    if ($resultAllProducts->num_rows > 0) {
                        while ($produk = $resultAllProducts->fetch_assoc()) {
                            $average_rating = ($produk['jumlah_rating'] > 0) ? $produk['total_rating'] / $produk['jumlah_rating'] : 0;

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
                            <div class="mb-0 p-1 col-md-6 col-lg-4 col-xl-3">
                                <div class="item card">
                                    <div class="thumnail">
                                        <img src="admin/assets/images/foto_produk/<?php echo $produk['gambar']; ?>" width="160" height="160" alt="img" class="card-img-top pt-2">
                                        <div class="star-rating" style="position: absolute; top:7px; right: 10px; font-size: 10px;">
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
                                                <li class="list-inline-item m-0"><span style="color: black;">
                                                        <p><?php echo number_format($average_rating, 1); ?></p>
                                                    </span></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <strong><?php echo $produk['nm_produk']; ?> </strong></br>
                                        <h6 class="text-danger">Rp. <?php echo number_format($produk['harga']); ?> <span style="color:black;">/5kg</span> </h6> 
                                        <h6 class="text-danger">Diskon Rp. <?php echo number_format($produk['diskon']);  ?></h6>
                                        <a href="detail-produk.php?id=<?php echo $produk['id_produk']; ?>" class="btn btn-secondary btn-sm btn-block">Lihat Produk</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "Tidak ada produk yang ditemukan.";
                    }
                } else {
                    // Handle pencarian produk
                    if (isset($_GET['search'])) {
                        // Lakukan pencarian
                        $search = $db->real_escape_string($_GET['search']);
                        $querySearch = "SELECT p.id_produk, p.nm_produk, p.harga, p.diskon, p.gambar, COALESCE(SUM(r.rating), 0) as total_rating, COALESCE(COUNT(r.rating), 0) as jumlah_rating
              FROM tbl_produk p
              LEFT JOIN tbl_rating r ON p.id_produk = r.id_produk
              WHERE nm_produk LIKE '%$search%'
              GROUP BY p.id_produk";

                        $resultSearch = $db->query($querySearch);

                        if ($resultSearch->num_rows > 0) {
                            while ($produk = $resultSearch->fetch_assoc()) {
                                $average_rating = ($produk['jumlah_rating'] > 0) ? $produk['total_rating'] / $produk['jumlah_rating'] : 0;

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
                                <div class="mb-0 p-1 col-md-6 col-lg-4 col-xl-3">
                                    <div class="item card">
                                        <div class="thumnail">
                                            <img src="admin/assets/images/foto_produk/<?php echo $produk['gambar']; ?>" width="160" height="160" alt="img" class="card-img-top pt-2">
                                            <div class="star-rating" style="position: absolute; top:7px; right: 10px; font-size: 10px;">
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
                                                    <li class="list-inline-item m-0"><span style="color: black;">
                                                            <p><?php echo number_format($average_rating, 1); ?></p>
                                                        </span></li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <strong><?php echo $produk['nm_produk']; ?></strong></br>
                                            <h6 class="text-danger">Rp. <?php echo number_format($produk['harga']); ?></h6>
                                            <h6 class="text-danger">Diskon Rp. <?php echo number_format($produk['diskon']); ?></h6>
                                            <a href="detail-produk.php?id=<?php echo $produk['id_produk']; ?>" class="btn btn-secondary btn-sm btn-block">Lihat Produk</a>
                                        </div>
                                    </div>
                                </div>
                <?php
                            }
                        } else {
                            echo "Produk tidak ditemukan.";
                        }
                    }
                }
                ?>

                <?php
                // ...
                if (isset($_GET['kategori'])) {
                    $kategori = $_GET['kategori'];
                    $queryAllProducts = "SELECT p.id_produk, p.nm_produk, p.harga, p.diskon, p.gambar, COALESCE(SUM(r.rating), 0) as total_rating, COALESCE(COUNT(r.rating), 0) as jumlah_rating
                          FROM tbl_produk p
                          LEFT JOIN tbl_rating r ON p.id_produk = r.id_produk
                          WHERE p.id_kategori = $kategori
                          GROUP BY p.id_produk";
                          
                    $resultKategori = $db->query($queryAllProducts);
                
                    if ($resultKategori->num_rows > 0) {
                        while ($produk = $resultKategori->fetch_assoc()) {
                      $average_rating = ($produk['jumlah_rating'] > 0) ? $produk['total_rating'] / $produk['jumlah_rating'] : 0;

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
                      <div class="mb-0 p-1 col-md-6 col-lg-4 col-xl-3">
                                    <div class="item card">
                                        <div class="thumnail">
                                            <img src="admin/assets/images/foto_produk/<?php echo $produk['gambar']; ?>" width="160" height="160" alt="img" class="card-img-top pt-2">
                                            <div class="star-rating" style="position: absolute; top:7px; right: 10px; font-size: 10px;">
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
                                                    <li class="list-inline-item m-0"><span style="color: black;">
                                                            <p><?php echo number_format($average_rating, 1); ?></p>
                                                        </span></li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <strong><?php echo $produk['nm_produk']; ?></strong></br>
                                            <h6 class="text-danger">Rp. <?php echo number_format($produk['harga']); ?></h6>
                                            <h6 class="text-danger">Diskon Rp. <?php echo number_format($produk['diskon']); ?></h6>
                                            <a href="detail-produk.php?id=<?php echo $produk['id_produk']; ?>" class="btn btn-secondary btn-sm btn-block">Lihat Produk</a>
                                        </div>
                                    </div>
                                </div>
                                <?php 

                }
            } }
                // ...

                ?>
            </div>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>