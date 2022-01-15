<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Siswa
            <small>Semua data siswa</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Siswa</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>No. Telephone</th>
                                <th>Alamat</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($siswa->result_array() as $row) { ?>
                                <tr>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['jenisKelamin'] ?></td>
                                    <td><?= $row['tptLahir'] . ', ' . date('d M Y', strtotime($row['tglLahir'])) ?></td>
                                    <td><?= $row['telp'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td>
                                        <?php
                                            $this->db->where('id', $row['idKelas']);
                                            $dKelas = $this->db->get('tb_kelas');
                                            foreach ($dKelas->result() as $dKls) {
                                                echo $dKls->kelas;
                                            }
                                        ?>
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

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><div class="fa fa-user-plus"></div> Tambah Siswa</h4>
      </div>
      <form action="<?= base_url('index.php/admin/siswa/insert') ?>" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>NIS</label>
                <input type="text" name="nis" class="form-control" placeholder="NIS" required>
            </div>
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
            <div class="form-group">
                <label>Kelas</label>
                <select name="idKelas" class="form-control" required>
                    <option value="" disabled selected> -- Pilih Kelas -- </option>
                    <?php foreach ($kelas->result() as $kls) { ?>
                        <option value="<?= $kls->id ?>"><?= $kls->kelas ?></option>
                    <?php } ?>
                </select>
            </div>
            <small><font color="red"><b><i>NB : Login default siswa yaitu username = nis dan password = tglblnthn lahir</i></b></font></small>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
          <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Save</button>
        </div>
      </form>
    </div>
  </div>
</div>