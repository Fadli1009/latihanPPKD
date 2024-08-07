<?php
if (isset($_POST['simpan'])) {
    // jika param edit ada maka update, selain itu maka tambah
    $id = isset($_GET['edit']) ? $_GET['edit'] : '';


    $kode_transaksi = $_POST['kode_transaksi'];
    $id_anggota = $_POST['id_anggota'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $id_user = $_POST['id_user'];

    if (!$id) {
        $queryInsert = mysqli_query($koneksi, "INSERT INTO peminjam (kode_transaksi, id_anggota, tgl_pinjam, tgl_kembali,id_user) VALUES ('$kode_transaksi', $id_anggota, '$tgl_pinjam', '$tanggal_kembali',$id_user) ");
        header("Location:?pg=peminjaman&tambah=berhasil");
    } else {
        $updateUser = mysqli_query($koneksi, "UPDATE user SET  nama_lengkap = '$nama_lengkap',  email = '$email', id_level = '$id_level', password ='$password' WHERE id ='$id' ");
        header("Location:?pg=user&edit=berhasil");
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM user WHERE id = '$id'");
    header("location:?pg=user&delete=berhasil");
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}

$anggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id DESC");
$kategoriBuku = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id DESC");

// kode transaksi

$mysqliQuery = mysqli_query($koneksi, "SELECT max(id) as id_transaksi FROM peminjaman");
$kodeTransaksi = mysqli_fetch_assoc($mysqliQuery);
$nomorUrut = $kodeTransaksi['id_transaksi'];
$nomorUrut++;

$format_transaksi = "PJ".date("dmY").sprintf("%03s",$nomorUrut);

?>
<div class="container-fluid mt-5">

    <div class="row justify-content-center">
        <div class="col-sm-8">

            <div class="card">
                <div class="card-header">Tambah Peminjam</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Kode Transaksi</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="kode_transaksi" readonly
                                    value="<?php echo ($format_transaksi)??''?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Pilih Anggota</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="id_kategori " id="" class="form-control">
                                    <option value="">Pilih anggota</option>
                                    <?php while ($rowAnggota = mysqli_fetch_assoc($anggota)) :?>
                                    <option value="<?= $rowAnggota['id']?>"><?= $rowAnggota['nama_lengkap']?></option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Tanggal Pinjam</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="tanggal_pinjam">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Tanggal Kembali</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="tanggal_kembali">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-sm-2">
                                <label for="">Petugas</label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="petugas"
                                    value="<?= (isset($_SESSION['NAMA_LENGKAP']) ? $_SESSION['NAMA_LENGKAP'] : '') ?>"
                                    readonly>
                                <input type="hidden" name="id_user"
                                    value="<?= (isset($_SESSION['ID']) ? $_SESSION['ID'] : '') ?>" id="">
                            </div>
                        </div>

                        <!-- get data kategori buku -->
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Kategori Buku</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="id_kategori " id="id_kategori" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    <?php while ($rowKategori = mysqli_fetch_assoc($kategoriBuku)) :?>
                                    <option value="<?= $rowKategori['id']?>"><?= $rowKategori['nama_kategori']?>
                                    </option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="">Nama Buku</label>
                            </div>
                            <div class="col-sm-3">
                                <select name="id_anggota " id="id_buku" class="form-control">
                                    <option value="">Pilih Kategori</option>

                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>