<?php
$query = mysqli_query($koneksi,"SELECT * from user ORDER BY id DESC");


if(isset($_POST['simpan'])){
    $id = isset($_GET['edit'])?$_GET['edit'] : '';
    $nama_lengkap = $_POST['namaLengkap'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    if(!$id){
        $queryInsert = mysqli_query($koneksi, "INSERT INTO user (nama_lengkap,email,password)  VALUES ('$nama_lengkap','$email','$password')");
        if($queryInsert){
            header("location:index.php?pg=user&tambah=berhasil");
        }
    }else{
        $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap = '$nama_lengkap', email = '$email',password = '$password' WHERE id = $id");
        if($update){
            header("location:index.php?pg=user&edit=berhasil");
        }
    }
}   
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $queryDelete = mysqli_query($koneksi, "DELETE FROM user WHERE id = $id");
    if($queryDelete){
        header("location:index.php?pg=user&hapus=berhasil");
    }
}
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $queryEdit = mysqli_query($koneksi, "SELECT * FROM user WHERE id = $id");
    $dataEdit = mysqli_fetch_assoc($queryEdit);
}
?>

<div class=" mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Data User</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="namaLengkap"
                                value="<?= $dataEdit['nama_lengkap']??'' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $dataEdit['email']??'' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                </div>
                <div class="card-footer">
                    <input class="btn btn-primary" name="simpan" value="Simpan User" type="submit" />
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>