<?php
@$id_print = $_GET['id_print'];
$query_edit = $koneksi->query("SELECT * FROM penggajian where id='" . $id_print . "' ");
$tampil_edit = $query_edit->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji Koperasi syari'ah bersinar baithul tanwil muhammadyah(BTM)</title>
    <link rel="stylesheet" href="bootstrap2.css">
    <style>
        @import url(http://fonts.googleapis.com/css?family=Bree+Serif);

        body, h1, h2, h3, h4, h5, h6 {
            font-family: 'Bree Serif', serif;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="row">
        <div class="col-xs-6">
            <h1>

            </h1>
        </div>
        <div class="col-xs-6 text-right">
            <h1>
                <small>Slip Gaji</small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Untuk : <a href="#"><?= $tampil_edit['nama'] ?></a></h4>
                    <h6>Jabatan : <a href="#"><?= $tampil_edit['jabatan'] ?></a></h6>
                </div>

            </div>
        </div>

    </div> <!-- / end client details section -->

    <table class="table table-bordered">
        <thead>
        <tr>
            <th><h4>No</h4></th>
            <th><h4>Keterangan</h4></th>
            <th><h4>Gaji Pokok</h4></th>
            <th><h4>jumlah Absen</h4></th>
            <th><h4>Jumlah Potongan</h4></th>
            <th><h4>Total Gaji</h4></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Gaji Bulan <?= $tampil_edit['gajibulan'] ?></td>
            <td class="text-right"><?php echo $hasil_ruu = "Rp " . number_format($tampil_edit['gajipokok'], 2, ',', '.'); ?></td>
            <td class="text-right"><?= $tampil_edit['absen'] ?></td>
            <td class="text-right"><?php echo $hasil_ru = "Rp " . number_format($tampil_edit['potongan'], 2, ',', '.'); ?></td>
            <td class="text-right">
                <?php echo $hasil_r = "Rp " . number_format($tampil_edit['totalgaji'], 2, ',', '.'); ?>
            </td>
        </tr>
        </tbody>
    </table>

    <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
            <p>
                <strong>
                    Total : <br>
                </strong>
            </p>
        </div>
        <div class="col-xs-2">
            <strong>
                <?php echo $hasil_rupiah = "Rp " . number_format($tampil_edit['totalgaji'], 2, ',', '.'); ?><br>
            </strong>
        </div>
    </div>


</div>

</body>
</html>
<script type="text/javascript">
    window.print();
</script>
