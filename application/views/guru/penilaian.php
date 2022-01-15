<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small>Penilaian tugas pada halaman ini</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/guru/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" onclick="history.back(-1)">
                    <div class="fa fa-arrow-left"></div> Kembali
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th width="10px">#</th>
                            <th>Siswa</th>
                            <th>File</th>
                            <th>Tanggal</th>
                            <th>Nilai</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
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
                                <td>
                                    <a href="<?= base_url('assets/tugas/').$row['file'] ?>" download>Download</a>
                                </td>
                                <td><?= date('d M Y H:i:s', strtotime($row['tanggal'])) ?></td>
                                <form action="<?= base_url('index.php/guru/tugas/insert_penilaian/').$row['id'].'/'.$row['idTugas'] ?>" method="POST">
                                    <td><input type="number" name="nilai" value="<?= $row['nilai'] ?>" placeholder="Nilai" required></td>
                                    <td><input type="text" name="keterangan" value="<?= $row['keterangan'] ?>" placeholder="Keterangan"></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <div class="fa fa-save fa-sm"></div> Nilai
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>