<?php
include "koneksi/koneksi.php"
?>

<?php
@$id_edit = $_GET['id_edit'];
$query_edit = $koneksi->query("SELECT * FROM karyawan where id='" . $id_edit . "' ");
$tampil_edit = $query_edit->fetch_assoc();
?>

<?php
if (isset($_POST['submit'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];
    $gaji = $_POST['gaji'];
    $jk = $_POST['jk'];
    $ttl = $_POST['ttl'];
    $query_tambah = $koneksi->query("UPDATE karyawan SET nik='" . $nik . "',nama='" . $nama . "',alamat='" . $alamat . "',jabatan='" . $jabatan . "',gajipokok='" . $gaji . "',jeniskelamin='" . $jk . "',TTL='" . $ttl . "' where id='" . $id_edit . "'  ");

    if ($query_tambah) {
        echo '<div class="alert alert-success">Data Karyawan Berhasil di Edit</div>';
        echo "<meta http-equiv=refresh content=1;url='?m1=karyawan&m2=datakaryawan'>";
    }
}
?>


<?php
$query_combo = $koneksi->query("SELECT * FROM karyawan");
$query_c = $koneksi->query("SELECT * FROM karyawan");

//$query_tahun=$koneksi->query("SELECT DISTINCT tahun from npf order by tahun ASC");
?>
<div class="row">
    <!-- left column -->
    <div class="col-md-4">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kelola Data Karyawan</h3>
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
                               placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="5" name="alamat"
                                  placeholder="Masukan Alamat"><? echo $tampil_edit['alamat'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>

                        <select class="form-control" name="jabatan">
                            <?php

                            while ($tampil_kode = $query_combo->fetch_assoc()) {
                                ?>
                                <option value="<?= $tampil_kode['jabatan'] ?>" <?= (($tampil_edit['id'] == $tampil_kode['id']) ? 'selected' : ''); ?>><?= $tampil_kode['jabatan'] ?></option>
                            <?php } ?>
                        </select>


                    </div>
                    <div class="form-group">
                        <label>Gaji Pokok</label>
                        <input type="text" onkeyup="angka(this);" value="<?= $tampil_edit['gajipokok'] ?>"
                               class="form-control" name="gaji" placeholder="Masukkan Gaji Pokok">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jk">
                            <?php

                            while ($tampil_k = $query_c->fetch_assoc()) {
                                ?>
                                <option value="<?= $tampil_k['jeniskelamin'] ?>" <?= (($tampil_edit['id'] == $tampil_k['id']) ? 'selected' : ''); ?>><?= $tampil_k['jeniskelamin'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class='input-group date' id='datepicker'>
                            <input type='text' class="form-control" value="<?= $tampil_edit['TTL'] ?>" name="ttl"/>
                            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
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