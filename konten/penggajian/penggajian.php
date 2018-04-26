<?php
@$id_delete = $_GET['id_delete'];
if (!empty($id_delete)) {
    $query_hapus = $koneksi->query("DELETE FROM penggajian where id='" . $id_delete . "' ");
    echo '<div class="alert alert-success">Data Penggajian Berhasil di Hapus</div>';
    echo "<meta http-equiv=refresh content=1;url='?m1=penggajian&m2=penggajian'>";
}
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
    $query_tambah = $koneksi->query("INSERT INTO penggajian (nama,jabatan,gajipokok,gajibulan,absen,potongan,totalgaji,nik)values ('" . $nama . "','" . $jabatan . "','" . $gaji . "','" . $bulan . "','" . $absen . "','" . $potongan . "','" . $totalgaji . "','" . $nik . "')");

    echo '<div class="alert alert-success">Data Penggajian Berhasil di Tambah</div>';
    echo "<meta http-equiv=refresh content=1;url='?m1=penggajian&m2=penggajian'>";
}
?>

<?php
if (isset($_POST['cari'])) {
    $nk_cari = $_POST['nik'];
    @$query_edit = $koneksi->query("SELECT * FROM karyawan where nik='" . $nk_cari . "' ");
    @$tampil_edit = $query_edit->fetch_assoc();
    if ($nk_cari != $tampil_edit['nik']) {
        echo '<div class="alert alert-danger">Data Karyawan Tidak Ada</div>';
        echo "<meta http-equiv=refresh content=1;url='?m1=penggajian&m2=penggajian'>";
    }
} else {
    @$query_edit = $koneksi->query("SELECT * FROM karyawan where nik='" . $nk_cari . "' ");
    @$tampil_edit = $query_edit->fetch_assoc();
}


?>

<div class="row">
    <!-- left column -->
    <div class="col-md-4">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kelola Data Penggajian</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" value="<?= $tampil_edit['nik'] ?>"
                               placeholder="Masukkan NIK">&nbsp;<br>
                        <button type="submit" name="cari" class="btn btn-primary">Cari</button>
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
                            <input type='text' class="form-control" name="bulan"/>
                            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Absen</label>
                        <input type="text" onkeyup="angka(this);" class="form-control" name="absen"
                               placeholder="Masukkan Absen">
                    </div>
                    <div class="form-group">
                        <label>Potongan</label>
                        <input type="text" onkeyup="angka(this);" class="form-control" name="potongan"
                               placeholder="Masukkan Potongan Gaji">
                    </div>


                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-8">
    <?php
    $query = $koneksi->query("SELECT * FROM penggajian");
    ?>

    <div class="box box-primary">
        <div class="box-header with border">
            <h3 class="box-title">Data penggajian</h3>
        </div>

        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Bulan</th>
                    <th>Gaji Pokok</th>
                    <th>Absen</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                    <th>Action</th>
                </tr>
                </thead>

                <?php
                while ($tampil = $query->fetch_assoc()) {
                    @$a++;
                    ?>

                    <tr>
                        <td><?= $a ?></td>
                        <td><?= $tampil['nik'] ?></td>
                        <td><?= $tampil['nama'] ?></td>
                        <td><?= $tampil['jabatan'] ?></td>
                        <td><?= $tampil['gajibulan'] ?></td>
                        <td><?= $tampil['gajipokok'] ?></td>
                        <td><?= $tampil['absen'] ?></td>
                        <td><?= $tampil['potongan'] ?></td>
                        <td><?= $tampil['totalgaji'] ?></td>
                        <td><a href="javascript:;" data-id="<? echo $tampil['id'] ?>" data-toggle="modal"
                               data-target="#modal-konfirmasi" class="btn btn-success btn-danger fa fa-trash"></a>&nbsp;<a
                                    href="
						?m1=penggajian&m2=editpenggajian&id_edit=<?= $tampil['id'] ?>" class="
						btn btn-success btn-warning fa fa-edit"></a></td>
                    </tr>

                <?php } ?>
                </tbody>

            </table>
        </div>


        <div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Konfirmasi</h4>
                    </div>
                    <div class="modal-body btn-info">
                        Apakah Anda yakin ingin menghapus data ini ?
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-danger" id="hapus-true-data-gaji">Hapus</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</div>