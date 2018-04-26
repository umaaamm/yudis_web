<?php
@$id_delete = $_GET['id_delete'];
if (!empty($id_delete)) {
    $query_hapus = $koneksi->query("DELETE FROM karyawan where id='" . $id_delete . "' ");
    echo '<div class="alert alert-success">Data Karyawan Berhasil di Hapus</div>';
    echo "<meta http-equiv=refresh content=1;url='?m1=karyawan&m2=datakaryawan'>";
}
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
    $query_tambah = $koneksi->query("INSERT INTO karyawan (nik,nama,alamat,jabatan,gajipokok,jeniskelamin,TTL)values ('" . $nik . "','" . $nama . "','" . $alamat . "','" . $jabatan . "','" . $gaji . "','" . $jk . "','" . $ttl . "')");
    echo '<div class="alert alert-success">Data Karyawan Berhasil di Tambah</div>';
    echo "<meta http-equiv=refresh content=1;url='?m1=karyawan&m2=datakaryawan'>";
}
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
                        <input type="text" class="form-control" name="nik" placeholder="Masukkan NIK">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="5" name="alamat" placeholder="Masukan Alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="jabatan">
                            <option value="-">-- Pilih Jabatan --</option>
                            <option value="Manajer">Manajer</option>
                            <option value="AO/PO">AO/PO</option>
                            <option value="Funding">Funding</option>
                            <option value="Kasir">Kasir</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Accounting">Accounting</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gaji Pokok</label>
                        <input type="text" onkeyup="angka(this);" class="form-control" name="gaji"
                               placeholder="Masukkan Gaji Pokok">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jk">
                            <option value="-">-- Pilih Jenis Kelamin --</option>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class='input-group date' id='datepicker'>
                            <input type='text' class="form-control" name="ttl"/>
                            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
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
    $query = $koneksi->query("SELECT * FROM karyawan");
    ?>

    <div class="box box-primary">
        <div class="box-header with border">
            <h3 class="box-title">Data Karyawan</h3>
        </div>

        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
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
                        <td><?= $tampil['alamat'] ?></td>
                        <td><?= $tampil['jabatan'] ?></td>
                        <td><?= $tampil['gajipokok'] ?></td>
                        <td><?= $tampil['jeniskelamin'] ?></td>
                        <td><?= $tampil['TTL'] ?></td>
                        <td><a href="javascript:;" data-id="<? echo $tampil['id'] ?>" data-toggle="modal"
                               data-target="#modal-konfirmasi" class="btn btn-success btn-danger fa fa-trash"></a>&nbsp;<a
                                    href="
						?m1=karyawan&m2=editdatakaryawan&id_edit=<?= $tampil['id'] ?>" class="
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
                        <a href="javascript:;" class="btn btn-danger" id="hapus-true-data">Hapus</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</div>