<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Guru
            <small>Semua data guru</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Guru</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-user-plus"></div> Tambah Guru
                </button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat</th>
                                <th>Jumlah Mata Pelajaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($guru->result_array() as $row) { ?>
                                <tr>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['jenisKelamin'] ?></td>
                                    <td><?= $row['tptLahir'] . ', ' . date('d M Y', strtotime($row['tglLahir'])) ?></td>
                                    <td><?= $row['telp'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td>
                                        <?php
                                            $this->db->where('idGuru', $row['id']);
                                            echo $this->db->get('tb_mapel')->num_rows();
                                        ?> Mapel
                                    </td>
                                    <td>
                                        <a href="<?= base_url('index.php/admin/guru/delete/').$row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Jika dihapus akan berpengaruh pada data yang lain!!!">
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

<!-- Modal Tambah Guru -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><div class="fa fa-user-plus"></div> Tambah Guru</h4>
      </div>
      <form action="<?= base_url('index.php/admin/guru/insert') ?>" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenisKelamin" class="form-control" required>
                    <option value="" disabled selected> -- Pilih Jenis Kelamin -- </option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tptLahir" class="form-control" placeholder="Tempat Lahir" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tglLahir" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>No. Telephone</label>
                <input type="number" name="telp" class="form-control" placeholder="No. Telephone" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>
            </div>
            <small><font color="red">NB : Username tidak boleh ada yang sama!</font></small>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
          <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Save</button>
        </div>
      </form>
    </div>
  </div>
</div>