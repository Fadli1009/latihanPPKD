<?php
$query = mysqli_query($koneksi,"SELECT * from user ORDER BY id DESC");


?>

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Data User</h3>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no = 1; while($rowUser = mysqli_fetch_assoc($query)): ?>

                                <tr>
                                    <td><?=$no?></td>
                                    <td><?= $rowUser['nama_lengkap'] ?></td>
                                    <td><?= $rowUser['email']?></td>
                                    <td><a href="" class="btn btn-warning">Edit</a></td>
                                </tr>
                                <?php $no++; endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>