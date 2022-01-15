<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small>Semua tugas akan muncul disini!</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/guru/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?= base_url('index.php/guru/mapel') ?>">Tugas</a></li>
            <li class="active">Detail</li>
        </ol>
    </section>
    <section class="content">
        <button class="btn btn-danger" onclick="history.back(-1)">
            <div class="fa fa-arrow-left"></div> Kembali
        </button>
        <a href="<?= base_url('index.php/admin/mapel/detail/').$idMapel ?>" class="btn btn-danger">
            <div class="fa fa-book"></div> Materi
        </a>
        <div class="row" style="margin-top: 15px">
            <?php
                date_default_timezone_set('Asia/Jakarta');
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
                                <span class="username"><?= $mtr['judul'] ?>
                                    <a href="<?= base_url('index.php/admin/tugas/penilaian/').$mtr['id'] ?>"><div class="label label-success"><div class="fa fa-check"></div> Nilai</div></a>
                                </span>
                                <span class="description">Batas Pengumpulan <?= date('d M Y H:i', strtotime($mtr['waktu'])) ?></span>
                            </div>
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <p>
                                <?php if($mtr['file'] != '') { ?>
                                    File Tugas : <a href="<?= base_url('assets/tugas/').$mtr['file'] ?>" download>Download</a> <br>
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

<!-- Modal Tambah Tugas -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><div class="fa fa-plus"></div> Tambah Tugas</h4>
      </div>
      <form action="<?= base_url('index.php/guru/tugas/insert/').$idMapel ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" placeholder="Judul" required>
            </div>
            <div class="form-group">
                <label>File Materi <small><font color="red"><b>(Optional)</b></font></small></label>
                <input type="file" name="file" class="form-control-file">
            </div>
            <div class="form-group">
                <label>YouTube <small><font color="red"><b>(Optional)</b></font></small></label>
                <input type="link" name="youtube" class="form-control" placeholder="YouTube">
            </div>
            <center><b>Batas Pengumpulan</b></center>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jam</label>
                        <input type="time" name="jam" class="form-control" value="<?= date('H:i', strtotime('23:59')) ?>" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="10" placeholder="Keterangan" required></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
          <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Save</button>
        </div>
      </form>
    </div>
  </div>
</div>