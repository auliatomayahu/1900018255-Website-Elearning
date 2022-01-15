<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small>Semua tugas mata pelajaran disini</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/siswa/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?= base_url('index.php/siswa/tugas') ?>">Tugas</a></li>
            <li class="active">Detail</li>
        </ol>
    </section>
    <section class="content">
        <button class="btn btn-danger" onclick="history.back(-1)">
            <div class="fa fa-arrow-left"></div> Kembali
        </button>
        <a href="<?= base_url('index.php/siswa/mapel/detail/').$idMapel ?>" class="btn btn-danger">
            <div class="fa fa-book"></div> Materi
        </a>
        <div class="row" style="margin-top: 15px">
            <?php
                foreach ($mapel->result_array() as $row) {}
            ?>
            <div class="col-md-4">
                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-red">
                    <div class="widget-user-image">
                        <img class="img-circle" src="<?= base_url('assets') ?>/dist/img/avatar5.png" alt="Foto Profil">
                    </div>
                    <h3 class="widget-user-username"><?= $row['mapel'] ?></h3>
                    <h5 class="widget-user-desc"><?= $row['kode'] ?></h5>
                    </div>
                    <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#">Kelas <span class="pull-right badge bg-red">
                            <?php
                                $this->db->where('id', $row['idKelas']);
                                $dKelas = $this->db->get('tb_kelas');
                                foreach ($dKelas->result() as $dKls) {
                                    echo $dKls->kelas;
                                }
                            ?>
                        </span></a></li>
                        <li><a href="#">Jumlah Siswa <span class="pull-right badge bg-red">
                            <?php
                                echo $this->db->query('SELECT id FROM tb_user WHERE idKelas="'.$row['idKelas'].'" ')->num_rows();
                            ?> Siswa
                        </span></a></li>
                        <li><a href="#">Jumlah Tugas <span class="pull-right badge bg-red">
                            <?php
                                echo $this->db->query('SELECT id FROM tb_tugas WHERE idMapel="'.$idMapel.'" ')->num_rows();
                            ?> Tugas
                        </span></a></li>
                        <li><a href="#">Status <span class="pull-right badge bg-red"><?= $row['status'] ?></span></a></li>
                        <?php if($row['link'] == '') { ?>
                            <li><a href="#">Link Group <span class="pull-right badge bg-red">Belum Ada</span></a></li>
                        <?php } else { ?>
                            <li><a href="<?= $row['link'] ?>">Link Group <span class="pull-right badge bg-red">Join Group</span></a></li>
                        <?php } ?>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <?php
                    $materi = $this->db->query('SELECT * FROM tb_tugas WHERE idMapel="'.$idMapel.'" ORDER BY terdaftar DESC');
                    foreach ($materi->result_array() as $mtr) {
                ?>
                    <div class="box box-widget collapsed-box">
                        <div class="box-header with-border">
                            <div class="user-block">
                                <img class="img-circle" src="<?= base_url('assets') ?>/dist/img/avatar5.png" alt="Foto Profil">
                                <span class="username"><?= $mtr['judul'] ?> (<?php
                                        if($this->db->query('SELECT id FROM tb_upload_tugas WHERE idTugas="'.$mtr['id'].'" AND idSiswa="'.$this->session->userdata('id').'" ')->num_rows() == '0') {
                                            date_default_timezone_set('Asia/Jakarta');
                                            $tglNow = date('Y-m-d H:i');
                                            $tglBatas = date('Y-m-d H:i', strtotime($mtr['waktu']));

                                            if($tglNow > $tglBatas) {
                                                echo 'Sudah Ditutup';
                                            } else {
                                                echo 'Belum Mengerjakan';
                                            }
                                        } else {
                                            date_default_timezone_set('Asia/Jakarta');
                                            $tglNow = date('Y-m-d H:i');
                                            $tglBatas = date('Y-m-d H:i', strtotime($mtr['waktu']));

                                            if($tglNow > $tglBatas) {
                                                echo 'Sudah Mengerjakan & Sudah Ditutup';
                                            } else {
                                                echo 'Sudah Mengerjakan';
                                            }
                                        }
                                    ?>)</span>
                                <span class="description">Batas Pengumpulan <?= date('d M Y H:i', strtotime($mtr['waktu'])) ?></span>
                            </div>
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <p>
                                <?php if($mtr['file'] != '') { ?>
                                    File Tugas : <a href="<?= base_url('assets/materi/').$mtr['file'] ?>" download>Download</a> <br>
                                <?php } ?>
                                Keterangan : <?= $mtr['keterangan'] ?>
                            </p>
                            
                            <?php if($mtr['youtube'] != '') { ?>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://youtube.com/embed/<?= $mtr['youtube'] ?>" frameborder="0" allowfullscreen></iframe>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="box-body">
                            <?php
                                foreach ($this->db->query('SELECT * FROM tb_upload_tugas WHERE idTugas="'.$mtr['id'].'" AND idSiswa="'.$this->session->userdata('id').'"')->result() as $tgs) {
                            ?>
                                <b>Detail Tugas</b> <br>
                                Nilai : <?= $tgs->nilai; ?> <br>
                                Keterangan : <?= $tgs->keterangan; ?> <br>
                                File : <a href="<?= base_url('assets/tugas/').$tgs->file ?>" download>Download</a><br> <br>
                            <?php } ?>
                            <?php
                                if($this->db->query('SELECT id FROM tb_upload_tugas WHERE idTugas="'.$mtr['id'].'" AND idSiswa="'.$this->session->userdata('id').'" ')->num_rows() == '0') {
                                    date_default_timezone_set('Asia/Jakarta');
                                    $tglNow = date('Y-m-d H:i');
                                    $tglBatas = date('Y-m-d H:i', strtotime($mtr['waktu']));

                                    if($tglNow < $tglBatas) {
                            ?>
                                <form action="<?= base_url('index.php/siswa/tugas/upload_tugas/').$mtr['id'].'/'.$idMapel ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Upload Tugas</label>
                                        <input type="file" name="file" class="form-control-file" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <div class="fa fa-upload fa-sm"></div> Upload
                                    </button>
                                </form>
                            <?php
                                    }
                                } else {
                                    date_default_timezone_set('Asia/Jakarta');
                                    $tglNow = date('Y-m-d H:i');
                                    $tglBatas = date('Y-m-d H:i', strtotime($mtr['waktu']));

                                    if($tglNow < $tglBatas) {
                            ?>
                                <form action="<?= base_url('index.php/siswa/tugas/update_tugas/').$tgs->id.'/'.$idMapel ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Update Tugas</label>
                                        <input type="file" name="file" class="form-control-file" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <div class="fa fa-upload fa-sm"></div> Update
                                    </button>
                                </form>
                            <?php } } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</div>