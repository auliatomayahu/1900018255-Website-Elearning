<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Absen Siswa
            <small>Semua siswa akan ditampilkan berdasarkan kelas yang dipilih</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/guru/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Absensi</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <form action="<?= base_url('index.php/guru/absensi/insert') ?>" method="POST" class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal</label>

                        <div class="col-sm-10">
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mata Pelajaran</label>

                        <div class="col-sm-10">
                            <select name="idMapel" class="select2" style="width: 100%"   required>
                                <option value="" disabled selected> -- Pilih Mata Pelajaran -- </option>
                                <?php foreach ($mapel->result() as $dMpl) { ?>
                                    <option value="<?= $dMpl->id ?>"><?= $dMpl->kode . ' - ' . $dMpl->mapel ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="bg-<?= $this->session->userdata('skin'); ?>">
                                <tr>
                                    <th width="10%">List</th>
                                    <th width="10%">NISN</th>
                                    <th>Nama Siswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_siswa->result() as $ds) { ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="idSiswa[]" value="<?= $ds->id ?>">
                                            <select name="statusAbsensi[]" class="form-control" required>
                                                <option value="" disabled selected>-- Pilih --</option>
                                                <option value="Hadir">Hadir</option>
                                                <option value="Ijin">Ijin</option>
                                                <option value="Sakit">Sakit</option>
                                            </select>
                                        <td><?= $ds->username ?></td>
                                        <td><?= $ds->nama ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-warning" onclick="history.back(-1)">
                        <div class="fa fa-arrow-left"></div> Kembali
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan 
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>