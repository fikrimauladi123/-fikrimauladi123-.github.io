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
            color: #0066FF;
        }

        .box a:hover {
            text-decoration: none;
            color: rgb(6, 87, 209);
        }

        /* content */
        .row {
            margin-left: 0;
            margin-right: 0;
            margin-bottom: 6px;
        }

        .row>[class^="col"] {
            padding-left: 3px;
            padding-right: 3px;
        }

        textarea {
            width: 100%;
        }

        #googleMap {
            width: 100%;
            height: 350px;
        }
    </style>

    <div class="banner mb-3">
        <div class="container-fluid img">
            <div class="container-fluid box">
                <h3>CONTACT US</h3>
                <p>Home > <a href="#">Contact Us</a></p>
            </div>
        </div>
    </div>

    <div class="container bg-white rounded pt-4 pb-4">
        <div class="row">
            <div class="col-md-8 col-sm-12 pr-4">
            <h3 class="mb-2"><span class="text-secondary"> COORDINATE </span>LOCATION</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.1035667127544!2d106.75689927499172!3d-6.634058264852012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69cfe961e6d78d%3A0xea3dfe5f49f062ea!2sTugu%20batu%20KARUT!5e0!3m2!1sen!2sid!4v1690599736458!5m2!1sen!2sid" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <!-- <form action="" method="post">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="validationDefault01" placeholder="Nama Depan" value="" required="required">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="validationDefault01" placeholder="Nama Belakang" value="" required="required">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="validationDefault02" placeholder="E-mail" value="" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group">
                                <textarea class="form-control" id="validationTextarea" placeholder="Masukkan Pesan Yang Ingin Di Kirimkan" rows="9" required="required"></textarea>
                                <div class="invalid-feedback">
                                    Masukkan Pesan Yang Ingin Di Kirimkan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="button" class="btn btn-primary btn-md" value="Kirim Pesan" id="submit" onclick="validate();" />
                    </div>
                </form> -->
            </div>
            <div class="col-md-4 col-sm-12 text-left">
                <h5>Contact Info</h5>
                <p>untuk informasi mengenai hasil pertanian dan ingin datang langsung ke lokasi dapat datang langsung atau menghubungi kontak</p>
                <i class="fa fa-tty"></i> 089611471404 <br>
                <i class="fa fa-envelope"></i> sugihmukti@gmail.com <br>
                <i class="fa fa-hourglass"></i> setiap hari <br>
                <i class="fa fa-map-marker"></i> Batukarut kec.tamansari kabupaten bogor <br>

            </div>
        </div>

        <!-- <div class="row mt-5">
            <h3 class="mb-2"><span class="text-primary"> COORDINATE </span>LOCATION
            </h3>
            <div id="googleMap"></div>
        </div> -->
    </div>

    <script>
        // Initialize and add the map
        function initMap() {

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.1035667127544!2d106.75689927499172!3d-6.634058264852012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69cfe961e6d78d%3A0xea3dfe5f49f062ea!2sTugu%20batu%20KARUT!5e0!3m2!1sen!2sid!4v1690599736458!5m2!1sen!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        };

        function validate() {
            var var1 = document.getElementById("validationDefault01").value;
            var var2 = document.getElementById("validationDefault02").value;
            if (var1 == "" && var2 == "") {
                swal({
                    title: "Gagal",
                    text: "Silahkan Mengisi Form Data Terlebih Dahulu!",
                    icon: "warning"
                })
                return false;
            }
            if (var1 != "" || var2 != "") {
                swal({
                    title: "Sukses",
                    text: 'Pesan Anda Berhasil Di Kirimkan!',
                    icon: "success"
                }).then(okay => {
                    if (okay) {
                        window.location.href = "contact.php";
                    }
                });

            }

        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuSgg6X0S1onsjheqw3PUWwTAZDgV4A8k&callback=initMap">
    </script>
    <?php require "footer.php"; ?>