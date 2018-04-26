<?php
include "koneksi/koneksi.php"
?>

<?php
@$id_edit = $_GET['id_edit'];
$query_edit = $koneksi->query("SELECT * FROM penggajian where id='" . $id_edit . "' ");
$tampil_edit = $query_edit->fetch_assoc();
?>

<?php
if (isset($_POST['submit'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $gaji = $_POST['gaji'];
    $absen = $_POST['absen'];
    $potongan = $_POST['potongan'];
    $bulan = $_POST['bulan'];
    $totalgaji = $absen * 55000 + $gaji - $potongan;
    $query_tambah = $koneksi->query("UPDATE penggajian SET nama='" . $nama . "',jabatan='" . $jabatan . "',gajipokok='" . $gaji . "',absen='" . $absen . "',potongan='" . $potongan . "',gajibulan='" . $bulan . "',totalgaji='" . $totalgaji . "',nik='" . $nik . "' where id='" . $id_edit . "'  ");

    if ($query_tambah) {
        echo '<div class="alert alert-success">Data Penggajian Berhasil di Edit</div>';
        echo "<meta http-equiv=refresh content=1;url='?m1=penggajian&m2=penggajian'>";
    }
}
?>


<?php
$query_combo = $koneksi->query("SELECT * FROM penggajian");
?>
<div class="row">
    <!-- left column -->
    <div class="col-md-4">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Data Penggajian</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" value="<?= $tampil_edit['nik'] ?>"
                               placeholder="Masukkan NIK">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?= $tampil_edit['nama'] ?>"
                               placeholder="Masukkan Nama" readonly>
                    </div>

                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" value="<?= $tampil_edit['jabatan'] ?>" name="jabatan"
                               placeholder="Masukkan jabatan" readonly>
                    </div>
                    <div class="form-group">
                        <label>Gaji Pokok</label>
                        <input type="text" onkeyup="angka(this);" class="form-control"
                               value="<?= $tampil_edit['gajipokok'] ?>" name="gaji" placeholder="Masukkan Gaji Pokok"
                               readonly>
                    </div>

                    <div class="form-group">
                        <label>Gaji Bulan</label>

                        <div class='input-group date' id='datepicker'>
                            <input type='text' class="form-control" value="<?= $tampil_edit['gajibulan'] ?>"
                                   name="bulan"/>
                            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>

                    </div>


                    <div class="form-group">
                        <label>Absen</label>
                        <input type="text" onkeyup="angka(this);" class="form-control"
                               value="<?= $tampil_edit['absen'] ?>" name="absen" placeholder="Masukkan Absen">
                    </div>
                    <div class="form-group">
                        <label>Potongan</label>
                        <input type="text" onkeyup="angka(this);" class="form-control" name="potongan"
                               value="<?= $tampil_edit['potongan'] ?>" placeholder="Masukkan Potongan Gaji">
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                        <!-- <button type="reset" name="reset" class="btn btn-danger">Reset</button> -->
                    </div>
            </form>
        </div>
    </div>
</div>