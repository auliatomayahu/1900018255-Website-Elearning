<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Jadwal
            <small>Menampilkan semua data jadwal</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Home</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-plus"></div> Tambah Jadwal
                </button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kelas</th>
                                <th>Jadwal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                            $no = 1;
                            foreach ($data_jadwal as $dt) { ?>
                            <tr>
                                <td><?= $no++; ?>.</td>
                                <td>
                                    <?php  
                                    $namakelas = $this->db->query("SELECT * FROM tb_kelas WHERE id = '".$dt->idKelas."' ")->result();
                                    foreach ($namakelas as $nk) {
                                        echo $nk->kelas;
                                    }
                                    ?>
                                </td>
                                <td><?= $dt->hari.", ".$dt->jam_mulai." s/d ".$dt->jam_selesai." WIB" ?></td>
                                <td>
                                    <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit<?= $dt->id ?>">
                                        <div class="fa fa-edit"></div> Edit
                                    </button>
                                    <a href="<?= base_url('index.php/admin/jadwal/delete/'.$dt->id ) ?>" class="btn btn-danger btn-xs tombol-yakin" data-isiData="Apakah anda yakin ingin menghapus data jadwal ini ?">
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
    </section>
</div>

<!-- Modal Tambah Kelas -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><div class="fa fa-plus"></div> Tambah Jadwal</h4>
      </div>
      <form action="<?= base_url('index.php/admin/jadwal/insert') ?>" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Kelas</label>
                <select name="idKelas" class="form-control" required>
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($data_kelas as $dk) { ?>
                        <option value="<?= $dk->id ?>"><?= $dk->kelas ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Hari</label>
                <input type="text" name="hari" class="form-control" placeholder="Hari" required>
            </div>
            <div class="form-group">
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required>
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

<!-- Modal Edit Kelas -->
<?php foreach ($data_jadwal as $dt) { ?>
<div class="modal fade" id="edit<?= $dt->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><div class="fa fa-edit"></div> Edit Jadwal</h4>
      </div>
      <form action="<?= base_url('index.php/admin/jadwal/update/').$dt->id ?>" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Kelas</label>
                <select name="idKelas" class="form-control" required>
                    <option value="">-- Pilih Kelas --</option>
                    <?php  
                    $carikelas = $this->db->query("SELECT * FROM tb_kelas WHERE id = '".$dt->idKelas."' ")->result();
                    foreach ($carikelas as $ck) { ?>
                        <option value="<?= $dt->idKelas ?>"><?= $ck->kelas ?></option>
                    <?php } ?>
                    <?php foreach ($data_kelas as $dk) { ?>
                        <option value="<?= $dk->id ?>"><?= $dk->kelas ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Hari</label>
                <input type="text" name="hari" class="form-control" value="<?= $dt->hari ?>" placeholder="Hari" required>
            </div>
            <div class="form-group">
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" value="<?= $dt->jam_mulai ?>" required>
            </div>
            <div class="form-group">
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" value="<?= $dt->jam_selesai ?>" required>
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