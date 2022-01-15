<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Detail Mata Pelajaran
            <small>Semua materi mata pelajaran ini</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/siswa/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?= base_url('index.php/siswa/mapel') ?>">Mapel</a></li>
            <li class="active">Detail</li>
        </ol>
    </section>
    <section class="content">
        <button class="btn btn-success" onclick="history.back(-1)">
            <div class="fa fa-arrow-left"></div> Kembali
        </button>
        <a href="<?= base_url('index.php/siswa/tugas/detail/').$idMapel ?>" class="btn btn-success">
            <div class="fa fa-pencil"></div> Tugas
        </a>
        <div class="row" style="margin-top: 15px">
            <?php
                foreach ($mapel->result_array() as $row) {}
            ?>
            <div class="col-md-4">
                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-green">
                    <div class="widget-user-image">
                        <img class="img-circle" src="<?= base_url('assets') ?>/dist/img/avatar5.png" alt="Foto Profil">
                    </div>
                    <h3 class="widget-user-username"><?= $row['mapel'] ?></h3>
                    <h5 class="widget-user-desc"><?= $row['kode'] ?></h5>
                    </div>
                    <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#">Kelas <span class="pull-right badge bg-green">
                            <?php
                                $this->db->where('id', $row['idKelas']);
                                $dKelas = $this->db->get('tb_kelas');
                                foreach ($dKelas->result() as $dKls) {
                                    echo $dKls->kelas;
                                }
                            ?>
                        </span></a></li>
                        <li><a href="#">Jumlah Siswa <span class="pull-right badge bg-green">
                            <?php
                                echo $this->db->query('SELECT id FROM tb_user WHERE idKelas="'.$row['idKelas'].'" ')->num_rows();
                            ?> Siswa
                        </span></a></li>
                        <li><a href="#">Jumlah Materi <span class="pull-right badge bg-green">
                            <?php
                                echo $this->db->query('SELECT id FROM tb_materi WHERE idMapel="'.$idMapel.'" ')->num_rows();
                            ?> Materi
                        </span></a></li>
                        <li><a href="#">Status <span class="pull-right badge bg-green"><?= $row['status'] ?></span></a></li>
                        <?php if($row['link'] == '') { ?>
                            <li><a href="#">Link Group <span class="pull-right badge bg-green">Belum Ada</span></a></li>
                        <?php } else { ?>
                            <li><a href="<?= $row['link'] ?>">Link Group <span class="pull-right badge bg-green">Join Group</span></a></li>
                        <?php } ?>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <?php
                    $materi = $this->db->query('SELECT * FROM tb_materi WHERE idMapel="'.$idMapel.'" ORDER BY terdaftar DESC');
                    foreach ($materi->result_array() as $mtr) {
                ?>
                    <div class="box box-widget collapsed-box">
                        <div class="box-header with-border">
                            <div class="user-block">
                                <img class="img-circle" src="<?= base_url('assets') ?>/dist/img/avatar5.png" alt="Foto Profil">
                                <span class="username"><?= $mtr['judul'] ?> </span>
                                <span class="description">Diupload <?= date('d M Y H:i:s', strtotime($mtr['terdaftar'])) ?></span>
                            </div>
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <p>
                                <?php if($mtr['file'] != '') { ?>
                                    Materi : <a href="<?= base_url('assets/materi/').$mtr['file'] ?>" download>Download</a> <br>
                                <?php } ?>
                                Keterangan : <?= $mtr['keterangan'] ?>
                            </p>
                            
                            <?php if($mtr['youtube'] != '') { ?>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://youtube.com/embed/<?= $mtr['youtube'] ?>" frameborder="0" allowfullscreen></iframe>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</div>