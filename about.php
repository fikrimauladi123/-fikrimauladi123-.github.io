<?php require "header.php"; ?>
<style>
    .banner .img {
        width: 100%;
        height: 250px;
        background-image: url('assets/img/logo.png');
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

    .row {
        margin-left: 0;
        margin-right: 0;
    }

    .row>[class^="col-sm-4"] {
        padding-left: 0;
        padding-right: 0;
    }

    .row>[class^="col-sm-8"] {
        padding-right: 100px;
    }
</style>

<div class="banner mb-3">
    <div class="container-fluid img">
        <div class="container-fluid box">
            <h3>Tentang Kami</h3>
            <p>Home > <a href="shop.php">Lanjutkan pembelian</a></p>
        </div>
    </div>
</div>

<!-- <div class="container bg-white rounded pt-4 pb-4">
    <div class="row no-gutter">
        <div class="col-sm-8 text-justify">
            <h4>Sambutan Ketua Kelompok Tani</h4>
            <p>Kelompok tani sugih Mukti adalah sebuah organisasi atau asosiasi yang terdiri dari petani atau kelompok petani dengan tujuan untuk bekerja sama dan meningkatkan kesejahteraan anggotanya. Kelompok tani beroperasi di tingkat lokal, regional, atau bahkan nasional, tergantung pada skala kegiatan dan wilayah yang dilayani. Mereka bertujuan untuk mencapai keberlanjutan pertanian, meningkatkan produktivitas, dan meningkatkan akses anggotanya terhadap sumber daya serta pasar. 
            </p>

        </div>
        <div class="col-sm-4">
            <img src="assets/img/logokelompoktani.jpg" height="300px" width="100%">
            <h4>Ugan Sugandi</h4>
        </div>
    </div>
</div> -->
<div class="container bg-white rounded pt-4 pb-4">
    <div class="row no-gutter">
        <div class="col-sm-8 text-justify">
            <h4>Sugih Mukti</h4>
            <p>Kelompok tani sugih Mukti adalah sebuah organisasi atau asosiasi yang terdiri dari petani atau kelompok petani dengan tujuan untuk bekerja sama dan meningkatkan kesejahteraan anggotanya. Kelompok tani beroperasi di tingkat lokal, regional, atau bahkan nasional, tergantung pada skala kegiatan dan wilayah yang dilayani. Mereka bertujuan untuk mencapai keberlanjutan pertanian, meningkatkan produktivitas, dan meningkatkan akses anggotanya terhadap sumber daya serta pasar. 
            </p>

        </div>
        <div class="col-sm-4">
            <img src="assets/img/logokelompoktani.jpg" height="300px" width="100%">
        </div>
    </div>
</div>
<?php require "footer.php"; ?>