<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Pengumuman
            <small>Semua data pengumuman</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Pengumuman</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-plus"></div> Tambah Data
                </button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th width="15px">#</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
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
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= base_url('index.php/admin/pengumuman/delete/').$row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Jika dihapus akan berpengaruh pada data yang lain!!!">
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

<!-- Modal Tambah pengumuman -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><div class="fa fa-plus"></div> Tambah Pengumuman</h4>
      </div>
      <form action="<?= base_url('index.php/admin/pengumuman/insert') ?>" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="20" placeholder="Input Pengumuman disini!!" required></textarea>
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

<!-- Modal Edit pengumuman -->
<?php foreach ($pengumuman->result() as $pg) { ?>
    <div class="modal fade" id="editData<?= $pg->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><div class="fa fa-edit"></div> Edit Pengumuman</h4>
        </div>
        <form action="<?= base_url('index.php/admin/Pengumuman/update/').$pg->id ?>" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" rows="20" required><?= $pg->keterangan ?></textarea>
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