<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <!-- <small>Dashboard</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/guru/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Home</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_mapel WHERE idGuru="'.$this->session->userdata('id').'" ')->num_rows();
                            ?>
                        </h3>

                        <p>Mata Pelajaran Saya</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-book"></div>
                    </div>
                    <a href="<?= base_url('index.php/guru/mapel') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            Jadwal Saya
                        </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th width="5px">#</th>
                                        <th>Jadwal</th>
                                        <th>Mapel</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        $no =1;
                                        $jadwal = $this->db->query("SELECT * FROM tb_mapel WHERE idGuru='".$this->session->userdata('id')."' ")->result();
                                        foreach ($jadwal as $jd) {
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?>.</td>
                                        <td><?= $jd->hari.', '.date('H:i', strtotime($jd->jam_mulai)).' s/d '.date('H:i', strtotime($jd->jam_selesai)) ?></td>
                                        <td><?= $jd->mapel ?></td>
                                        <td>
                                            <a href="<?= base_url('index.php/guru/mapel/detail/').$jd->id ?>" class="btn btn-primary btn-xs">
                                                <div class="fa fa-eye"></div> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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