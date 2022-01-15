<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Kelas
            <small>Semua data kelas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Kelas</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-plus"></div> Tambah Kelas
                </button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th width="15px">#</th>
                                <th>Kelas</th>
                                <th>Jumlah siswa</th>
                                <th>Laki-Laki</th>
                                <th>Perempuan</th>
                                <th>Jumlah Mapel</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($kelas->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['kelas'] ?></td>
                                    <td>
                                        <?php
                                            echo $this->db->query('SELECT id FROM tb_user WHERE level="Siswa" AND idKelas="'.$row['id'].'" ')->num_rows();
                                        ?> Siswa
                                    </td>
                                    <td>
                                        <?php
                                            $laki = $this->db->query('SELECT id FROM tb_user WHERE jenisKelamin="Laki-Laki" AND level="Siswa" AND idKelas="'.$row['id'].'" ');
                                            echo $laki->num_rows() . ' Siswa';
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $perempuan = $this->db->query('SELECT id FROM tb_user WHERE jenisKelamin="Perempuan" AND level="Siswa" AND idKelas="'.$row['id'].'" ');
                                            echo $perempuan->num_rows() . ' Siswa';
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $this->db->query('SELECT id FROM tb_mapel WHERE idKelas="'.$row['id'].'" ')->num_rows();
                                        ?> Mapel
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= base_url('index.php/admin/kelas/delete/').$row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Jika dihapus akan berpengaruh pada data yang lain!!!">
                                            <div class="fa fa-trash"></div> Delete
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
        <h4 class="modal-title" id="myModalLabel"><div class="fa fa-plus"></div> Tambah Kelas</h4>
      </div>
      <form action="<?= base_url('index.php/admin/kelas/insert') ?>" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="kelas" class="form-control" placeholder="Kelas" required>
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
<?php foreach ($kelas->result() as $kls) { ?>
    <div class="modal fade" id="editData<?= $kls->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><div class="fa fa-edit"></div> Edit Kelas</h4>
        </div>
        <form action="<?= base_url('index.php/admin/kelas/update/').$kls->id ?>" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Kelas" value="<?= $kls->kelas; ?>" required>
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