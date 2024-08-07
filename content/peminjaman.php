<?php
$queryPinjam = mysqli_query($koneksi, "SELECT anggota.nama_lengkap as nama_anggota, user.nama_lengkap as nama_user, user.* FROM peminjaman LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota LEFT JOIN user ON user.id = peminjaman.id_user ORDER BY id ");



?>

<div class=" mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Transaksi Peminjaman</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3" align="right">
                        <a href="?pg=tambah-peminjaman" class="btn btn-primary">Tambah </a>
                    </div>
                    <?php
                    if(isset($_GET['tambah']) && $_GET['tambah']=="berhasil") :  ?>
                    <div class="alert alert-success" role="alert">
                        Data berhasil di simpan
                    </div>
                    <?php endif;?>
                    <?php
                    if(isset($_GET['hapus']) && $_GET['hapus']=="berhasil") :  ?>
                    <div class="alert alert-success" role="alert">
                        Data berhasil di hapus
                    </div>
                    <?php endif;?>
                    <?php
                    if(isset($_GET['edit']) && $_GET['edit']=="berhasil") :  ?>
                    <div class="alert alert-success" role="alert">
                        Data Mengedit Data
                    </div>
                    <?php endif;?>

                    <div class="table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Anggota</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no = 1; while($row = mysqli_fetch_assoc($queryPinjam)): ?>

                                <tr>
                                    <td><?=$no++?></td>
                                    <td><?= $rowUser['kode_transaksi'] ?></td>
                                    <td><?= $rowUser['nama_anggota']?></td>
                                    <td><?= $rowUser['tgl_pinjam']?></td>
                                    <td><?= $rowUser['tgl_kembali']?></td>
                                    <td><?= $rowUser['status']?></td>
                                    <td><?= $rowUser['nama_user']?></td>

                                    <td><a href="?pg=tambah-user&delete=<?=$rowUser['id']?>"
                                            class="btn btn-warning btn-sm"
                                            onclick="return confirm('Apakah anda ingin menghapus?')">Detail</a> | <a
                                            href="?pg=tambah-user&delete=<?=$rowUser['id']?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah anda ingin menghapus?')">Delete</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>