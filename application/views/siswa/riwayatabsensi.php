<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small>Menampilkan semua data absensi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/guru/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Riwayat Absensi</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Mata Pelajaran</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Status</th>
                                    <th>Tanggal Absensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                $no =1;
                                foreach ($data_absensi as $abs) { ?>
                                <tr>
                                    <td><?= $no++ ?>.</td>
                                    <td>
                                        <?php
                                            $this->db->where('id', $abs->idMapel);
                                            foreach ($this->db->get('tb_mapel')->result() as $dMpl) {
                                                echo $dMpl->kode . ' - ' . $dMpl->mapel;
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php  
                                        $nisnsiswa = $this->db->query("SELECT * FROM tb_user WHERE id = '".$abs->idSiswa."' ")->result();
                                        foreach ($nisnsiswa as $nis) {
                                            echo $nis->username;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php  
                                        $namasiswa = $this->db->query("SELECT * FROM tb_user WHERE id = '".$abs->idSiswa."' ")->result();
                                        foreach ($namasiswa as $ns) {
                                            echo $ns->nama;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $abs->statusAbsensi ?></td>
                                    <td><?= date('d F Y', strtotime($abs->tgl_absen)) ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>