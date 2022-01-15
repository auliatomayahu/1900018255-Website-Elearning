<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-warning" onclick="history.back(-1)">
                    <div class="fa fa-arrow-left"></div> Kembali
                </button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-plus"></div> Tambah Data
                </button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Kode Mapel</th>
                                <th>Nama Mapel</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($mapel->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['kode'] ?></td>
                                    <td><?= $row['mapel'] ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= base_url('index.php/admin/mapel/deletedaftar/').$row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus daftar mata pelajaran ini?">
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

<!-- Modal Tambah Mapel -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><div class="fa fa-plus"></div> Tambah Mata Pelajaran</h4>
      </div>
      <form action="<?= base_url('index.php/admin/mapel/insertmapel') ?>" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Kode Mapel</label>
                <input type="text" name="kode" class="form-control" placeholder="Kode Mapel" required>
            </div>
            <div class="form-group">
                <label>Nama Mapel</label>
                <input type="text" name="mapel" class="form-control" placeholder="Nama Mapel" required>
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

<!-- Modal Edit Data -->
<?php foreach ($mapel->result() as $eMpl) { ?>
    <div class="modal fade" id="editData<?= $eMpl->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><div class="fa fa-plus"></div> Edit Mata Pelajaran</h4>
            </div>
            <form action="<?= base_url('index.php/admin/mapel/updatemapel/').$eMpl->id ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Mapel</label>
                        <input type="text" name="kode" class="form-control" value="<?= $eMpl->kode ?>" placeholder="Kode Mapel" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Mapel</label>
                        <input type="text" name="mapel" class="form-control" value="<?= $eMpl->mapel ?>" placeholder="Nama Mapel" required>
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