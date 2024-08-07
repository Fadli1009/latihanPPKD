<?php
session_start();
include "config/koneksi.php";
if(!$_SESSION['ID']){
    header("location: login.php");
    exit; 
}
// echo "<h1>Selamat datang" . (isset($_SESSION['NAMA_LENGKAP']) ? $_SESSION['NAMA_LENGKAP'] : '')."</h1>";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selaamt Datang,<?php echo $_SESSION['NAMA_LENGKAP'] ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
    nav.menu {
        background-color: #F8EDE3 !important;
        color: #fff;
        box-shadow: 0 0 3px #000;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a href="" class="navbar-brand">Perpustakaan</a>
                <!-- Toggle Button for Mobile View -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?pg=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?pg=peminjaman">Peminjaman</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Master Data
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="?pg=user">User</a></li>
                                <li><a class="dropdown-item" href="?pg=level">Level</a></li>
                                <li><a class="dropdown-item" href="?pg=kategori">Kategori</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Transaksi
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="?pg=buku">Buku</a></li>
                                <li><a class="dropdown-item" href="?pg=anggota">Anggota</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger" href="logout.php">Logout</a>
                        </li>
                    </ul>
                    <span class="navbar-text ms-auto">hi,
                        <?= (isset($_SESSION['NAMA_LENGKAP']) ? $_SESSION['NAMA_LENGKAP'] : '') ?>
                    </span>
                </div>
            </div>
        </nav>

        <!-- content here -->
        <div class="container-fluid">
            <?php
            if (isset($_GET['pg'])) {
                # code...
                if (file_exists('content/'. $_GET['pg'].'.php')) {
                   include 'content/'. $_GET['pg']. '.php';
                }
            }else{
                include 'content/home.php';
            }
            ?>
        </div>

    </div>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script>
    $('#id_kategori').change(function() {
        let id = $(this).val();
        let option = ""
        $.ajax({
            url: "ajax/getBuku.php?id_kategori=" + id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                option += "<option>Pilih Buku</option>"
                $.each(data, function(key, value) {
                    option += "<option value=" + value.id + ">" + value.judul +
                        "</option>"
                })
                $('#id_buku').html(option)
            }
        })
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>