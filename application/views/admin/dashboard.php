<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Home</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_user WHERE level="Guru"')->num_rows();
                            ?>
                        </h3>

                        <p>Jumlah Guru</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-user-md"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/guru') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_kelas')->num_rows();
                            ?>
                        </h3>

                        <p>Jumlah Kelas</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-database"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/kelas') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_user WHERE level="Siswa" ')->num_rows();
                            ?>
                        </h3>

                        <p>Jumlah Siswa</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-graduation-cap"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/siswa') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_mapel')->num_rows();
                            ?>
                        </h3>

                        <p>Jumlah Mata Pelajaran</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-book"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/mapel') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_user WHERE jenisKelamin="Laki-Laki" AND level="Siswa"')->num_rows();
                            ?>
                        </h3>

                        <p>Siswa Laki-Laki</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-male"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/siswa') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_user WHERE jenisKelamin="Perempuan" AND level="Siswa"')->num_rows();
                            ?>
                        </h3>

                        <p>Siswa Perempuan</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-female"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/siswa') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_user WHERE jenisKelamin="Laki-Laki" AND level="Guru"')->num_rows();
                            ?>
                        </h3>

                        <p>Guru Laki-Laki</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-male"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/guru') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_user WHERE jenisKelamin="Perempuan" AND level="Guru"')->num_rows();
                            ?>
                        </h3>

                        <p>Guru Perempuan</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-female"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/guru') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            Pengumuman
                        </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th width="15px">#</th>
                                        <th>Keterangan</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        foreach ($pengumuman->result_array() as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['keterangan'] ?></td>
                                            <td><?= date('d F Y H:i', strtotime($row['waktu'])) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>