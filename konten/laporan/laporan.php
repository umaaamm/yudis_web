<?php
if (isset($_POST['filter'])) {
    $bulan = $_POST['bulan'];
    if ($bulan == '') {
        $query = $koneksi->query("select * from penggajian");
    } else {
        $query = $koneksi->query("select * from penggajian where gajibulan = '" . $bulan . "' ");
    }
} else {

    $query = $koneksi->query("select * from penggajian");
}
?>

<div class="row">

    <form role="form" action="" method="post">
        <div class="col-md-3">
            <div class="form-group">
                <label>Tanggal</label>
                <div class='input-group date' id='datepicker'>
                    <input type='text' class="form-control" name="bulan"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <br>
                <button type="submit" name="filter" class="btn btn-primary">Filter</button>
            </div>

        </div>

    </form>
    <div class="col-md-12">


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
                        <th>Cetak</th>

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
                            <td><a href="
						?m1=laporan&m2=invoice&id_print=<?= $tampil['id'] ?>" target="_bank" class="
						btn btn-success btn-warning fa fa-print"></a></td>
                        </tr>

                    <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>