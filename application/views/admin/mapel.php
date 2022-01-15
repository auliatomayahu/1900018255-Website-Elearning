<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Mata Pelajaran
            <small>Semua data mata pelajaran</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Mapel</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-plus"></div> Tambah Mapel
                </button>
                <a href="<?= base_url('index.php/admin/mapel/daftar') ?>" class="btn btn-warning">
                    <div class="fa fa-book"></div> Daftar Mata Pelajaran
                </a>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Kode Mata Pelajaran</th>
                                <th>Nama Mata Pelajaran</th>
                                <th>Guru</th>
                                <th>Kelas</th>
                                <th>Jumlah Materi</th>
                                <th>Jumlah Tugas</th>
                                <th>Link Group</th>
                                <th>Status</th>
                                <th>Jadwal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($mapel->result_array() as $row) {                        // echo json_encode($row);
 ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['kode'] ?></td>
                                    <td><?= $row['mapel'] ?></td>
                                    <td>
                                        <?php
                                            $this->db->where('id', $row['idGuru']);
                                            $dGuru = $this->db->get('tb_user');
                                            foreach ($dGuru->result() as $dGru) {
                                                echo $dGru->nama;
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $this->db->where('id', $row['idKelas']);
                                            $dKelas = $this->db->get('tb_kelas');
                                            foreach ($dKelas->result() as $dKls) {
                                                echo $dKls->kelas;
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $this->db->query('SELECT id FROM tb_materi WHERE idMapel="'.$row['id'].'" ')->num_rows();
                                        ?> Materi
                                    </td>
                                    <td>
                                        <?php
                                            echo $this->db->query('SELECT id FROM tb_tugas WHERE idMapel="'.$row['id'].'" ')->num_rows();
                                        ?> Tugas
                                    </td>
                                    <td>
                                        <?php
                                            if($row['link'] == '') {
                                                echo 'Belum ada!';
                                            } else {
                                        ?>
                                            <a href="<?= $row['link'] ?>">
                                                <div class="label label-primary">Join Group</div>
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($row['status'] == 'Aktif') { ?>
                                            <div class="label label-success"><?= $row['status'] ?></div>
                                        <?php } else { ?>
                                            <div class="label label-danger"><?= $row['status'] ?></div>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?= $row['hari'] . ', ' . date('H:i', strtotime($row['jam_mulai'])) . ' s/d ' . date('H:i', strtotime($row['jam_selesai'])) ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('index.php/admin/mapel/detail/').$row['id'] ?>" class="btn btn-primary btn-xs">
                                            <div class="fa fa-eye"></div> Detail
                                        </a>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= base_url('index.php/admin/mapel/delete/').$row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Jika dihapus akan berpengaruh pada data yang lain!!!">
                                            <div class="fa fa-trash"></div> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <small><font color="red"><b><i>NB : Status nonaktif tidak akan muncul di guru</i></b></font></small>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Mapel -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><div class="fa fa-plus"></div> Tambah Mata Pelajaran</h4>
      </div>
      <form action="<?= base_url('index.php/admin/mapel/insert') ?>" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Mapel</label>
                <select name="idMapel" style="width: 100%" class="select2" requireq>
                    <option value="" disabled selected> -- Pilih Daftar Mapel -- </option>
                    <?php foreach ($daftarmapel->result() as $dMpl) { ?>
                        <option value="<?= $dMpl->id ?>"><?= $dMpl->kode . ' - ' . $dMpl->mapel ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Guru</label>
                        <select name="idGuru" class="form-control" requireq>
                            <option value="" disabled selected> -- Pilih Guru -- </option>
                            <?php foreach ($guru->result() as $gru) { ?>
                                <option value="<?= $gru->id ?>"><?= $gru->nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="idKelas" class="form-control" requireq>
                            <option value="" disabled selected> -- Pilih Kelas -- </option>
                            <?php foreach ($kelas->result_array() as $kls) { ?>
                                <option value="<?= $kls['id'] ?>"><?= $kls['kelas'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Link Group</label>
                <input type="url" name="link" class="form-control" placeholder="Link Join Group">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="" disabled selected> -- Pilih Status -- </option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>
            <div class="form-group">
                <label>Hari</label>
                <select name="hari" class="form-control" required>
                    <option value="" disabled selected> -- Pilih Hari -- </option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" required>
                    </div>
                </div>
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

<!-- Modal Edit Mapel -->
<?php foreach ($mapel->result() as $mpl) { ?>
    <div class="modal fade" id="editData<?= $mpl->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><div class="fa fa-edit"></div> Edit Mata Pelajaran</h4>
            </div>
            <form action="<?= base_url('index.php/admin/mapel/  /').$mpl->id ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Link Group</label>
                        <input type="url" name="link" class="form-control" value="<?= $mpl->link ?>" placeholder="Link Join Group">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <?php if($mpl->status == 'Aktif') { ?>
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                            <?php } else { ?>
                                <option value="Nonaktif">Nonaktif</option>
                                <option value="Aktif">Aktif</option>
                            <?php } ?>
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