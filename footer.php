<style>
        .list-unstyled li a {
            color: white;
            text-decoration: none;
        }

        .list-unstyled li a:hover {
            color: rgb(163, 211, 255);
            text-decoration: none;
        }
        input.btn.i {
            border: 2px solid white;
            width: 75%;
            padding: 7px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        button.btn.o {
            border: 2px solid white;
            padding: 7px;
            font-weight: bold;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        ::placeholder {
            color: white;
        }

        footer {
            left: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
    <footer>
        <div class="page-footer font-small indigo  bg-secondary mt-3">
            <div class="container-fluid text-center text-md-left">
                <div class="row text-white">
                    <div class="col-md-2 mx-auto">
                        <h5 class="font-weight-bold text-uppercase mt-3 mb-2">Alamat</h5>

                        Kampung Batukarut RT 01/RW 09 Desa Pasir Eurih Kecamatan Tamansari Kabupaten Bogor 
                    </div>
                    
                    <hr class="clearfix w-100 d-md-none">
                    <div class="col-md-1.5 mx-auto">
                        <h5 class="font-weight-bold text-uppercase mt-3 mb-2">KONTAK</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="https://web.whatsapp.com/">089611471404</a>
                            </li>
                            <li>
                                <a href="https://accounts.google.com/v3/signin/confirmidentifier?ifkv=AXo7B7Whu7dZjflzRUgA2OuiucodEAdWpfj0gAUhjl-q0I5vN1XMAhQJM_pfFSU3hYv_eqW9FoyX&service=mail&flowName=GlifWebSignIn&flowEntry=ServiceLogin&dsh=S1929477806%3A1692875670214960">Sugihmuktimart@gmail.com</a>
                            </li>
                            
                        </ul>
                    </div>
                    <hr class="clearfix w-100 d-md-none">
                    <div class="col-md-2 mx-auto">
                        <h5 class="font-weight-bold text-uppercase mt-3 mb-2">TAUTAN</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="shop.php">Shop</a>
                            </li>
                            <li>
                                <a href="orderan.php">Orderan</a>
                            </li>
                            <li>
                                <a href="about.php">About</a>
                            </li>
                            <li>
                                <a href="contact.php">Contact</a>
                            </li>
                            
                        </ul>
                    </div>
                    
                </div>
            </div>
            <div class="footer-copyright text-center py-3 bg-dark text-white">©2023 Copyright :
                 Kelompoktanisugihmukti.com 
            </div>
        </div>
    </footer>

    </body>
    <!-- Js Dasar -->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- Popper -->
    <script src="assets/js/popper/popper.min.js"></script>
    <!-- Owl Carausel -->
    <script src="assets/js/owl/owl.carousel.js"></script>
    <!-- Sweetalert -->
    <script src="assets/js/sweetalert/sweetalert.min.js"></script>

    <!-- Stok Detail Produk -->
    <!-- Plugins js -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Plugins Init js -->
    <script src="admin/assets/pages/form-advanced.js"></script>

    <!-- Datatable js -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Responsive examples -->
    <script src="plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>

    </html>