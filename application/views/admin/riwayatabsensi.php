<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small>Menampilkan semua data absensi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                                    <th>Aksi</th>
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
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit<?= $abs->id ?>">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                        <a href="<?= base_url('index.php/admin/riwayatabsensi/delete/'.$abs->id ) ?>" class="btn btn-danger btn-xs tombol-yakin" data-isiData="Apakah anda yakin ingin menghapus data absensi siswa ?">
                                            <i class="fa fa-trash"></i> Delete
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
    </section>
</div>

<!-- Modal Edit Kelas -->
<?php foreach ($data_absensi as $abs) { ?>
    <div class="modal fade" id="edit<?= $abs->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><div class="fa fa-edit"></div> Edit Kelas</h4>
        </div>
        <form action="<?= base_url('index.php/admin/riwayatabsensi/update/').$abs->id ?>" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <label>Status Absensi</label>
                    <select name="statusAbsensi" class="form-control" required>
                        <option value="<?= $abs->statusAbsensi ?>"><?= $abs->statusAbsensi ?></option>
                        <option value="">-- Pilih Status --</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Ijin">Ijin</option>
                        <option value="Sakit">Sakit</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
            <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
            <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Update</button>
            </div>
        </form>
        </div>
    </div>
    </div>
<?php } ?>