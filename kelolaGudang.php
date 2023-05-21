<?php 
    include 'sidebarnav.php';
    include_once 'config.php';
    ob_start();

    $redirect_path = 'http://' . $_SERVER['SERVER_NAME'] .':'.$_SERVER['SERVER_PORT'] . $_SERVER['PHP_SELF'] ;
    if(isset($_POST['create'])) {
        // $id_gudang = $conn->real_escape_string($_POST['id_gudang']);
        $jumlah = $conn->real_escape_string($_POST['jumlah']);
        $kandungan_lemak = $conn->real_escape_string($_POST['kandungan_lemak']);
        $kandungan_protein = $conn->real_escape_string($_POST['kandungan_protein']);

        $sql = "INSERT INTO gudang (id_gudang, jumlah, kandungan_lemak, kandungan_protein) VALUES (null, '$jumlah', '$kandungan_lemak', '$kandungan_protein')";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }  
    
    if (isset($_POST['update'])) {
        $id_gudang = $conn->real_escape_string($_POST['update']);
        $jumlah = $conn->real_escape_string($_POST['jumlah']);
        $kandungan_lemak = $conn->real_escape_string($_POST['kandungan_lemak']);
        $kandungan_protein = $conn->real_escape_string($_POST['kandungan_protein']);

        $sql = "UPDATE gudang SET jumlah = '$jumlah', kandungan_lemak = '$kandungan_lemak', kandungan_protein = '$kandungan_protein' WHERE id_gudang = '$id_gudang'";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }  
    
    if (isset($_POST['delete'])) {
        $id_mitra = $conn->real_escape_string($_POST['delete']);
        $sql = "DELETE FROM gudang WHERE id_gudang = '$id_gudang'";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }
?>

<!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="page-breadcrumb">
                    <div class="row align-items-center">
                        <div class="align-self-center d-flex gap-3">
                            <h3 class="page-title mb-0 p-0">Gudang Susu</h3>
                        </div>
                    </div>    
                    <div class="mt-4 align-items-right">
                        <div class="text-end upgrade-btn">
                            <?php if(!isset($_GET['add']) && !isset($_GET['edit'])): ?>
                                <a href="?add=true"
                                class="btn btn-success d-none d-md-inline-block text-white">Add Data Gudang Baru <i class="fa-solid fa-plus"></i></a>
                            <?php endif?>
                        </div>
                    </div>
                    
                    <!-- table  -->
                    <?php if(isset($_GET['add'])): ?>
                        <form class="mt-2" action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="jumlah">Jumlah</label>
                                    <input id="jumlah" name="jumlah" type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kandungan_lemak">Kandungan Lemak</label>
                                    <input id="kandungan_lemak" name="kandungan_lemak" type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kandungan_protein">Kandungan Protein</label>
                                    <input id="kandungan_protein" name="kandungan_protein" type="text" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-success" name="create">Tambah</button>
                        </form>
                    <?php endif?>

                    <?php if(isset($_GET['edit'])): ?>
                        <form class="mt-2" action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="jumlah">Jumlah</label>
                                    <input id="jumlah" name="jumlah" type="text" class="form-control" value="<?= $_GET['jumlah']?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kandungan_lemak">Kandungan Lemak</label>
                                    <input id="kandungan_lemak" name="kandungan_lemak" type="text" class="form-control" value="<?= $_GET['kandungan_lemak']?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kandungan_protein">Kandungan Protein</label>
                                    <input id="kandungan_protein" name="kandungan_protein" type="text" class="form-control" value="<?= $_GET['kandungan_protein']?>">
                                </div>
                                <button type="submit" class="btn btn-block btn-success" name="update" value="<?= $_GET['edit']?>">Ubah</button>
                            </div>
                        </form>
                    <?php endif?>

                    <?php if(!isset($_GET['add']) && !isset($_GET['edit'])): ?>
                        <div class="my-4">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jumlah</th>
                                    <th>Kandungan Lemak</th>
                                    <th>Kandungan protein</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $result = mysqli_query($conn, "SELECT * FROM gudang"); 
                                $no = 1;    ?>
                                <?php while ($data = mysqli_fetch_array($result)): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['jumlah'] ?></td>
                                        <td><?= $data['kandungan_lemak'] ?></td>
                                        <td><?= $data['kandungan_protein'] ?></td>
                                        <td class="d-flex gap-3">
                                            <a class="btn bg-warning text-white" href="?edit=<?= $data['id_gudang'] ?>&jumlah=<?= $data['jumlah']?>&kandungan_lemak=<?= $data['kandungan_lemak']?>&kandungan_protein=<?= $data['kandungan_protein']?>">Ubah</a>

                                            <form action="" method="post">
                                                <button type="submit" class="btn bg-danger text-white" name="delete" value="<?= $data['id_gudang'] ?>">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif?>

                    </div>
                </div>        
            </div>
            <?php require_once('footer.php') ?>
        </div>
    <!-- ============================================================== -->
<!-- End Wrapper -->

<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>