<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title; ?>
            <small>Akan ditampilkan masing-masing kelas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/siswa/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Tugas</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th width="15px">#</th>
                                <th>Kode Mapel</th>
                                <th>Nama Mapel</th>
                                <th>Kelas</th>
                                <th>Jumlah Tugas</th>
                                <th>Link Group</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($mapel->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['kode'] ?></td>
                                    <td><?= $row['mapel'] ?></td>
                                    <td>
                                        <?php
                                            $this->db->where('id', $row['idKelas']);
                                            $dKelas = $this->db->get('tb_kelas');
                                            foreach ($dKelas->result() as $dKls) {
                                                echo $dKls->kelas;
                                            }
                                            
                                            $jumlahSiswa    = $this->db->query('SELECT id FROM tb_user WHERE idKelas="'.$row['idKelas'].'" ');
                                            echo ' ('.$jumlahSiswa->num_rows().' Siswa)';
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $totalTugas = $this->db->query('SELECT id FROM tb_tugas WHERE idMapel="'.$row['id'].'" ')->num_rows();
                                            echo $totalTugas . ' Tugas';

                                            $dikerjakan = $this->db->query('SELECT id FROM tb_upload_tugas WHERE idMapel="'.$row['id'].'" AND idSiswa="'.$this->session->userdata('id').'" ')->num_rows();
                                                $belum = $totalTugas - $dikerjakan;
                                            echo ' (' . $belum . ' Tugas Belum Dikerjakan)';
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($row['link'] == '') {
                                                echo 'Belum Ada!';
                                            } else {
                                        ?>
                                            <a href="<?= $row['link'] ?>">
                                                <div class="label label-danger">Join Group</div>
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td><div class="label label-success"><?= $row['status'] ?></div></td>
                                    <td>
                                        <a href="<?= base_url('index.php/siswa/tugas/detail/').$row['id'] ?>" class="btn btn-primary btn-xs">
                                            <div class="fa fa-eye"></div> Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <small><font color="red"><b><i>NB : Hanya mata pelajaran berstatus aktif dan berdasarkan kelas yang akan muncul, hubungi administrator jika mata pelajaran tidak muncul!</i></b></font></small>
            </div>
        </div>
    </section>
</div>