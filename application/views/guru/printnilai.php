<!DOCTYPE html>
<html lang="en">
  <head>    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cetak Nilai</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    <div class="container">
        <h3><center>REKAP PENILAIAN</center></h3>

        Tanggal Cetak : <?= date('d F Y H:i:s') ?>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th width="10px">#</th>
                    <th>Siswa</th>
                    <th>File</th>
                    <th>Tanggal</th>
                    <th>Nilai</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach ($siswa->result_array() as $row) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <?php
                                $this->db->where('id', $row['idSiswa']);
                                foreach ($this->db->get('tb_user')->result() as $dSwa) {
                                    echo $dSwa->username.' - '.$dSwa->nama;
                                }
                            ?>
                        </td>
                        <td><?= $row['file'] ?></td>
                        <td><?= date('d F Y H:i:s', strtotime($row['tanggal'])) ?></td>
                        <td><?= $row['nilai'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?= base_url('assets') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
    <script>
       window.print();
    </script>
  </body>
</html>